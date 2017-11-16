<?php
/**
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
 * @author          Urbanspaceman (http://www.takeaweb.it)
 *
 * Version : 1.00:
 * ****************************************************************************
 */

/**
 * @internal {Make sure you PROTECT THIS FILE}
 */

//use Xoopsmodules\xsitemap;

if ((!defined('XOOPS_ROOT_PATH'))
    || !($GLOBALS['xoopsUser'] instanceof XoopsUser)
    || !$GLOBALS['xoopsUser']->isAdmin()
) {
    exit('Restricted access' . PHP_EOL);
}

/**
 *
 * Prepares system prior to attempting to install module
 *
 * @param XoopsModule $module
 *
 * @return bool true if ready to install, false if not
 */
function xoops_module_pre_install_xsitemap(XoopsModule $module)
{
    $moduleDirName = basename(dirname(__DIR__));
    include __DIR__ . '/../preloads/autoloader.php';
    /** @var \Utility $utilityClass */
    $utility = new \Xoopsmodules\xsitemap\Utility();
//    if (!class_exists($utilityClass)) {
//        xoops_load('utility', $moduleDirName);
//    }

    $xoopsSuccess = $utility::checkVerXoops($module);
    $phpSuccess   = $utility::checkVerPhp($module);
    return $xoopsSuccess && $phpSuccess;
}

/**
 *
 * Performs tasks required during installation of the module
 *
 * @param XoopsModule $module
 *
 * @return bool true if installation successful, false if not
 */
function xoops_module_install_xsitemap(XoopsModule $module)
{
//    $configuratorArray = include __DIR__ . '/config.php';

//    require_once __DIR__  . '/../class/configurator.php';
//    $configuratorClass = new XsitemapConfigurator();

    return true; //
    /** @internal following code removed, it will fail because module not fully loaded/available until
     * after install, module now uses XOOPS preload instead */
    /*
    //28/08/2009 by urbanspaceman
    include_once $GLOBALS['xoops']->path("class/tree.php");
    include_once $GLOBALS['xoops']->path("modules/" . $module->dirname() . "/class/plugin.php");
    include_once $GLOBALS['xoops']->path("modules/" . $module->dirname() . "/include/functions.php");
    include_once $GLOBALS['xoops']->path("modules/" . $module->dirname(). "/class/dummy.php");

    //Create the xsitemap.xml file in the site root
    $xsitemap_show = Utility::generateSitemap();
    return Utility::saveSitemap($xsitemap_show) ? true : false;
    */
}
