<?php
/**
 * xSiteMap module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright::  The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license::    {@link http://www.gnu.org/licenses/gpl-2.0.html GNU Public License}
 * @package::    xSiteMap
 * @subpackage:: admin
 * @since::		 2.5.0
 * @author::     XOOPS Team
 * @version::    $Id $
**/



$path = dirname(dirname(dirname(dirname(__FILE__))));
include_once $path . '/mainfile.php';
include_once $path . '/include/cp_functions.php';
require_once $path . '/include/cp_header.php';

global $xoopsModule;

$thisModuleDir = $GLOBALS['xoopsModule']->getVar('dirname');

//if functions.php file exist
require_once dirname(dirname(__FILE__)) . '/include/functions.php';
include_once dirname(dirname(__FILE__)) . '/class/plugin.php';

// Load language files
xoops_loadLanguage('admin', $thisModuleDir);
xoops_loadLanguage('modinfo', $thisModuleDir);
xoops_loadLanguage('main', $thisModuleDir);

$pathIcon16 = '../'.$xoopsModule->getInfo('icons16');
$pathIcon32 = '../'.$xoopsModule->getInfo('icons32');
$pathModuleAdmin = $xoopsModule->getInfo('dirmoduleadmin');

if ( file_exists($GLOBALS['xoops']->path($pathModuleAdmin.'/moduleadmin.php'))){
        include_once $GLOBALS['xoops']->path($pathModuleAdmin.'/moduleadmin.php');
    }else{
        redirect_header("../../../admin.php", 5, _AM_XSITEMAP_MODULEADMIN_MISSING, false);
    }


function xsitemap_adminmenu ($currentoption = 0, $breadcrumb = "")
{
	global $xoopsModule, $xoopsConfig;

	echo "
    	<style type=\"text/css\">
    	#buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }
    	#buttonbar { float:left; width:100%; background: #e7e7e7 url(".XOOPS_URL."/modules/xsitemap/images/menu/bg.png) repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px; }
    	#buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
		#buttonbar li { display:inline; margin:0; padding:0; }
		#buttonbar a { float:left; background:url(".XOOPS_URL."/modules/xsitemap/images/deco/left_both.png) no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; }
		#buttonbar a span { float:left; display:block; background:url(".XOOPS_URL."/modules/xsitemap/images/deco/right_both.png) no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
		#buttonbar a span {float:none;}
		#buttonbar a:hover span { color:#333; }
		#buttonbar #current a { background-position:0 -150px; border-width:0; }
		#buttonbar #current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
		#buttonbar a:hover { background-position:0% -150px; }
		#buttonbar a:hover span { background-position:100% -150px; }
		</style>
    ";

	$tblColors = Array();
	$tblColors[0] = $tblColors[1] = $tblColors[2] = $tblColors[3] = $tblColors[4] = $tblColors[5] = $tblColors[6] = $tblColors[7] = $tblColors[8] = "";
	$tblColors[$currentoption] = "current";
	if (file_exists("".XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar("dirname")."/language/".$xoopsConfig["language"]."/modinfo.php")) {
		include_once("".XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar("dirname")."/language/".$xoopsConfig["language"]."/modinfo.php");
	} else {
		include_once("".XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar("dirname")."/english/modinfo.php");
	}

	echo "<div id=\"buttontop\">
			<table style=\"width: 100%; padding: 0;\" cellspacing=\"0\">
				<tr>
					<td style=\"font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;\">
					  <a class=\"nobutton\" href=\"".XOOPS_URL."/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$myts->displayTarea($xoopsModule->getVar("mid"))."\">_AM_XSITEMAP_GENERALSET</a>
					| <a href=\"".XOOPS_URL."/modules/xsitemap/index.php\">_AM_XSITEMAP_GOINDEX</a>
					| <a href=\"".XOOPS_URL."/modules/xsitemap/admin/upgrade.php\">_AM_XSITEMAP_UPGRADE</a>
					</td>
					<td style=\"font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;\"><b>".$myts->displayTarea($xoopsModule->name())."</b></td>
				</tr>
			</table>
		  </div>

		  <div id=\"buttonbar\">
			<ul><li id=\"$tblColors[0]\"><a href=\"".XOOPS_URL."/modules/xsitemap/admin/index.php\"><span>_MI_XSITEMAP_MANAGER_INDEX</span></a></li>
				<li id=\"$tblColors[1]\"><a href=\"".XOOPS_URL."/modules/xsitemap/admin/plugin.php\"><span>_MI_XSITEMAP_MANAGER_PLUGIN</span></a></li>

				<li id=\"$tblColors[2]\"><a href=\"".XOOPS_URL."/modules/xsitemap/admin/permissions.php\"><span>_MI_XSITEMAP_MANAGER_PERMISSIONS</span></a></li>
				<li id=\"$tblColors[3]\"><a href=\"".XOOPS_URL."/modules/xsitemap/admin/about.php\"><span>_MI_XSITEMAP_MANAGER_ABOUT</span></a></li>
			</ul></div>";
}

$pluginHandler =& xoops_getModuleHandler("xsitemap_plugin", "xsitemap");
?>