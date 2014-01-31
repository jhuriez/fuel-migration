<?php

namespace Fuel\Migrations;

class Migrate_assets
{
    public $publicFolder;
    public $assetFolder;
    public $activeTheme;
    public $assetPath;

    public function __construct()
    {
        $this->publicFolder = DOCROOT.DS.'public';
        \Config::load('theme', 'theme');
        $this->assetFolder = \Config::get('theme.assets_folder');
        $this->activeTheme = \Config::get('theme.active');

        $this->assetJsPath = $this->publicFolder.DS.$this->assetFolder.DS.$this->activeTheme.DS.'js'.DS.'modules'.DS.'migration';
        $this->assetCssPath = $this->publicFolder.DS.$this->assetFolder.DS.$this->activeTheme.DS.'css'.DS.'modules'.DS.'migration';
    }

    public function up()
    {
        if (is_dir($this->publicFolder)) {
                // Create dir
            is_dir($this->assetJsPath) 
                or mkdir($this->assetJsPath, 0755, TRUE);

            is_dir($this->assetCssPath) 
                or mkdir($this->assetCssPath, 0755, TRUE);

                // Copy JS Assets
            \File::copy_dir(dirname(__FILE__).DS.'assets'.DS.'js', $this->assetJsPath);
                // Copy CSS Assets
            \File::copy_dir(dirname(__FILE__).DS.'assets'.DS.'css', $this->assetCssPath);
        } else {
            die('Unknow public path');
        }
    }

    public function down()
    {
        if (is_dir($this->publicFolder)) {
            \File::delete_dir($this->assetJsPath, true);
            \File::delete_dir($this->assetCssPath, true);
        }
        else
        {
            die('Unknow public path');
        }

    }
}