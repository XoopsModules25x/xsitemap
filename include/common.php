<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    XOOPS Project https://xoops.org/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package
 * @since
 * @author     XOOPS Development Team
 */

if (!defined('XSITEMAP_MODULE_PATH')) {
    define('XSITEMAP_DIRNAME', basename(dirname(__DIR__)));
    define('XSITEMAP_URL', XOOPS_URL . '/modules/' . XSITEMAP_DIRNAME);
    define('XSITEMAP_IMAGE_URL', XSITEMAP_URL . '/assets/images/');
    define('XSITEMAP_ROOT_PATH', XOOPS_ROOT_PATH . '/modules/' . XSITEMAP_DIRNAME);
    define('XSITEMAP_IMAGE_PATH', XSITEMAP_ROOT_PATH . '/assets/images');
    define('XSITEMAP_ADMIN_URL', XSITEMAP_URL . '/admin/');
    define('XSITEMAP_UPLOAD_URL', XOOPS_UPLOAD_URL . '/' . XSITEMAP_DIRNAME);
    define('XSITEMAP_UPLOAD_PATH', XOOPS_UPLOAD_PATH . '/' . XSITEMAP_DIRNAME);
}
xoops_loadLanguage('common', XSITEMAP_DIRNAME);

require_once XSITEMAP_ROOT_PATH . '/include/functions.php';
//require_once XSITEMAP_ROOT_PATH . '/include/constants.php';
//require_once XSITEMAP_ROOT_PATH . '/include/seo_functions.php';
//require_once XSITEMAP_ROOT_PATH . '/class/metagen.php';
//require_once XSITEMAP_ROOT_PATH . '/class/session.php';
//require_once XSITEMAP_ROOT_PATH . '/class/xoalbum.php';
//require_once XSITEMAP_ROOT_PATH . '/class/request.php';


$debug = false;
//$xoalbum = XoalbumXoalbum::getInstance($debug);
