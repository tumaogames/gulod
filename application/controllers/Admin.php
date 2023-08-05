<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index()
    {
        $this->load->view('admin');
    }

    // Add other methods for handling admin panel functionality as needed.
}
