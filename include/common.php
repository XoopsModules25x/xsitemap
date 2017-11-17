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

use Xoopsmodules\xsitemap;

$moduleDirName = basename(dirname(__DIR__));

require_once __DIR__ . '/../class/Helper.php';
require_once __DIR__ . '/../class/utility.php';

$db = \XoopsDatabaseFactory::getDatabase();
$helper = xsitemap\Helper::getInstance();

/** @var \Xoopsmodules\xsitemap\Utility $utility */
$utility = new xsitemap\Utility();

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

$helper->loadLanguage('common');

//require_once XSITEMAP_ROOT_PATH . '/class/Utility.php';
//require_once XSITEMAP_ROOT_PATH . '/include/constants.php';
//require_once XSITEMAP_ROOT_PATH . '/include/seo_functions.php';
//require_once XSITEMAP_ROOT_PATH . '/class/metagen.php';
//require_once XSITEMAP_ROOT_PATH . '/class/session.php';
//require_once XSITEMAP_ROOT_PATH . '/class/xoalbum.php';
//require_once XSITEMAP_ROOT_PATH . '/class/request.php';


$pathIcon16    = Xmf\Module\Admin::iconUrl('', 16);
$pathIcon32    = Xmf\Module\Admin::iconUrl('', 32);
$pathModIcon16 = $helper->getModule()->getInfo('modicons16');
$pathModIcon32 = $helper->getModule()->getInfo('modicons32');

$debug = false;

if (!isset($GLOBALS['xoopsTpl']) || !($GLOBALS['xoopsTpl'] instanceof \XoopsTpl)) {
    require_once $GLOBALS['xoops']->path('class/template.php');
    $xoopsTpl = new \XoopsTpl();
}

$GLOBALS['xoopsTpl']->assign('mod_url', XOOPS_URL . '/modules/' . $moduleDirName);

// Local icons path
$GLOBALS['xoopsTpl']->assign('pathModIcon16', XOOPS_URL . '/modules/' . $moduleDirName . '/' . $pathModIcon16);
$GLOBALS['xoopsTpl']->assign('pathModIcon32', $pathModIcon32);

//module handlers

/** @var XsitemapPluginHandler $pluginHandler */
$pluginHandler = $helper->getHandler('plugin');
