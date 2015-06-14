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
    
class XoopsDummyObject extends XoopsObject
{
    /**
     * constructor
     */
    function XoopsDummyObject($row, $id_name = 'cid', $pid_name = 'pid', $title_name = 'title')
    {
        $this->XoopsObject();
        $this->initVar($id_name, XOBJ_DTYPE_INT, $row[$id_name]);
        $this->initVar($pid_name, XOBJ_DTYPE_INT, $row[$pid_name]);
        $this->initVar($title_name, XOBJ_DTYPE_TXTBOX, $row[$title_name]);
    }
}
