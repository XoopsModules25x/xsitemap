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
 * @author             Urbanspaceman (http://www.takeaweb.it)
 *
 * Version : 1.00:
 * ****************************************************************************
 */
 
 //show map
function xsitemap_show_sitemap()

{
    global $xoopsUser, $xoopsConfig, $xoopsModuleConfig;
    
    $block = array();
    
    // moduli da non visualizzare
    $invisible_dirnames = empty( $xoopsModuleConfig['invisible_dirnames'] ) ? '' : str_replace( ' ' , '' , $xoopsModuleConfig['invisible_dirnames'] ) . ',' ;

    $module_handler =& xoops_gethandler('module');
    $criteria = new CriteriaCompo(new Criteria('hasmain', 1));
    $criteria->add(new Criteria('isactive', 1));
    
    $modules =& $module_handler->getObjects($criteria, true);

    $moduleperm_handler =& xoops_gethandler('groupperm');
    $groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
    $read_allowed = $moduleperm_handler->getItemIds('module_read', $groups);
    $pluginHandler =& xoops_getModuleHandler("xsitemap_plugin", "xsitemap");
    foreach (array_keys($modules) as $i) {
        
        if (in_array($i, $read_allowed) && ! stristr( $invisible_dirnames , $modules[$i]->getVar('dirname').',' )) {
            if ($modules[$i]->getVar('dirname') == 'xsitemap') {
                continue;
            }
            $block['modules'][$i]['id'] = $i;
            $block['modules'][$i]['name'] = $modules[$i]->getVar('name');
            $block['modules'][$i]['directory'] = $modules[$i]->getVar('dirname');
            
            $old_error_reporting = error_reporting() ;
            error_reporting( $old_error_reporting & (~E_NOTICE) ) ;
            $sublinks =& $modules[$i]->subLink();
            
            error_reporting( $old_error_reporting ) ;
            if (count($sublinks) > 0) {
                foreach($sublinks as $sublink){
                    $block['modules'][$i]['sublinks'][] = array('name' => $sublink['name'], 'url' => XOOPS_URL.'/modules/'.$modules[$i]->getVar('dirname').'/'.$sublink['url']);
                }
            } else {
                $block['modules'][$i]['sublinks'] = array();
            }
        }
            $criteria = new CriteriaCompo();
            $criteria->setSort("plugin_id");
            $criteria->setOrder("ASC");
            
            $plugin_arr = $pluginHandler->getall($criteria);
            
            foreach (array_keys($plugin_arr) as $x) {
                    if ( $plugin_arr[$x]->getVar("topic_pid") == 0 && in_array($plugin_arr[$x]->getVar("plugin_mod_table"), (array) $modules[$i]->getInfo('tables')))
                    {
                        $table = $plugin_arr[$x]->getVar("plugin_mod_table");
                        $id_name = $plugin_arr[$x]->getVar("plugin_cat_id");
                        $pid_name = $plugin_arr[$x]->getVar("plugin_cat_pid");
                        
                        $title_name = $plugin_arr[$x]->getVar("plugin_cat_name");
                        $url = $plugin_arr[$x]->getVar("plugin_call");
                        $order= $plugin_arr[$x]->getVar("plugin_weight");
                        $online = $plugin_arr[$x]->getVar("plugin_online");
                            
                        if( $online == 1 ) {
                                $_tmp = xsitemap_get_map ($table, $id_name, $pid_name, $title_name, $url, $order);
                                $block['modules'][$i]['parent'] = isset($_tmp['parent']) ? $_tmp['parent'] : null;
                            }
                        }
                            
                    }
                }
                
    return $block;
}

//Get map
function xsitemap_get_map($table, $id_name, $pid_name, $title_name, $url, $order = ""){
    global $xoopsModuleConfig;
    

    $xoopsDB =& XoopsDatabaseFactory::getDatabaseConnection();

    $xsitemap = array();
    $myts =& MyTextSanitizer::getInstance();

    $sql = "SELECT `$id_name`, `$pid_name`, `$title_name` FROM ".$xoopsDB->prefix."_"."$table" ;
    $result = $xoopsDB->query($sql);
    //print $sql."\n";
    $objsArray = array();
    while ($row = $xoopsDB->fetchArray($result)) {
        $objsArray[] = new XoopsDummyObject($row, $id_name, $pid_name, $title_name);
    }
    $mytree = new XoopsObjectTree($objsArray, $id_name, $pid_name);

    $i = 0;
    $sql = "SELECT `$id_name`, `$title_name` FROM ".$xoopsDB->prefix."_"."$table WHERE `$pid_name`= 0" ;
    if ($order != '')
    {
        $sql .= " ORDER BY `$order`" ;
    }
    //print $sql."\n";
    $result = $xoopsDB->query($sql);

    while (list($catid, $name) = $xoopsDB->fetchRow($result))
    
    {
        
        $xsitemap['parent'][$i]['id'] = $catid;
        $xsitemap['parent'][$i]['title'] = $myts->htmlSpecialChars( $name ) ;
        $xsitemap['parent'][$i]['url'] = $url.$catid;

        if($xoopsModuleConfig["show_subcategories"]){
            $j = 0;
    
            $child_array = $mytree->getAllChild($catid);
            
            foreach ($child_array as $child)
            {
                $xsitemap['parent'][$i]['child'][$j]['id'] = $child->getVar($id_name);
                $xsitemap['parent'][$i]['child'][$j]['title'] = $child->getVar($title_name);
                $xsitemap['parent'][$i]['child'][$j]['url'] = $url.$child->getVar($id_name);
                $j++;
            }
        }
        $i++;
    }

    return $xsitemap;

}
function xsitemap_xml_public(){
    $xsitemap_show = xsitemap_show_sitemap();

        if ($xsitemap_show != 0) {
            //$file= fopen(XOOPS_ROOT_PATH."/modules/xsitemap/xsitemap.xml", "w");
            $file= fopen(XOOPS_ROOT_PATH."/xsitemap.xml", "w");
            
            //intestazione xml
            $_xml ="<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";
            $_xml .="<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\r\n";

        foreach ($xsitemap_show['modules'] as $mod){
            if ($mod["directory"]) {
            
            //scrivo l'xml	del modulo
                $_xml .="<url>";
                $_xml .="\t\t<loc>" . XOOPS_URL."/modules/".$mod["directory"]."/index.php</loc>\r\n";
                $_xml .="</url>";
                
                    if ($mod["parent"]) {
                        foreach ($mod["parent"] as $parent){
                            $_xml .="<url>";
                            $_xml .="\t\t<loc>" . XOOPS_URL."/modules/".$mod["directory"]."/".$parent["url"]."</loc>\r\n";
                            $_xml .="</url>";
                        }
                    $z = 0;
                    if ($mod["parent"][$z]["child"]) {
                        foreach ($mod["parent"][$z]["child"] as $child){
                            $_xml .="<url>";
                            $_xml .="\t\t<loc>" . XOOPS_URL."/modules/".$mod["directory"]."/".$child["url"]."</loc>\r\n";
                            $_xml .="</url>";
                        }
                    $z++;
                    }
                }

        } else {

        $_xml .="\t<page title=\"Nothing Returned\">\r\n";
        $_xml .="\t\t<loc>none</loc>\r\n";

        $_xml .="\t</page>\r\n";
        }
    }
    
    $_xml .="</urlset>";
    
    //scrivo il file xml
    fwrite($file, $_xml);
    fclose($file);

    $update = (_MA_XSITEMAP_XML_UPDATE).  "<a href=\"".XOOPS_URL."/xsitemap.xml\"> <br/>"._MA_XSITEMAP_XML_VIEW_XML."</a>";

    } else {

    $update = _MA_XSITEMAP_XML_ERROR_UPDATE;

    }
    print $update;
}

function xsitemap_xml_admin(){
    $xsitemap_show = xsitemap_show_sitemap();

        if ($xsitemap_show != 0) {
            //$file= fopen("xsitemap.xml", "w");
            //$file= fopen(XOOPS_ROOT_PATH."/modules/xsitemap/xsitemap.xml", "w");
            $file= fopen(XOOPS_ROOT_PATH."/xsitemap.xml", "w");
            
            //intestazione xml
            $_xml ="<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";
            $_xml .="<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\r\n";

        foreach ($xsitemap_show['modules'] as $mod){
            if ($mod["directory"]) {
            
            //scrivo l'xml	del modulo
                $_xml .="<url>";
                $_xml .="\t\t<loc>" . XOOPS_URL."/modules/".$mod["directory"]."/index.php</loc>\r\n";
                $_xml .="</url>";

                    if (isset($mod['parent']) ? $mod['parent'] : null) {
                        foreach ($mod["parent"] as $parent){
                            $_xml .="<url>";
                            $_xml .="\t\t<loc>" . XOOPS_URL."/modules/".$mod["directory"]."/".$parent["url"]."</loc>\r\n";
                            $_xml .="</url>";
                        }
                    $z = 0;
                    //if ($mod["parent"][$z]["child"]) {
                    if (isset($mod["parent"][$z]["child"]) ? $mod["parent"][$z]["child"] : null) {

                        foreach ($mod["parent"][$z]["child"] as $child){
                            $_xml .="<url>";
                            $_xml .="\t\t<loc>" . XOOPS_URL."/modules/".$mod["directory"]."/".$child["url"]."</loc>\r\n";
                            $_xml .="</url>";
                        }
                    $z++;
                    }
                }

        } else {

        $_xml .="\t<page title=\"Nothing Returned\">\r\n";
        $_xml .="\t\t<loc>none</loc>\r\n";

        $_xml .="\t</page>\r\n";
        }
    }
    
    $_xml .="</urlset>";
    
    //scrivo il file xml
    fwrite($file, $_xml);
    fclose($file);

    $update = (_AM_XSITEMAP_XML_UPDATE).  "<a href=\"".XOOPS_URL."/xsitemap.xml\"> <br/>"._AM_XSITEMAP_XML_VIEW_XML."</a>";

    } else {

    $update = _AM_XSITEMAP_XML_ERROR_UPDATE;

    }
    print $update;
}

function xsitemap_install(){
    $xsitemap_show = xsitemap_show_sitemap();

        if ($xsitemap_show != 0) {
            $file= fopen(XOOPS_ROOT_PATH."/xsitemap.xml", "w");
            
            //intestazione xml
            $_xml ="<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";
            $_xml .="<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\r\n";

        foreach ($xsitemap_show['modules'] as $mod){
            if ($mod["directory"]) {
            
            //scrivo l'xml	del modulo
                $_xml .="<url>";
                $_xml .="\t\t<loc>" . XOOPS_URL."/modules/".$mod["directory"]."/index.php</loc>\r\n";
                $_xml .="</url>";
                
                    if ($mod["parent"]) {
                        foreach ($mod["parent"] as $parent){
                            $_xml .="<url>";
                            $_xml .="\t\t<loc>" . XOOPS_URL."/modules/".$mod["directory"]."/".$parent["url"]."</loc>\r\n";
                            $_xml .="</url>";
                        }
                    $z = 0;
                    if ($mod["parent"][$z]["child"]) {
                        foreach ($mod["parent"][$z]["child"] as $child){
                            $_xml .="<url>";
                            $_xml .="\t\t<loc>" . XOOPS_URL."/modules/".$mod["directory"]."/".$child["url"]."</loc>\r\n";
                            $_xml .="</url>";
                        }
                    $z++;
                    }
                }

        } else {

        $_xml .="\t<page title=\"Nothing Returned\">\r\n";
        $_xml .="\t\t<loc>none</loc>\r\n";

        $_xml .="\t</page>\r\n";
        }
    }
    
    $_xml .="</urlset>";
    
    //scrivo il file xml
    fwrite($file, $_xml);
    fclose($file);

    $update = (_AM_XSITEMAP_XML_UPDATE).  "<a href=\"".XOOPS_URL."/xsitemap.xml\"> <br/>"._AM_XSITEMAP_XML_VIEW_XML."</a>";

    } else {

    $update = _AM_XSITEMAP_XML_ERROR_UPDATE;

    }
    
}
//**********************************************************************************************************************
// ModuleName_checkModuleAdmin
//**********************************************************************************************************************
// return true if moduladmin framworks exists.
//**********************************************************************************************************************
function checkModuleAdmin()
{
    if ( file_exists($GLOBALS['xoops']->path('/Frameworks/moduleclasses/moduleadmin/moduleadmin.php'))){
        include_once $GLOBALS['xoops']->path('/Frameworks/moduleclasses/moduleadmin/moduleadmin.php');

        return true;
    }else{
        echo xoops_error("Error: You don't use the Frameworks \"ModuleAdmin class\". Please install this class in Frameworks ");

        return false;
    }
}
