<?php
/*
 * ****************************************************************************
 * xsitemap - MODULE FOR XOOPS CMS
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * ****************************************************************************
 */
/**
 * @package    module\xsitemap\frontside
 * @author     Urbanspaceman (http://www.takeaweb.it)
 * @copyright  Urbanspaceman (http://www.takeaweb.it)
 * @copyright  XOOPS Project (http://xoops.org)
 * @license    http://www.fsf.org/copyleft/gpl.html GNU public license
 * @link       http://xoops.org XOOPS
 */
$moduleDirName = basename(__DIR__);

$modversion['version']             = 1.54;
$modversion['module_status']       = 'Beta 1';
$modversion['release_date']        = '2017/05/02';
$modversion['name']                = _MI_XSITEMAP_NAME;
$modversion['description']         = _MI_XSITEMAP_DESC;
$modversion['author']              = 'Urbanspaceman';
$modversion['author_website_url']  = 'http://www.takeaweb.it';
$modversion['author_website_name'] = 'TAKEAWEB';
$modversion['credits']             = 'astueo.com (CSS Stylesheet), Mage, Mamba';
$modversion['license']             = 'GNU GPL 2.0';
$modversion['license_url']         = 'www.gnu.org/licenses/gpl-2.0.html';
$modversion['help']                = 'page=help';
$modversion['release_info']        = 'This is a SITEMAP module written for XOOPS 2.5.8+';
$modversion['release_file']        = '';
$modversion['manual']              = '';
$modversion['manual_file']         = '';
$modversion['image']               = 'assets/images/logoModule.png';
$modversion['dirname']             = $moduleDirName;
$modversion['modicons16']          = 'assets/images/icons/16';
$modversion['modicons32']          = 'assets/images/icons/32';
$modversion['min_php']             = '5.5';
$modversion['min_xoops']           = '2.5.8';
$modversion['min_admin']           = '1.2';
$modversion['min_db']              = array('mysql' => '5.5');

// About
$modversion['module_website_name'] = 'XOOPS';
$modversion['module_website_url']  = 'www.xoops.org';
$modversion['release_file']        = $GLOBALS['xoops']->url("www/modules/{$moduleDirName}/docs/changelog.txt");

// Admin things
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu']  = 'admin/menu.php';

// Mysql file
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables
$modversion['tables'] =  array(
    $moduleDirName . '_' . 'plugin'
);

// Scripts to run upon installation or update
$modversion['onInstall']   = 'include/action.module.php';
$modversion['onUpdate']    = 'include/action.module.php';
$modversion['onUninstall'] = 'include/action.module.php';

// Menu
$modversion['hasMain']     = 1;
$modversion['system_menu'] = 1;

// ------------------- Help files ------------------- //
$modversion['helpsection'] = [
    ['name' => _MI_XSITEMAP_OVERVIEW, 'link' => 'page=help'],
    ['name' => _MI_XSITEMAP_DISCLAIMER, 'link' => 'page=disclaimer'],
    ['name' => _MI_XSITEMAP_LICENSE, 'link' => 'page=license'],
    ['name' => _MI_XSITEMAP_SUPPORT, 'link' => 'page=support']
];

//Templates
$modversion['templates'] = array(
    array(
        'file'        => 'xsitemap_index.tpl',
        'description' => ''
    ),

    array(
        'file'        => 'xsitemap_slickmap.tpl',
        'description' => ''
    ),
    /*
                                      array(file' => 'xsitemap_style.tpl',
                                     description' => ''),
    */
    array(
        'file'        => 'xsitemap_xml.tpl',
        'description' => ''
    ),

    array(
        'file'        => 'admin/xsitemap_index.tpl',
        'description' => ''
    )
);

// Preferences
$modversion['config'] = array(
    array(
        'name'        => 'show_subcategories',
        'title'       => '_MI_XSITEMAP_SHOW_PARENT',
        'description' => '_MI_XSITEMAP_SHOW_PARENT_DESC',
        'formtype'    => 'yesno',
        'valuetype'   => 'int',
        'default'     => 1
    ),

    array(
        'name'        => 'show_sublink',
        'title'       => '_MI_XSITEMAP_SHOW_ACTION',
        'description' => '_MI_XSITEMAP_SHOW_ACTION_DESC',
        'formtype'    => 'yesno',
        'valuetype'   => 'int',
        'default'     => 1
    ),

    array(
        'name'        => 'invisible_dirnames',
        'title'       => '_MI_XSITEMAP_DIRNAMES',
        'description' => '_MI_XSITEMAP_DIRNAMES_DESC',
        'formtype'    => 'textbox',
        'valuetype'   => 'text',
        'default'     => ''
    ),

    array(
        'name'        => 'columns_number',
        'title'       => '_MI_XSITEMAP_COLS',
        'description' => '_MI_XSITEMAP_COLS_DESC',
        'formtype'    => 'select',
        'valuetype'   => 'int',
        'default'     => 4,
        'options'     => array(
            '1'  => 1,
            '2'  => 2,
            '3'  => 3,
            '4'  => 4,
            '5'  => 5,
            '6'  => 6,
            '7'  => 7,
            '8'  => 8,
            '9'  => 9,
            '10' => 10
        )
    )
);
