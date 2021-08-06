<?php

namespace XoopsModules\Xsitemap;

/*
 Utility Class Definition

 You may not change or alter any portion of this comment or credits of
 supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit
 authors.

 This program is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Module:  xSitemap
 *
 * @package      \module\Xsitemap\class
 * @license      http://www.fsf.org/copyleft/gpl.html GNU public license
 * @copyright    https://xoops.org 2001-2017 &copy; XOOPS Project
 * @author       ZySpec <zyspec@yahoo.com>
 * @author       Mamba <mambax7@gmail.com>
 * @since        File available since version 1.54
 */

use XoopsModules\Xsitemap\{
    Common
};
/** @var Helper $helper */
/** @var PluginHandler $pluginHandler */


$helper        = Helper::getInstance();
$moduleDirName = \basename(\dirname(__DIR__));
\xoops_loadLanguage('admin', $moduleDirName);
//if (!class_exists('DummyObject')) {
//    xoops_load('dummy', $moduleDirName);
//}

/**
 * Class Utility
 */
class Utility extends Common\SysUtility
{
    //--------------- Custom module methods -----------------------------
    /**
     * Show Site map
     *
     * @return array
     */
    public static function generateSitemap()
    {
        $block         = [];
        $moduleDirName = \basename(\dirname(__DIR__));
        /** @internal can't use Helper since function called during install
         * $helper = \Xmf\Module\Helper::getHelper($moduleDirName);
         * $pluginHandler  = $helper->getHandler('Plugin', $moduleDirName);
         */
        //        xoops_load('plugin', $moduleDirName);
        \xoops_load('XoopsModuleConfig');
        // Get list of modules admin wants to hide from xsitemap
        $invisibleDirnames = empty($GLOBALS['xoopsModuleConfig']['invisible_dirnames']) ? ['xsitemap'] : \explode(',', $GLOBALS['xoopsModuleConfig']['invisible_dirnames'] . ',xsitemap');
        $invisibleDirnames = \array_map('\trim', $invisibleDirnames);
        $invisibleDirnames = \array_map('\mb_strtolower', $invisibleDirnames);
        // Get the mid for any of these modules if they're active and hasmain (visible frontside)
        /** @var \XoopsModuleHandler $moduleHandler */
        $moduleHandler     = \xoops_getHandler('module');
        $invisibleMidArray = [];
        foreach ($invisibleDirnames as $hiddenDir) {
            $criteria = new \CriteriaCompo(new \Criteria('hasmain', 1));
            $criteria->add(new \Criteria('isactive', 1));
            $criteria->add(new \Criteria('name', $hiddenDir));
            $modObj = $moduleHandler->getByDirname($hiddenDir);
            if (false !== $modObj && $modObj instanceof \XoopsModule) {
                $invisibleMidArray[] = $modObj->mid();
            }
        }
        // Where user has permissions
        /** @var \XoopsGroupPermHandler $grouppermHandler */
        $grouppermHandler = \xoops_getHandler('groupperm');
        $groups           = ($GLOBALS['xoopsUser'] instanceof \XoopsUser) ? $GLOBALS['xoopsUser']->getGroups() : XOOPS_GROUP_ANONYMOUS;
        $readAllowed      = $grouppermHandler->getItemIds('module_read', $groups);
        $filteredMids     = \array_diff($readAllowed, $invisibleMidArray);
        $pluginHandler = Helper::getInstance()->getHandler('Plugin');
        $criteria      = new \CriteriaCompo(new \Criteria('hasmain', 1));
        $criteria->add(new \Criteria('isactive', 1));
        if (\count($filteredMids) > 0) {
            $criteria->add(new \Criteria('mid', '(' . \implode(',', $filteredMids) . ')', 'IN'));
        }
        $modules  = $moduleHandler->getObjects($criteria, true);
        $criteria = new \CriteriaCompo();
        $criteria->setSort('plugin_id');
        $criteria->order = 'ASC';
        $pluginObjArray  = $pluginHandler->getAll($criteria);
        /** @var array $sublinks */
        foreach ($modules as $mid => $modObj) {
            $sublinks               = $modObj->subLink();
            $modDirName             = $modObj->getVar('dirname', 'n');
            $block['modules'][$mid] = [
                'id'        => $mid,
                'name'      => $modObj->getVar('name'),
                'directory' => $modDirName,
                'sublinks'  => [],
                // init the sublinks array
            ];
            // Now 'patch' the sublink to include module path
            if (\count($sublinks) > 0) {
                foreach ($sublinks as $sublink) {
                    $block['modules'][$mid]['sublinks'][] = [
                        'name' => $sublink['name'],
                        'url'  => $GLOBALS['xoops']->url("www/modules/{$modDirName}/{$sublink['url']}"),
                    ];
                }
            }
            foreach ($pluginObjArray as $pObj) {
                if ((0 == $pObj->getVar('topic_pid')) && \in_array($pObj->getVar('plugin_mod_table'), (array)$modObj->getInfo('tables'))) {
                    $objVars = $pObj->getValues();
                    if (1 == $objVars['plugin_online']) {
                        $tmpMap                           = self::getSitemap($objVars['plugin_mod_table'], $objVars['plugin_cat_id'], $objVars['plugin_cat_pid'], $objVars['plugin_cat_name'], $objVars['plugin_call'], $objVars['plugin_weight'], $objVars['plugin_where']);
                        $block['modules'][$mid]['parent'] = $tmpMap['parent'] ?? null;
                    }
                }
            }
        }
        return $block;
    }

