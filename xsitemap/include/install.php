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
 
//28/08/2009 by urbanspaceman

include_once(XOOPS_ROOT_PATH . "/class/tree.php");
include_once XOOPS_ROOT_PATH."/modules/xsitemap/class/plugin.php";
include_once XOOPS_ROOT_PATH."/modules/xsitemap/include/functions.php";
include_once(XOOPS_ROOT_PATH . "/modules/xsitemap/class/xsitemap_class.php");
$xsitemap_configs = $xoopsModuleConfig ;
 
$indexFile = XOOPS_ROOT_PATH."/modules/xsitemap/include/index.html";
$blankFile = XOOPS_ROOT_PATH."/modules/xsitemap/images/icons/blank.gif";

//Creation du dossier "uploads" pour le module à la racine du site
$module_uploads = XOOPS_ROOT_PATH."/uploads/xsitemap";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/xsitemap/index.html");

//Creation du fichier plugin dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/xsitemap/plugin";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/xsitemap/plugin/index.html");

//Creazione del file xsitemap.xml nella root del sito
xsitemap_install();		
				
?>