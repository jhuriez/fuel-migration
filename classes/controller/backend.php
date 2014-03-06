<?php

namespace Migration;

class Controller_Backend extends \Controller_Base_Backend
{
    public $module = 'migration';
    public $dataGlobal = array();

    public function before() {
        if (\Input::is_ajax())
        {
            return parent::before();
        }
        else
        {
            parent::before();
        }
        
        // Load config
        \Config::load('migration', true);
        
        // Load language
        \Lang::load('migration', true);

        // Message class exist ?
        $this->use_message = class_exists('\Messages');

        // Use Casset ?
        $this->use_casset = \Config::get('migration.module.use_casset');

        // Set Media
        $this->setModuleMedia();
    }
    

    public function setModuleMedia()
    {
        if ($this->use_casset)
        {
            $activeTheme = $this->theme->active();
            \Casset::add_path('theme', $activeTheme['asset_base']);
        }
        
        // Jquery
        if (\Config::get('migration.module.force_jquery'))
        {
            $this->addAsset(array(
                'modules/' . $this->module . '/jquery.min.js',
                'modules/' . $this->module . '/jquery-ui.min.js',
            ), 'js', 'js_core');
        }

        // Bootstrap
        if (\Config::get('migration.module.force_bootstrap'))
        {
            $this->addAsset(array(
                'modules/' . $this->module . '/bootstrap/css/bootstrap.css',
                'modules/' . $this->module . '/bootstrap/css/bootstrap-glyphicons.css',
            ), 'css', 'css_plugin');

            $this->addAsset(array(
                'modules/' . $this->module . '/bootstrap.js',
            ), 'js', 'js_core');
        }
    }

    public function addAsset($files, $type, $group, $attr = array(), $raw = false)
    {
        $group = (\Config::get('migration.module.assets.'.$group) ? : $group);
        if ($this->use_casset)
        {
            foreach((array)$files as $file)
                \Casset::{$type}('theme::'.$file, false, $group);
        }
        else
        {
            $this->theme->asset->{$type}($files, $attr, $group, $raw);
        }
    }
}