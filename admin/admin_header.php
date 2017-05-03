<?php
/*
 * xsitemap module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * @package    module\xsitemap\admin
 * @author     Urbanspaceman (http://www.takeaweb.it)
 * @copyright  Urbanspaceman (http://www.takeaweb.it)
 * @author     XOOPS Module Dev Team
 * @copyright  XOOPS Project (http://xoops.org)
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @link       http://xoops.org XOOPS
 * @since      1.00
 **/
use \Xmf\Request;
use \Xmf\Module\Helper;

require_once __DIR__ . '/../../../include/cp_header.php';

$moduleDirName  = basename(dirname(__DIR__));
$xsitemapHelper = \Xmf\Module\Helper::getHelper($moduleDirName);

$adminObject = \Xmf\Module\Admin::getInstance();

//if functions.php file exist
require_once __DIR__ . '/../include/functions.php';
require_once __DIR__ . '/../class/plugin.php';

// Load language files
$xsitemapHelper->loadLanguage('admin');
$xsitemapHelper->loadLanguage('modinfo');
$xsitemapHelper->loadLanguage('main');

$pluginHandler = $xsitemapHelper->getHandler('plugin');
