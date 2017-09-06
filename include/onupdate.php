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
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package
 * @since
 * @author       XOOPS Development Team
 */

if ((!defined('XOOPS_ROOT_PATH')) || !($GLOBALS['xoopsUser'] instanceof XoopsUser)
    || !$GLOBALS['xoopsUser']->IsAdmin()
) {
    exit('Restricted access' . PHP_EOL);
}

/**
 *
 * Prepares system prior to attempting to update module
 *
 * @param XoopsModule $module
 *
 * @return bool true if successfully ready to update module, false if not
 */
function xoops_module_pre_update_xsitemap(XoopsModule $module)
{
    $moduleDirName = basename(dirname(__DIR__));
    /** @var XsitemapUtility $utilityClass */
    $utilityClass    = ucfirst($moduleDirName) . 'Utility';
    if (!class_exists($utilityClass)) {
        xoops_load('utility', $moduleDirName);
    }

    $xoopsSuccess = $utilityClass::checkVerXoops($module);
    $phpSuccess   = $utilityClass::checkVerPhp($module);
    return $xoopsSuccess && $phpSuccess;
}

/**
 *
 * Functions to upgrade from previous version of the module
 *
 * @param XoopsModule $module
 * @param int|null        $previousVersion
 * @return bool true if successfully updated module, false if not
 * @internal param int $curr_version version number of module currently installed
 *
 */
function xoops_module_update_xsitemap(XoopsModule $module, $previousVersion = null)
{
    /*======================================================================
        //----------------------------------------------------------------
        // Remove xSitemap uploads folder (and all subfolders) if they exist
        //----------------------------------------------------------------*
        $utilityClass = ucfirst($moduleDirName) . 'Utility';
        if (!class_exists($utilityClass)) {
            xoops_load('utility', $moduleDirName);
        }

        // Recursively delete directories
        $xsUploadDir = realpath(XOOPS_UPLOAD_PATH . "/" . $module->dirname());
        $success = $utilityClass::rrmdir($xsUploadDir);
        if (true !== $success) {
            \Xmf\Language::load('admin', $module->dirname());
            $module->setErrors(sprintf(_AM_XSITEMAP_ERROR_BAD_DEL_PATH, $xsUploadDir));
        }
        return $success;
    ======================================================================*/

    $moduleDirName = $module->getVar('dirname');
    $xsitemapHelper      = \Xmf\Module\Helper::getHelper($moduleDirName);
    /** @var XsitemapUtility $utilityClass */
    $utilityClass = ucfirst($moduleDirName) . 'Utility';
    if (!class_exists($utilityClass)) {
        xoops_load('utility', $moduleDirName);
    }
    //-----------------------------------------------------------------------
    // Upgrade for Xsitemap < 1.54
    //-----------------------------------------------------------------------

    $success = true;

    $xsitemapHelper->loadLanguage('modinfo');
    $xsitemapHelper->loadLanguage('admin');

    if ($previousVersion < 154) {
        //----------------------------------------------------------------
        // Remove previous css & images directories since they've been relocated to ./assets
        // Also remove uploads directories since they're no longer used
        //----------------------------------------------------------------
        $old_directories = [
            $xsitemapHelper->path('css/'),
            $xsitemapHelper->path('js/'),
            $xsitemapHelper->path('images/'),
            XOOPS_UPLOAD_PATH . '/' . $module->dirname()
        ];
        foreach ($old_directories as $old_dir) {
            $dirInfo = new SplFileInfo($old_dir);
            if ($dirInfo->isDir()) {
                // The directory exists so delete it
                if (false === $utilityClass::rrmdir($old_dir)) {
                    $module->setErrors(sprintf(_AM_XSITEMAP_ERROR_BAD_DEL_PATH, $old_dir));
                    return false;
                }
            }
            unset($dirInfo);
        }

        //-----------------------------------------------------------------------
        // Remove ./template/*.html (except index.html) files since they've
        // been replaced by *.tpl files
        // Note: this will also remove /template/xsitemap_style.html since it's no longer used
        //-----------------------------------------------------------------------
        $path       = $xsitemapHelper->path('templates/');
        $unfiltered = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        $iterator   = new RegexIterator($unfiltered, "/.*\.html/");
        foreach ($iterator as $name => $fObj) {
            if ($fObj->isFile() && ('index.html' !== $fObj->getFilename())) {
                if (false === ($success = unlink($fObj->getPathname()))) {
                    $module->setErrors(sprintf(_AM_XSITEMAP_ERROR_BAD_REMOVE, $fObj->getPathname()));
                    return false;
                }
            }
        }

        //-----------------------------------------------------------------------
        // Now remove a some misc files that were renamed or deprecated
        //-----------------------------------------------------------------------
        $oldFiles = [
            $xsitemapHelper->path('include/install.php'),
            $xsitemapHelper->path('class/module.php'),
            $xsitemapHelper->path('class/menu.php')
        ];
        foreach ($oldFiles as $file) {
            if (is_file($file)) {
                if (false === ($delOk = unlink($file))) {
                    $module->setErrors(sprintf(_AM_XSITEMAP_ERROR_BAD_REMOVE, $file));
                }
                $success = $success && $delOk;
            }
        }
    }
    return $success;
}
