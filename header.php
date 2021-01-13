<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    XOOPS Project https://xoops.org/
 * @license      GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @package
 * @since
 * @author       XOOPS Development Team
 */

use XoopsModules\Xsitemap\{
    Common\Configurator,
    Helper,
    Utility
};

$moduleDirName = basename(__DIR__);
require_once dirname(__DIR__, 2) . '/mainfile.php';
require_once __DIR__ . '/include/common.php';
$myts         = \MyTextSanitizer::getInstance();
$helper       = Helper::getInstance();
$utility      = new Utility();
$configurator = new Configurator();
// Load language files
$helper->loadLanguage('admin');
$helper->loadLanguage('modinfo');
