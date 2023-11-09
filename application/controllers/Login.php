<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('form');
        date_default_timezone_set('America/Sao_Paulo');
    }
    
    public function index() {
        if($this->session->userdata('logged_in')) {
            $this->load->view('view_home');
        } else {
            $this->load->helper(array('form'));
            $this->load->view('view_login');
        }
    }
}