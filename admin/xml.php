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

//xoops_cp_header();
include 'admin_header.php';
xoops_cp_header();

$index_admin = new ModuleAdmin();

include_once(XOOPS_ROOT_PATH . "/class/tree.php");
include_once XOOPS_ROOT_PATH."/modules/xsitemap/class/plugin.php";
include_once XOOPS_ROOT_PATH."/modules/xsitemap/include/functions.php";
include_once(XOOPS_ROOT_PATH . "/modules/xsitemap/class/xsitemap_class.php");

echo $index_admin->addNavigation('xml.php');

$xmlfile = XOOPS_ROOT_PATH."/xsitemap.xml";
$stat = stat($xmlfile);
$last_mod = date("d-m-Y H:i:s",$stat['mtime']);
//if ( is_readable( $xmlfile ) ){


echo "<div style=\"padding: 8px;\">";
                
                echo ""._AM_XSITEMAP_XML_LASTUPD." ".$last_mod;
                echo "<br/>";
                echo "<br/>";
                echo ""._AM_XSITEMAP_UPDATE_XML."";
                echo "<br/>";
                echo "<br/>";
                echo "<form action=xml.php method=post>
						<input type=submit name=update value="._AM_XSITEMAP_MANAGER_UPDATE.">
					</form><br/>";
                if(isset($_POST['update'])) {
                    xsitemap_xml_admin();
                }
            echo "</div>
	<br clear=\"all\" />";
/*
$site_url = UrlEncode(XOOPS_URL."/modules/xsitemap/xsitemap.xml");
echo "<div>";
echo "invia la sitemap a google <a href='http://www.google.com/webmasters/tools/ping?sitemap=".$site_url."'>CLICCA</a>";
echo "</div>";*/
//}
include 'admin_footer.php';
