<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/* The MX_Controller class is autoloaded as required */

/**
 * @property Core $core
 */
class MY_Controller extends MX_Controller {

    public $pjaxRequest = false;
    public $ajaxRequest = false;

    public function __construct() {
        parent::__construct();

        if ($this->uri->segment(1) != 'admin')
        	redirect('/admin');
        
        
        if (in_array('X-PJAX', array_keys(getallheaders())))
            $this->pjaxRequest = true;

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            $this->ajaxRequest = true;
        
            
        
    }

}