    /**
     * Get the Sitemap
     *
     * @param        $table
     * @param        $id_name
     * @param        $pid_name
     * @param        $title_name
     * @param        $url
     * @param string $order
     * @param string $where
     * @return array sitemap links
     */
    public static function getSitemap($table, $id_name, $pid_name, $title_name, $url, $order = '', $where = '')
    {
        require_once XOOPS_ROOT_PATH . '/class/tree.php';
        $helper = Helper::getInstance();
        /** @var \XoopsMySQLDatabase $xoopsDb */
        $xoopsDb       = \XoopsDatabaseFactory::getDatabaseConnection();
        $sql       = "SELECT `{$id_name}`, `{$pid_name}`, `{$title_name}` FROM " . $xoopsDb->prefix . "_{$table}";
        $result    = $xoopsDb->query($sql);
        $objsArray = [];
        if ($result) {
            while (false !== ($row = $xoopsDb->fetchArray($result))) {
                $objsArray[] = new DummyObject($row, $id_name, $pid_name, $title_name);
            }
        }
        //$sql = "SELECT `{$id_name}`, `{$title_name}` FROM " . $xoopsDb->prefix . "_{$table} WHERE `{$pid_name}`= 0";
        // v1.54 added in the event categories are flat (don't support hierarchy)
        $sql = "SELECT `{$id_name}`, `{$title_name}` FROM " . $xoopsDb->prefix . "_{$table}";
        $sqlWhere = '';
        if ($pid_name !== $id_name) {
            $sqlWhere = "`{$pid_name}`= 0";
        }
        if ('' !== $where) {
            if ('' !== $sqlWhere) {
                $sqlWhere .= ' AND ';
            }
            $sqlWhere .= $where;
        }
        if ('' !== $sqlWhere) {
            $sql .= " WHERE ($sqlWhere)";
        }
        if ('' != $order) {
            $sql .= " ORDER BY `{$order}`";
        }
        $result   = $xoopsDb->query($sql);
        $i        = 0;
        $xsitemap = [];
        if ($result) {
            while (list($catid, $name) = $xoopsDb->fetchRow($result)) {
                $xsitemap['parent'][$i] = [
                    'id'    => $catid,
                    'title' => \htmlspecialchars($name, \ENT_QUOTES | \ENT_HTML5),
                    'url'   => $url . $catid,
                ];
                if (($pid_name !== $id_name) && $helper->getConfig('show_subcategories')) {
                    $j           = 0;
                    $mytree      = new \XoopsObjectTree($objsArray, $id_name, $pid_name);
                    $child_array = $mytree->getAllChild($catid);
                    /** @var \XoopsObject $child */
                    foreach ($child_array as $child) {
                        $xsitemap['parent'][$i]['child'][$j] = [
                            'id'    => $child->getVar($id_name),
                            'title' => $child->getVar($title_name),
                            'url'   => $url . $child->getVar($id_name),
                        ];
                        ++$j;
                    }
                }
                ++$i;
            }
        }

        return $xsitemap;
    }

    /**
     * Save the XML Sitemap
     *
     * @param array $xsitemap_show
     * @return mixed int number of bytes saved | false on failure
     */
    public static function saveSitemap(array $xsitemap_show)
    {
        $xml                     = new \DOMDocument('1.0', 'UTF-8');
        $xml->preserveWhiteSpace = false;
        $xml->formatOutput       = true;
        $xml_set                 = $xml->createElement('urlset');
        $xml_set->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        if (!empty($xsitemap_show)) {
            foreach ($xsitemap_show['modules'] as $mod) {
                if ($mod['directory']) {
                    $xml_url = $xml->createElement('url');
                    $xml_url->appendChild($xml->createComment(\htmlspecialchars((\ucwords($mod['name'])) . ' ')));
                    $loc = $xml->createElement('loc', \htmlspecialchars(($GLOBALS['xoops']->url("www/modules/{$mod['directory']}/index.php"))));
                    $xml_url->appendChild($loc);
                    $xml_set->appendChild($xml_url);
                }
                if ($mod['parent'] ?? null) {
                    foreach ($mod['parent'] as $parent) {
                        $xml_parent = $xml->createElement('url');
                        $loc        = $xml->createElement('loc', \htmlspecialchars($GLOBALS['xoops']->url("www/modules/{$mod['directory']}/{$parent['url']}")));
                        $xml_parent->appendChild($loc);
                        $xml_set->appendChild($xml_parent);
                    }
                    $z = 0;
                    //if ($mod["parent"][$z]["child"]) {
                    if ($mod['parent'][$z]['child'] ?? null) {
                        foreach ($mod['parent'][$z]['child'] as $child) {
                            $xml_child = $xml->createElement('url');
                            $loc       = $xml->createElement('loc', \htmlspecialchars($GLOBALS['xoops']->url("www/modules/{$mod['directory']}/{$child['url']}")));
                            $xml_child->appendChild($loc);
                            $xml_set->appendChild($xml_child);
                        }
                        ++$z;
                    }
                }
            }
        }
        $xml->appendChild($xml_set);
        return $xml->save($GLOBALS['xoops']->path('www/xsitemap.xml'));
    }
}
