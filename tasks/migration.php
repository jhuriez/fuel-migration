<?php

namespace Fuel\Tasks;

class Migration
{
    public $publicPath;
    public $assetFolder;
    public $activeTheme;
    public $assetPath;

    public function __construct()
    {
        $this->publicPath = DOCROOT.DS.'public';
        \Config::load('theme', 'theme');
        $this->assetFolder = \Config::get('theme.assets_folder');
        $this->activeTheme = \Config::get('theme.active');

        $this->assetJsPath = $this->publicPath.DS.$this->assetFolder.DS.$this->activeTheme.DS.'js'.DS.'modules'.DS.'migration';
        $this->assetCssPath = $this->publicPath.DS.$this->assetFolder.DS.$this->activeTheme.DS.'css'.DS.'modules'.DS.'migration';
    }


	public function install($publicPath = null)
	{
		if ($publicPath !== null)
        {
            $oldPublicPath = $this->publicPath;
            $this->publicPath = DOCROOT.DS.$publicPath;
            $this->assetJsPath = str_replace($oldPublicPath, $this->publicPath, $this->assetJsPath);
            $this->assetCssPath = str_replace($oldPublicPath, $this->publicPath, $this->assetCssPath);
        } 

        if (is_dir($this->publicPath)) {
            // Create dir
            is_dir($this->assetJsPath) 
                or mkdir($this->assetJsPath, 0755, TRUE);

            is_dir($this->assetCssPath) 
                or mkdir($this->assetCssPath, 0755, TRUE);

            // Copy JS Assets
            \File::copy_dir(dirname(__FILE__).DS.'assets'.DS.'js', $this->assetJsPath);
            // Copy CSS Assets
            \File::copy_dir(dirname(__FILE__).DS.'assets'.DS.'css', $this->assetCssPath);

            die('Migration assets install : OK');
        } else {
            die('Unknow public path : ' . $this->publicPath);
        }
	}

    public function uninstall($publicPath = null)
    {
        if ($publicPath !== null)
        {
            $oldPublicPath = $this->publicPath;
            $this->publicPath = DOCROOT.DS.$publicPath;
            $this->assetJsPath = str_replace($oldPublicPath, $this->publicPath, $this->assetJsPath);
            $this->assetCssPath = str_replace($oldPublicPath, $this->publicPath, $this->assetCssPath);
        } 
        
        if (is_dir($this->publicPath)) {
            is_dir($this->assetJsPath) and \File::delete_dir($this->assetJsPath, true);
            is_dir($this->assetCssPath) and \File::delete_dir($this->assetCssPath, true);

            die('Migration assets uninstall : OK');
        }
        else
        {
            die('Unknow public path : ' . $this->publicPath);
        }
    }
}