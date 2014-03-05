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
        
        // Load language
        \Lang::load('migration', true);
        
        // Load config
        \Config::load('migration', true);

        // Message class exist ?
        $this->use_message = class_exists('\Messages');

        // Set Media
        $this->setModuleMedia();
    }
    

    public function setModuleMedia()
    {
        // Jquery
        if (\Config::get('migration.module.force_jquery'))
        {
            $this->theme->asset->js(array(
                'modules/' . $this->module . '/jquery.min.js',
                'modules/' . $this->module . '/jquery-ui.min.js',
            ), array(), \Config::get('migration.module.assets.js_core') ? : 'js_core', false); 
        }

        // Bootstrap
        if (\Config::get('migration.module.force_bootstrap'))
        {
            $this->theme->asset->css(array(
                'modules/' . $this->module . '/bootstrap/css/bootstrap.css',
                'modules/' . $this->module . '/bootstrap/css/bootstrap-glyphicons.css',
            ), array(), \Config::get('migration.module.assets.css') ? : 'css_plugin', false);

            $this->theme->asset->js(array(
                'modules/' . $this->module . '/bootstrap.js',
            ), array(), \Config::get('migration.module.assets.js_core') ? : 'js_core', false); 
        }
    }
}