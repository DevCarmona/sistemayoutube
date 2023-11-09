<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentica extends CI_Controller {

    function __construct()
    {
        parent::__construct();        
        $this->load->model('model_usuario');       
        $this->load->helper('url');
    }

    function index()
    {
        //  Validacao do form
        $this->load->library('form_validation');
        //  Setar os campos obrigatorios para validar
        $this->form_validation->set_message('required', 'Campo %s obrigatório'); // Msg personalizada
        $this->form_validation->set_rules('login', 'Usuário', 'trim|required'); // Criando a regra
        $this->form_validation->set_message('required', 'Campo %s obrigatório'); // Msg personalizada
        $this->form_validation->set_rules('password', 'Senha', 'trim|required|callback_check_database'); // Criando a regra
    

        if($this->form_validation->run() == FALSE) {
            //  Falha de validação -> Redirecionar para a pag de login            
            //    redirect('login', 'refresh');
            // $this->load->view('view_login');
        } else {
            redirect('home/dashboard', 'refresh');
            // $this->load->view('view_home');
        }
    }

    function check_database($senha)
    {
        $login = $this->input->post('login');
        $result = $this->model_usuario->login($login, $senha);
        $usuarioid = '';
        $usuarionome = '';

        if($result) {
            return TRUE;
        }else {
            return FALSE;
        }
    }
}