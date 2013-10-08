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
 * @version		    $Id $
 * ****************************************************************************
 */
 
	
	$modversion["name"] = "xSiteMap";
	$modversion["version"] = 1.52;
	$modversion['description']	= _MI_XSITEMAP_DESC;
	$modversion["author"] = "Urbanspaceman";
	$modversion["author_website_url"] = "http://www.takeaweb.it";
	$modversion["author_website_name"] = "TAKEAWEB";
	$modversion["credits"] = "astueo.com (CSS Stylesheet), Mage, Mamba";
    $modversion['license'] = 'GNU GPL 2.0';
    $modversion['license_url'] = "www.gnu.org/licenses/gpl-2.0.html";
    $modversion['help'] = 'page=help';	
	$modversion["release_info"] = "This is a new module for SITEMAP written and tested only in XOOPS 2.3.x";
	$modversion["release_file"] = "";
	$modversion["manual"] = "";
	$modversion["manual_file"] = "";
	$modversion["image"] = "images/logo.png";
	$modversion["dirname"] = "xsitemap";
    $modversion['dirmoduleadmin'] = '/Frameworks/moduleclasses/moduleadmin';
    $modversion['icons16'] = '../../Frameworks/moduleclasses/icons/16';
    $modversion['icons32'] = '../../Frameworks/moduleclasses/icons/32';
    $modversion['min_php']='5.2';
    $modversion['min_xoops']="2.5.6";
    $modversion['min_admin']='1.1';
    $modversion['min_db']= array('mysql'=>'5.0.7', 'mysqli'=>'5.0.7');

	//about
	$modversion["demo_site_url"] = "http://www.takeaweb.it";
	$modversion["demo_site_name"] = "Takeaweb ";
    $modversion["module_website_url"] = "www.xoops.org";
    $modversion["module_website_name"] = "XOOPS";
	$modversion["release_date"] = "2012/12/22";
	$modversion["module_status"] = "Final";
	
	// Admin things
	$modversion["hasAdmin"] = 1;
	
	$modversion["adminindex"] = "admin/index.php";
	$modversion["adminmenu"] = "admin/menu.php";
	
	
	// Mysql file
	$modversion["sqlfile"]["mysql"] = "sql/mysql.sql";

	// Tables
	$modversion["tables"][0] = "xsitemap_plugin";
	
	// Scripts to run upon installation or update
	$modversion["onInstall"] = "include/install.php";
	//$modversion["onUpdate"] = "include/update.php";
	
	// Menu
	$modversion["hasMain"] = 1;
    $modversion['system_menu'] = 1;

	
	//Templates	
	$i = 1;
	$modversion['templates'][$i]['file'] = 'xsitemap_index.html';
	$modversion['templates'][$i]['description'] = '';
	$i++;
	
	$modversion['templates'][$i]['file'] = 'xsitemap_slickmap.html';
	$modversion['templates'][$i]['description'] = '';
	$i++;
	
	$modversion['templates'][$i]['file'] = 'xsitemap_style.html';
	$modversion['templates'][$i]['description'] = '';
	$i++;
		
	$modversion['templates'][$i]['file'] = 'xsitemap_xml.html';
	$modversion['templates'][$i]['description'] = '';
	$i++;
	
	// Preferences
	$i = 1;
	$modversion['config'][$i]['name'] = 'show_subcategories';
	$modversion['config'][$i]['title'] = '_MI_XSITEMAP_SHOW_PARENT';
	$modversion['config'][$i]['description'] = '_MI_XSITEMAP_SHOW_PARENT_DESC';
	$modversion['config'][$i]['formtype'] = 'yesno';
	$modversion['config'][$i]['valuetype'] = 'int';
	$modversion['config'][$i]['default'] = 1;
	$i++;

	$modversion['config'][$i]['name'] = 'show_sublink';
	$modversion['config'][$i]['title'] = '_MI_XSITEMAP_SHOW_ACTION';
	$modversion['config'][$i]['description'] = '_MI_XSITEMAP_SHOW_ACTION_DESC';
	$modversion['config'][$i]['formtype'] = 'yesno';
	$modversion['config'][$i]['valuetype'] = 'int';
	$modversion['config'][$i]['default'] = 1;
	$i++;

	$modversion['config'][$i]['name'] = 'invisible_dirnames';
	$modversion['config'][$i]['title'] = '_MI_XSITEMAP_DIRNAMES';
	$modversion['config'][$i]['description'] = '_MI_XSITEMAP_DIRNAMES_DESC';
	$modversion['config'][$i]['formtype'] = 'textbox';
	$modversion['config'][$i]['valuetype'] = 'text';
	$i++;
	
	$modversion['config'][$i]['name'] = 'columns_number';
	$modversion['config'][$i]['title'] = '_MI_XSITEMAP_COLS';
	$modversion['config'][$i]['description'] = '_MI_XSITEMAP_COLS_DESC';
	$modversion['config'][$i]['formtype'] = 'select';
	$modversion['config'][$i]['valuetype'] = 'int';
	$modversion['config'][$i]['default'] = 4;
	$modversion['config'][$i]['options'] = array('1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10);
	$i++;
?>