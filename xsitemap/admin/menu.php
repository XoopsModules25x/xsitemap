<?php
/**
 * ****************************************************************************
 * Module généré par TDMCreate de la TDM "http://www.tdmxoops.net"
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
 * @copyright       Urbanspaceman (http://www.takeaweb.it)
 * @license         GPL
 * @package         xsitemap
 * @author 			Urbanspaceman (http://www.takeaweb.it)
 *
 * Version : 1.00:
 * ****************************************************************************
 */
defined("XOOPS_ROOT_PATH") or die("XOOPS root path not defined");

$dirname = basename(dirname(dirname(__FILE__)));
$module_handler = xoops_gethandler('module');
$module = $module_handler->getByDirname($dirname);
$pathIcon32 = $module->getInfo('icons32');

xoops_loadLanguage('admin', $dirname);
 
$adminmenu = array(); 
$i = 1;
$adminmenu[$i]["title"] = _MI_XSITEMAP_MANAGER_INDEX;
$adminmenu[$i]["link"] = "admin/index.php";
$adminmenu[$i]["icon"]  = $pathIcon32 . '/home.png';
$i++;
$adminmenu[$i]["title"] = _MI_XSITEMAP_MANAGER_PLUGIN;
$adminmenu[$i]["link"] = "admin/plugin.php";
$adminmenu[$i]["icon"] = "images/admin/plugin.png";
$i++;
$adminmenu[$i]["title"] = _MI_XSITEMAP_MANAGER_XML;
$adminmenu[$i]["link"] = "admin/xml.php";
$adminmenu[$i]["icon"] = "images/admin/xml.png";
//$i++;
//$adminmenu[$i]["title"] = _MI_XSITEMAP_MANAGER_PERMISSIONS;
//$adminmenu[$i]["link"] = "admin/permissions.php";
$i++;
$adminmenu[$i]["title"] = _MI_XSITEMAP_MANAGER_ABOUT;
$adminmenu[$i]["link"] = "admin/about.php";
$adminmenu[$i]["icon"] = $pathIcon32 . '/about.png';

?>