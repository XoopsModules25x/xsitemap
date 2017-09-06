<?php

class XsitemapHelper extends Xmf\Module\Helper
{
    /**
     * Init the module
     *
     * @return null|void
     */
    public function init()
    {
        $this->setDirname(basename(dirname(__DIR__)));
        $this->loadLanguage('preferences');
    }

    /**
     * @return mixed
     */
    public function loadConfig()
    {
        XoopsLoad::load('xoopreferences', $this->dirname);

        return XooSitemapPreferences::getInstance()->getConfig();
    }
}
