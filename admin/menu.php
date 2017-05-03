<?php
/*
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
 */
/**
 * Module: xsitemap
 *
 * @package    module\xsitemap\admin
 * @author     XOOPS Module Development Team
 * @author     Urbanspaceman (http://www.takeaweb.it)
 * @copyright  Urbanspaceman (http://www.takeaweb.it)
 * @copyright  XOOPS Project (http://xoops.org)
 * @license    http://www.fsf.org/copyleft/gpl.html GNU public license
 * @link       http://xoops.org XOOPS
 * @since      1.00
 */

defined('XOOPS_ROOT_PATH') || exit('Restricted access');

$adminmenu = array(
    array(
        'title' => _MI_XSITEMAP_MANAGER_INDEX,
        'link'  => 'admin/index.php',
        'icon'  => \Xmf\Module\Admin::menuIconPath('home.png', '32')
    ),
    array(
        'title' => _MI_XSITEMAP_MANAGER_PLUGIN,
        'link'  => 'admin/plugin.php',
        'icon'  => 'assets/images/admin/plugin.png'
    ),
    array(
        'title' => _MI_XSITEMAP_MANAGER_XML,
        'link'  => 'admin/xml.php',
        'icon'  => 'assets/images/admin/xml.png'
    ),
    array(
        'title' => _MI_XSITEMAP_MANAGER_ABOUT,
        'link'  => 'admin/about.php',
        'icon'  => \Xmf\Module\Admin::menuIconPath('about.png', '32')
    ),
);
