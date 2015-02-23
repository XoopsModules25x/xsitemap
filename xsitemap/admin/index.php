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
include '../../../include/cp_header.php'; 
include_once("./admin_header.php");
//$moduleInfo =& $module_handler->get( $xoopsModule->getVar("mid") );
xoops_cp_header();


$index_admin = new ModuleAdmin();

global $xoopsModule;

//Apelle du menu admin
// if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
// xsitemap_adminmenu(0, _AM_XSITEMAP_MANAGER_INDEX);
// } else {
// include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
// loadModuleAdminMenu (0, _AM_XSITEMAP_MANAGER_INDEX);
// }

	//compte "total"
	$count_plugin = $pluginHandler->getCount();
	//compte "attente"
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("plugin_online", 1));
	$plugin_online = $pluginHandler->getCount($criteria);
	
    echo $index_admin->addNavigation('index.php');
	echo $index_admin->renderIndex();

	
// include_once XOOPS_ROOT_PATH."/modules/xsitemap/class/menu.php";

	// $menu = new xsitemapMenu();
	// $menu->addItem("plugin", "plugin.php", "../images/deco/contact.png", _AM_XSITEMAP_MANAGER_PLUGIN);
	// $menu->addItem("xml", "xml.php", "../images/deco/xml.png",  _AM_XSITEMAP_XML);	
	// $menu->addItem("about", "about.php", "../images/deco/about.png", _AM_XSITEMAP_MANAGER_ABOUT);
	// $menu->addItem("preference", "../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule->getVar("mid").
												// "&amp;&confcat_id=1", "../images/deco/pref.png", _AM_XSITEMAP_MANAGER_PREFERENCES);
	// $menu->addItem("update", "../../system/admin.php?fct=modulesadmin&op=update&module=xsitemap", "../images/deco/update.png",  _AM_XSITEMAP_MANAGER_UPDATE);	
	


	
//	echo $menu->getCSS();
	

// echo "<div class=\"CPbigTitle\" style=\"background-image: url(../images/deco/index.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\"><strong>"._AM_XSITEMAP_MANAGER_INDEX."</strong></div><br />
		// <table width=\"100%\" border=\"0\" cellspacing=\"10\" cellpadding=\"4\">
			// <tr>
				// <td valign=\"top\">".$menu->render()."</td>
				// <td valign=\"top\" width=\"60%\">";
				
					// echo "<fieldset>
						// <legend class=\"CPmediumTitle\">"._AM_XSITEMAP_MANAGER_PLUGIN."</legend>
						// <br />";
						// printf(_AM_XSITEMAP_THEREARE_PLUGIN, $count_plugin);
						// echo "<br /><br />";
						// printf(_AM_XSITEMAP_THEREARE_PLUGIN_ONLINE, $plugin_online);
						// echo "<br />
					// </fieldset><br /><br />";
					
				// echo "</td>
			// </tr>
		// </table>
// <br /><br />
// <div align=\"center\">"._AM_XSITEMAP_ABOUT_BY."</div>";
include 'admin_footer.php';

?>