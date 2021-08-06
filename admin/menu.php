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
 * @package         module\Xsitemap\admin
 * @author          XOOPS Module Development Team
 * @author          Urbanspaceman (http://www.takeaweb.it)
 * @copyright       Urbanspaceman (http://www.takeaweb.it)
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @link            https://xoops.org XOOPS
 * @since           1.00
 */

use Xmf\Module\Admin;
use XoopsModules\Xsitemap\{
    Helper
};

$moduleDirName      = \basename(\dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

$helper = Helper::getInstance();
$helper->loadLanguage('common');
$helper->loadLanguage('feedback');
$pathIcon32 = Admin::menuIconPath('');
$pathModIcon32 = XOOPS_URL .   '/modules/' . $moduleDirName . '/assets/images/icons/32/';
if (is_object($helper->getModule()) && false !== $helper->getModule()->getInfo('modicons32')) {
    $pathModIcon32 = $helper->url($helper->getModule()->getInfo('modicons32'));
}
$adminmenu = [
    [
        'title' => _MI_XSITEMAP_MANAGER_INDEX,
        'link'  => 'admin/index.php',
        'icon'  => $pathIcon32 . '/home.png',
    ],
    [
        'title' => _MI_XSITEMAP_MANAGER_PLUGIN,
        'link'  => 'admin/plugin.php',
        'icon'  => 'assets/images/admin/plugin.png',
    ],
    [
        'title' => _MI_XSITEMAP_MANAGER_XML,
        'link'  => 'admin/xml.php',
        'icon'  => 'assets/images/admin/xml.png',
    ],
    [
        'title' => _MI_XSITEMAP_MANAGER_ABOUT,
        'link'  => 'admin/about.php',
        'icon'  => $pathIcon32 . '/about.png',
    ],
];
