<!-- https://www.youtube.com/watch?v=hLb088g-s3w&list=PLbRKoRdDZ_NMCW9eC8NenvasLcJ2izk1o&index=7 -->
<!-- https://www.youtube.com/watch?v=W_5awKe8MjI 13:47 -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('form');
		date_default_timezone_set('America/Sao_Paulo');
	}

	function index()
	{
		redirect('login');
	}

	function dashboard()
	{
		$this->load->view('view_home');
	}
}