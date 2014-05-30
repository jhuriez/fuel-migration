<?php

namespace Fuel\Tasks;

class Migration
{
    public function install($publicPath = null, $theme = null)
    {
        \Lb\ModuleUtility::installAsset('migration', dirname(__FILE__), $publicPath, $theme);
    }

    public function uninstall($publicPath = null, $theme = null)
    {
        \Lb\ModuleUtility::uninstallAsset('migration', $publicPath, $theme);
    }
}