<?php
/*
 * xSiteMap module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * @package    module\xsitemap\admin
 * @copyright  http://xoops.org 2001-2017 XOOPS Project
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @author     ZySpec <owners@zyspec.com>
 * @link       http://xoops.org XOOPS
 * @since      1.54
 **/

/**
 * Xoopspoll Core Preload Class
 *
 * class used to check status of mailing polls that have ended.
 *
 * @package    xoopspoll
 * @subpackage class
 */
class XsitemapCorePreload extends XoopsPreloadItem
{
    /**
     * plugin class for Xoops preload for index page start
     * @param $args
     * @return void|bool
     */
    public function eventCoreIndexStart($args)
    {
        // check once per user session if xsitemap exists
        $sessionVar = 'xsitemapChecked';
        $retVal     = true;
        if (empty($_SESSION[$sessionVar])) {
            if (!file_exists(dirname(__DIR__) . '/xsitemap.xml')) {
                require_once dirname(__DIR__) . '/include/functions.php';
                //Create the xsitemap.xml file in the site root
                $xsitemap_show = xsitemap_generate_sitemap();
                $retVal        = xsitemap_save($xsitemap_show) ? true : false;
            }
            $_SESSION[$sessionVar] = 1;
        }
        return $retVal;
    }
}
