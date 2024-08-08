<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Core_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        error_reporting(0);
    }



}

class Home_Core_Controller extends Core_Controller
{
    public function __construct()
    {
    parent::__construct();
    }
       
}

class Admin_Core_Controller extends Core_Controller
{

    public function __construct()
    {
        parent::__construct();

        // $this->load->model('auth_model');
        // if (!auth_check()) {
        //     redirect(base_url());
        // }
    }
}

