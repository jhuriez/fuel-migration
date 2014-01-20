<?php

namespace Migration;

class Controller_Backend extends \Controller_Hybrid
{
    public $moduleName = 'migration';
    public $dataGlobal = array();
    public $template = 'template.php';
    public $template404 = 'template.php';
    
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
        
        // Message class exist ?
        $this->dataGlobal['use_message'] = $this->use_message = class_exists('\Messages');
        
        // Set template 
        \Theme::instance($this->moduleName)->set_template($this->template);
        
        // Assets
        \Asset::css(array(
            'modules/'.$this->moduleName.'/bootstrap/css/bootstrap.css',
            'modules/'.$this->moduleName.'/bootstrap/css/bootstrap-glyphicons.css',
            'modules/'.$this->moduleName.'/layout.css',
            ), array(), 'layout', false);
        
        \Asset::js(array(
            'modules/'.$this->moduleName.'/bootstrap.js',
            ), array(), 'js_footer', false);
        
        \Asset::js(array(
            'modules/'.$this->moduleName.'/jquery.min.js',
            'modules/'.$this->moduleName.'/jquery-ui.min.js',
            ), array(), 'js_top', false);
    }
    
    public function action_404()
    {
        $messages = array('Uh Oh!', 'Huh ?');
        $data['notfound_title'] = $messages[array_rand($messages)];
        $view = \Theme::instance($this->moduleName)->view('404.php', $data);
        \Theme::instance($this->moduleName)->set_partial('content', $view);
    }
    
    public function after($response)
    {
        \View::set_global('dataGlobal', $this->dataGlobal);
        // If nothing was returned set the theme instance as the response
        if (empty($response))
        {
            $response = \Response::forge(\Theme::instance($this->moduleName));
        }

        if (!$response instanceof \Response)
        {
            $response = \Response::forge($response);
        }
        
        return parent::after($response);
    }
}