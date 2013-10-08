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

include 'admin_header.php';

xoops_cp_header();
$index_admin = new ModuleAdmin();


if (isset($_REQUEST["op"])) {
	$op = $_REQUEST["op"];
} else {
	@$op = "show_list_plugin";
}

echo $index_admin->addNavigation('plugin.php');
	
switch ($op) 
{	
	case "save_plugin":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("plugin.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["plugin_id"])) {
           $obj =& $pluginHandler->get($_REQUEST["plugin_id"]);
        } else {
           $obj =& $pluginHandler->create();
        }
		
		//Form plugin_name
		$obj->setVar("plugin_name", $_REQUEST["plugin_name"]);
		//Form plugin_mod_version
		$obj->setVar("plugin_mod_version", $_REQUEST["plugin_mod_version"]);
		//Form plugin_mod_table
		$obj->setVar("plugin_mod_table", $_REQUEST["plugin_mod_table"]);
		//Form plugin_cat_id
		$obj->setVar("plugin_cat_id", $_REQUEST["plugin_cat_id"]);
		//Form plugin_cat_pid
		$obj->setVar("plugin_cat_pid", $_REQUEST["plugin_cat_pid"]);
		//Form plugin_cat_name
		$obj->setVar("plugin_cat_name", $_REQUEST["plugin_cat_name"]);
		//Form plugin_weight
		$obj->setVar("plugin_weight", $_REQUEST["plugin_weight"]);
		//Form plugin_call
		$obj->setVar("plugin_call", $_REQUEST["plugin_call"]);
		//Form plugin_submitter
		$obj->setVar("plugin_submitter", $_REQUEST["plugin_submitter"]);
		//Form plugin_date_created
		$obj->setVar("plugin_date_created", strtotime($_REQUEST["plugin_date_created"]));
		//Form plugin_online
		$verif_plugin_online = ($_REQUEST["plugin_online"] == 1) ? "1" : "0";
		$obj->setVar("plugin_online", $verif_plugin_online);
		
		
        if ($pluginHandler->insert($obj)) {
           redirect_header("plugin.php?op=show_list_plugin", 2, _AM_XSITEMAP_FORMOK);
        }
        //include_once("../include/forms.php");
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_plugin":
		$obj = $pluginHandler->get($_REQUEST["plugin_id"]);
		$form = $obj->getForm();
	break;
	
	case "delete_plugin":
		$obj =& $pluginHandler->get($_REQUEST["plugin_id"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("plugin.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($pluginHandler->delete($obj)) {
				redirect_header("plugin.php", 3, _AM_XSITEMAP_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "plugin_id" => $_REQUEST["plugin_id"], "op" => "delete_plugin"), $_SERVER["REQUEST_URI"], sprintf(_AM_XSITEMAP_FORMSUREDEL, $obj->getVar("plugin")));
		}
	break;
	
	case "update_online_plugin":
		
	if (isset($_REQUEST["plugin_id"])) {
		$obj =& $pluginHandler->get($_REQUEST["plugin_id"]);
	} 
	$obj->setVar("plugin_online", $_REQUEST["plugin_online"]);

	if ($pluginHandler->insert($obj)) {
		redirect_header("plugin.php", 3, _AM_XSITEMAP_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("plugin_name");
		$criteria->setOrder("ASC");
		$numrows = $pluginHandler->getCount();
		$plugin_arr = $pluginHandler->getall($criteria);
		
			//Affichage du tableau
			if ($numrows>0) 
			{			
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						<th align=\"center\">"._AM_XSITEMAP_PLUGIN_NAME."</th>
						<th align=\"center\">"._AM_XSITEMAP_PLUGIN_MOD_VERSION."</th>
						<th align=\"center\">"._AM_XSITEMAP_PLUGIN_MOD_TABLE_SHORT."</th>
						<th align=\"center\">"._AM_XSITEMAP_PLUGIN_CAT_ID_SHORT."</th>
						<th align=\"center\">"._AM_XSITEMAP_PLUGIN_CAT_PID_SHORT."</th>
						<th align=\"center\">"._AM_XSITEMAP_PLUGIN_CAT_NAME_SHORT."</th>
						<th align=\"center\">"._AM_XSITEMAP_PLUGIN_WEIGHT_SHORT."</th>
						<th align=\"center\">"._AM_XSITEMAP_PLUGIN_CALL_SHORT."</th>
						<th align=\"center\">"._AM_XSITEMAP_PLUGIN_SUBMITTER."</th>
						<th align=\"center\">"._AM_XSITEMAP_PLUGIN_DATE_CREATED."</th>
						<th align=\"center\">"._AM_XSITEMAP_PLUGIN_ONLINE."</th>
						
						<th align=\"center\" width=\"10%\">"._AM_XSITEMAP_FORMACTION."</th>
					</tr>";
						
				$class = "odd";
				
				foreach (array_keys($plugin_arr) as $i) 
				{	
					if ( $plugin_arr[$i]->getVar("topic_pid") == 0)
					{
						echo "<tr class=\"".$class."\">";
						$class = ($class == "even") ? "odd" : "even";
						echo "<td align=\"center\">".$plugin_arr[$i]->getVar("plugin_name")."</td>";	
					echo "<td align=\"center\">".$plugin_arr[$i]->getVar("plugin_mod_version")."</td>";	
					echo "<td align=\"center\">".$plugin_arr[$i]->getVar("plugin_mod_table")."</td>";	
					echo "<td align=\"center\">".$plugin_arr[$i]->getVar("plugin_cat_id")."</td>";	
					echo "<td align=\"center\">".$plugin_arr[$i]->getVar("plugin_cat_pid")."</td>";	
					echo "<td align=\"center\">".$plugin_arr[$i]->getVar("plugin_cat_name")."</td>";	
					echo "<td align=\"center\">".$plugin_arr[$i]->getVar("plugin_weight")."</td>";	
					echo "<td align=\"center\">".$plugin_arr[$i]->getVar("plugin_call")."</td>";	
					echo "<td align=\"center\">".XoopsUser::getUnameFromId($plugin_arr[$i]->getVar("plugin_submitter"),"S")."</td>";	
					echo "<td align=\"center\">".formatTimeStamp($plugin_arr[$i]->getVar("plugin_date_created"),"S")."</td>";	
					
					$online = $plugin_arr[$i]->getVar("plugin_online");
				
					if( $online == 1 ) {
						echo "<td align=\"center\"><a href=\"./plugin.php?op=update_online_plugin&plugin_id=".$plugin_arr[$i]->getVar("plugin_id")."&plugin_online=0\"><img src=\"./../images/icons/on.png\" border=\"0\" alt=\""._AM_XSITEMAP_ON."\" title=\""._AM_XSITEMAP_ON."\"></a></td>";	
					} else {
						echo "<td align=\"center\"><a href=\"./plugin.php?op=update_online_plugin&plugin_id=".$plugin_arr[$i]->getVar("plugin_id")."&plugin_online=1\"><img src=\"./../images/icons/off.png\" border=\"0\" alt=\""._AM_XSITEMAP_OFF."\" title=\""._AM_XSITEMAP_OFF."\"></a></td>";
					}
									echo "<td align=\"center\" width=\"10%\">
										<a href=\"plugin.php?op=edit_plugin&plugin_id=".$plugin_arr[$i]->getVar("plugin_id")."\"><img src=\"../images/icons/edit.png\" alt=\""._AM_XSITEMAP_EDIT."\" title=\""._AM_XSITEMAP_EDIT."\"></a>
										<a href=\"plugin.php?op=delete_plugin&plugin_id=".$plugin_arr[$i]->getVar("plugin_id")."\"><img src=\"../images/icons/delete.png\" alt=\""._AM_XSITEMAP_DELETE."\" title=\""._AM_XSITEMAP_DELETE."\"></a>
									  </td>";
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		
		// Affichage du formulaire
    	$obj =& $pluginHandler->create();
    	$form = $obj->getForm();	
}

include 'admin_footer.php';
?>