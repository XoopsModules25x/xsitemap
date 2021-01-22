<?php
/*
 * ****************************************************************************
 * xsitemap - MODULE FOR XOOPS CMS
 * Copyright (c) Urbanspaceman (http://www.takeaweb.it)
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Module: xsitemap
 *
 * @package         module\Xsitemap\admin
 * @author          Urbanspaceman (http://www.takeaweb.it)
 * @copyright       Urbanspaceman (http://www.takeaweb.it)
 * @author          XOOPS Module Development Team
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @link            https://xoops.org XOOPS
 * @since           1.00
 */

use Xmf\Module\Admin;
use Xmf\Request;
use XoopsModules\Xsitemap\{
    Helper,
    Plugin,
    PluginHandler
};
/** @var Helper $helper */

require_once __DIR__ . '/admin_header.php';
xoops_cp_header();
$adminObject = Admin::getInstance();
$adminObject->displayNavigation(basename(__FILE__));
$pluginHandler = $helper->getHandler('Plugin');
$obj = null;

$op = Request::getCmd('op', 'show_list_plugin');

switch ($op) {
    case 'add_plugin':
        // Display the form
        /** @var Plugin $obj */
        $obj = $pluginHandler->create();
        echo $obj->getForm();
        break;
    case 'save_plugin':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            $helper->redirect('admin/plugin.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $pluginId = Request::getInt('plugin_id', 0, 'POST');
        if (!empty($pluginId)) {
            $obj = $pluginHandler->get($pluginId);
            if (!$obj instanceof Plugin) { // passed Id for non-existent plugin so create new plugin
                $obj = $pluginHandler->create();
            }
        } else {
            $obj = $pluginHandler->create();
        }
        $timestamp_created   = strtotime(Request::getString('plugin_date_created', 0, 'POST'));
        $verif_plugin_online = (1 === Request::getInt('plugin_online', 0, 'POST')) ? 1 : 0;                    //Form plugin_online
        $obj->setVars(
            [
                'plugin_name'         => Request::getString('plugin_name', '', 'POST'),                   //Form plugin_name
                'plugin_mod_version'  => Request::getCmd('plugin_mod_version', '', 'POST'),               //Form plugin_mod_version
                'plugin_mod_table'    => Request::getCmd('plugin_mod_table', '', 'POST'),                 //Form plugin_mod_table
                'plugin_cat_id'       => Request::getCmd('plugin_cat_id', '', 'POST'),                    //Form plugin_cat_id
                'plugin_cat_pid'      => Request::getCmd('plugin_cat_pid', '', 'POST'),                   //Form plugin_cat_pid
                'plugin_cat_name'     => Request::getText('plugin_cat_name', '', 'POST'),                 //Form plugin_cat_name
                'plugin_weight'       => Request::getCmd('plugin_weight', '', 'POST'),                    //Form plugin_weight
                'plugin_where'        => Request::getString('plugin_where', '', 'POST'),                   //Form plugin_call
                'plugin_call'         => Request::getString('plugin_call', '', 'POST'),                   //Form plugin_call
                'plugin_submitter'    => Request::getInt('plugin_submitter', 0, 'POST'),                  //Form plugin_submitter
                'plugin_date_created' => strtotime(Request::getString('plugin_date_created', 0, 'POST')), //Form plugin_date_created
                'plugin_online'       => $verif_plugin_online,
            ]                                            //Form plugin_online
        );
        if ($pluginHandler->insert($obj)) {
            $helper->redirect('admin/plugin.php?op=show_list_plugin', 2, _AM_XSITEMAP_FORMOK);
        }
        //require("../include/forms.php");
        echo $obj->getHtmlErrors();
        echo $obj->getForm();
        break;
    case 'edit_plugin':
        $obj = $pluginHandler->get(Request::getInt('plugin_id'));
        if ($obj instanceof Plugin) {
            echo $obj->getForm();
        } else {
            echo _AM_XSITEMAP_ERROR_NO_PLUGIN;
        }
        break;
    case 'delete_plugin':
        $obj = $pluginHandler->get(Request::getInt('plugin_id', 0));
        $ok  = Request::getInt('ok', 0, 'POST');
        if (1 == $ok) {
            //        if (\Xmf\Request::hasVar('ok', 'REQUEST[')) && $_REQUEST["ok"] == 1) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                $helper->redirect('admin/plugin.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($pluginHandler->delete($obj)) {
                $helper->redirect('admin/plugin.php', 3, _AM_XSITEMAP_FORMDELOK);
            } else {
                echo $obj->getHtmlErrors();
            }
        } else {
            xoops_confirm(
                [
                    'ok'        => 1,
                    'plugin_id' => Request::getInt('plugin_id', 0),
                    'op'        => 'delete_plugin',
                ],
                $_SERVER['REQUEST_URI'],
                sprintf(_AM_XSITEMAP_FORMSUREDEL, $obj->getVar('plugin_name'))
            );
        }
        break;
    case 'update_online_plugin':
        if (\Xmf\Request::hasVar('plugin_id', 'REQUEST')) {
            $obj = $pluginHandler->get(Request::getInt('plugin_id'));
        }
        $obj->setVar('plugin_online', Request::getInt('plugin_online', 0));
        if ($pluginHandler->insert($obj)) {
            $helper->redirect('admin/plugin.php', 3, _AM_XSITEMAP_FORMOK);
        }
        echo $obj->getHtmlErrors();
        break;
    case 'default':
    default:
        $templateMain = 'xsitemap_admin_plugins.tpl';
        $adminObject->addItemButton(_AM_XSITEMAP_CREATE_PLUGIN, basename(__FILE__) . '?op=add_plugin', 'add');
        $adminObject->displayButton('left', '');
        $criteria = new \CriteriaCompo();
        $criteria->setSort('plugin_name');
        $criteria->order = 'ASC';
        $numrows         = $pluginHandler->getCount();
        $GLOBALS['xoopsTpl']->assign('plugins_count', $numrows);
        $plugin_arr      = $pluginHandler->getAll($criteria);
        //Display data
        if ($numrows > 0) {
            foreach (array_keys($plugin_arr) as $i) {
                if (0 == $plugin_arr[$i]->getVar('topic_pid')) {
                    $plugin = $plugin_arr[$i]->getValuesPlugins();
                    $GLOBALS['xoopsTpl']->append('plugins_list', $plugin);
                }
            }
        }
        break;
}
require_once __DIR__ . '/admin_footer.php';
