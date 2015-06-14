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
 * @author 			Urbanspaceman (http://www.takeaweb.it)
 *
 * Version : 1.00:
 * ****************************************************************************
 */
 
    
    if (!defined("XOOPS_ROOT_PATH")) {
        die("XOOPS root path not defined");
    }

    if (!class_exists("XoopsPersistableObjectHandler")) {
        include_once XOOPS_ROOT_PATH."/modules/xsitemap/class/object.php";
    }

    class xsitemap_plugin extends XoopsObject
    {
        //Constructor
        function __construct()
        {
            $this->XoopsObject();
            $this->initVar("plugin_id",XOBJ_DTYPE_INT,null,false,8);
            $this->initVar("plugin_name",XOBJ_DTYPE_TXTBOX,null,false);
            $this->initVar("plugin_mod_version",XOBJ_DTYPE_TXTBOX,null,false);
            $this->initVar("plugin_mod_table",XOBJ_DTYPE_TXTBOX,null,false);
            $this->initVar("plugin_cat_id",XOBJ_DTYPE_TXTBOX,null,false);
            $this->initVar("plugin_cat_pid",XOBJ_DTYPE_TXTBOX,null,false);
            $this->initVar("plugin_cat_name",XOBJ_DTYPE_TXTBOX,null,false);
            $this->initVar("plugin_weight",XOBJ_DTYPE_TXTBOX,null,false);
            $this->initVar("plugin_call",XOBJ_DTYPE_TXTBOX,null,false);
            $this->initVar("plugin_submitter",XOBJ_DTYPE_INT,null,false,10);
            $this->initVar("plugin_date_created",XOBJ_DTYPE_INT,null,false,10);
            $this->initVar("plugin_online",XOBJ_DTYPE_INT,null,false,1);
            
            // Pour autoriser le html
            $this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
            
        }

        function xsitemap_plugin()
        {
            $this->__construct();
        }
    
        function getForm($action = false)
        {
            global $xoopsDB, $xoopsModuleConfig;
        
            if ($action === false) {
                $action = $_SERVER["REQUEST_URI"];
            }
        
            $title = $this->isNew() ? sprintf(_AM_XSITEMAP_PLUGIN_ADD) : sprintf(_AM_XSITEMAP_PLUGIN_EDIT);

            include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

            $form = new XoopsThemeForm($title, "form", $action, "post", true);
            $form->setExtra('enctype="multipart/form-data"');
            
            $form->addElement(new XoopsFormText(_AM_XSITEMAP_PLUGIN_NAME, "plugin_name", 50, 255, $this->getVar("plugin_name")), true);
            $form->addElement(new XoopsFormText(_AM_XSITEMAP_PLUGIN_MOD_VERSION, "plugin_mod_version", 50, 255, $this->getVar("plugin_mod_version")), true);
            $form->addElement(new XoopsFormText(_AM_XSITEMAP_PLUGIN_MOD_TABLE, "plugin_mod_table", 50, 255, $this->getVar("plugin_mod_table")), true);
            $form->addElement(new XoopsFormText(_AM_XSITEMAP_PLUGIN_CAT_ID, "plugin_cat_id", 50, 255, $this->getVar("plugin_cat_id")), true);
            $form->addElement(new XoopsFormText(_AM_XSITEMAP_PLUGIN_CAT_PID, "plugin_cat_pid", 50, 255, $this->getVar("plugin_cat_pid")), true);
            $form->addElement(new XoopsFormText(_AM_XSITEMAP_PLUGIN_CAT_NAME, "plugin_cat_name", 50, 255, $this->getVar("plugin_cat_name")), true);
            $form->addElement(new XoopsFormText(_AM_XSITEMAP_PLUGIN_WEIGHT, "plugin_weight", 50, 255, $this->getVar("plugin_weight")), true);
            $form->addElement(new XoopsFormText(_AM_XSITEMAP_PLUGIN_CALL, "plugin_call", 50, 255, $this->getVar("plugin_call")), true);
            $form->addElement(new XoopsFormSelectUser(_AM_XSITEMAP_PLUGIN_SUBMITTER, "plugin_submitter", false, $this->getVar("plugin_submitter"), 1, false), true);
            $form->addElement(new XoopsFormTextDateSelect(_AM_XSITEMAP_PLUGIN_DATE_CREATED, "plugin_date_created", "", $this->getVar("plugin_date_created")));
             $plugin_online = $this->isNew() ? 1 : $this->getVar("plugin_online");
            $check_plugin_online = new XoopsFormCheckBox(_AM_XSITEMAP_PLUGIN_ONLINE, "plugin_online", $plugin_online);
            $check_plugin_online->addOption(1, " ");
            $form->addElement($check_plugin_online);
            
            $form->addElement(new XoopsFormHidden("op", "save_plugin"));
            $form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
            $form->display();

            return $form;
        }
    }
    class xsitemapxsitemap_pluginHandler extends XoopsPersistableObjectHandler
    {

        function __construct(&$db)
        {
            parent::__construct($db, "xsitemap_plugin", "xsitemap_plugin", "plugin_id", "plugin_name");
        }

    }
