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
 
include "../../mainfile.php";
//template assign
$xoopsOption['template_main'] = 'xsitemap_xml.html' ;

include_once XOOPS_ROOT_PATH."/header.php";
include_once(XOOPS_ROOT_PATH . "/class/tree.php");
include_once XOOPS_ROOT_PATH."/modules/xsitemap/class/plugin.php";
include_once XOOPS_ROOT_PATH."/modules/xsitemap/include/functions.php";
include_once(XOOPS_ROOT_PATH . "/modules/xsitemap/class/xsitemap_class.php");

$xsitemap_configs = $xoopsModuleConfig ;

xsitemap_xml_public();		
$xmlfile = XOOPS_ROOT_PATH."/xsitemap.xml";

$stat = stat($xmlfile);
$last_mod = date("d-m-Y H:i:s",$stat['mtime']);

$xoopsTpl->assign('lastmod', $last_mod);

	
include_once XOOPS_ROOT_PATH."/footer.php";	
?>