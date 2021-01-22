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
 * @package    module\Xsitemap\admin
 * @author     Mage, Mamba
 * @copyright  XOOPS Project (https://xoops.org)
 * @license    https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @link       https://xoops.org XOOPS
 * @since      1.00
 */

use Xmf\Module\Admin;

/** @var Admin $adminObject */
require __DIR__ . '/admin_header.php';
xoops_cp_header();
$templateMain = 'xsitemap_admin_about.tpl';

$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('about.php'));
$adminObject::setPaypal('xoopsfoundation@gmail.com');
$GLOBALS['xoopsTpl']->assign('about', $adminObject->renderAbout(false));
require_once __DIR__ . '/admin_footer.php';
