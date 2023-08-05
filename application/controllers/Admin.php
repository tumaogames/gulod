<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index()
    {
        $this->load->view('admin');
    }

    // Add other methods for handling admin panel functionality as needed.
}

$route['default_controller'] = 'welcome';
$route['gulod/admin'] = 'admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
