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
 *
 */

/**
 * Module: xsitemap
 *
 * @package         module\Xsitemap\admin
 * @author          XOOPS Module Development Team
 * @author          Urbanspaceman (http://www.takeaweb.it)
 * @copyright       Urbanspaceman (http://www.takeaweb.it)
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @link            https://xoops.org XOOPS
 * @since           1.00
 */

use Xmf\Module\Admin;
use Xmf\Request;
use XoopsModules\Xsitemap\{
    Helper,
    Utility
};
/** @var Admin $adminObject */
/** @var Helper $helper */
/** @var Utility $utility */

require_once __DIR__ . '/admin_header.php';
$templateMain = 'xsitemap_admin_xml.tpl';

$moduleDirName = basename(dirname(__DIR__));
xoops_cp_header();
require_once $GLOBALS['xoops']->path('class/tree.php');

$adminObject = Admin::getInstance();
$adminObject->displayNavigation(basename(__FILE__));
$xmlfile     = $GLOBALS['xoops']->path('xsitemap.xml');
$xmlfile_loc = $GLOBALS['xoops']->url('xsitemap.xml');
if (Request::hasVar('update', 'POST')) {
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $helper->redirect('admin/xml.php', 3, $GLOBALS['xoopsSecurity']->getErrors(true));
    }
    $utility       = new Utility();
    $xsitemap_show = $utility::generateSitemap();
    $update        = _AM_XSITEMAP_XML_ERROR_UPDATE;
    if (!empty($xsitemap_show)) {
        $retVal = $utility::saveSitemap($xsitemap_show);
        if (false !== $retVal) {
            $update = sprintf(_AM_XSITEMAP_BYTES_WRITTEN, $retVal) . "\n";
        }
    }
    $GLOBALS['xoopsTpl']->assign('update', $update);
}
if (file_exists($xmlfile)) {
    $GLOBALS['xoopsTpl']->assign('file_exists', true);
    $stat     = stat($xmlfile);
    $last_mod = date(_DATESTRING, $stat['mtime']);

    $GLOBALS['xoopsTpl']->assign('file_location', htmlentities($xmlfile_loc, ENT_QUOTES | ENT_HTML5));
    $GLOBALS['xoopsTpl']->assign('file_lastmod', $last_mod);
    $GLOBALS['xoopsTpl']->assign('file_size', $stat['size']);
    $form = "<form action=xml.php method=post>\n"
         . "  <input type='hidden' name='XOOPS_TOKEN_REQUEST' value='"
         . $GLOBALS['xoopsSecurity']->createToken()
         . "'>\n"
         . "  <input id='viewbtn' type='button' value='"
         . _AM_XSITEMAP_XML_VIEW_XML
         . "' onclick='window.location.href =\""
         . $GLOBALS['xoops']->url('www/xsitemap.xml')
         . "\"'>\n"
         . "  <input style='margin-left: 3em;' type='submit' name='update' value='"
         . _AM_XSITEMAP_MANAGER_UPDATE
         . "'>\n"
         . "</form>\n";
    $GLOBALS['xoopsTpl']->assign('form', $form);
} else {
    $form = _AM_XSITEMAP_CREATE . "\n"
         . "<form action='xml.php' method='post'>\n"
         . "  <input type='hidden' name='XOOPS_TOKEN_REQUEST' value='"
         . $GLOBALS['xoopsSecurity']->createToken()
         . "'>\n"
         . "  <input type='submit' name='update' value='"
         . _AM_XSITEMAP_CREATE
         . "'>\n"
         . "</form>\n"
         . "<br>\n";
    $GLOBALS['xoopsTpl']->assign('form', $form);
}

require_once __DIR__ . '/admin_footer.php';
