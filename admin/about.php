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
 * @copyright  http://www.takeaweb.it Urbanspaceman
 * @copyright  http://xoops.org 2001-2017 XOOPS Project
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @author     http://www.takeaweb.it  Urbanspaceman
 * @author     Mage, Mamba
 * @link       http://xoops.org XOOPS
 * @since::    1.00
 **/

include_once __DIR__ . '/admin_header.php';

xoops_cp_header();

$moduleAdmin = \Xmf\Module\Admin::getInstance();

$moduleAdmin->displayNavigation(basename(__FILE__));
$moduleAdmin->setPaypal('xoopsfoundation@gmail.com');
$moduleAdmin->displayAbout(false);

include __DIR__ . '/admin_footer.php';
