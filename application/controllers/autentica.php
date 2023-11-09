<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentica extends CI_Controller {

    function __construct()
    {
        parent::__construct();        
        $this->load->library('session');
        $this->load->model('model_usuario');       
        $this->load->helper('url');
        $this->load->helper('security');
    }

    function index()
    {
        //  Validacao do form
        $this->load->library('form_validation');
        //  Setar os campos obrigatorios para validar
        $this->form_validation->set_message('required', 'Campo %s obrigatório'); // Msg personalizada
        $this->form_validation->set_rules('login', 'Usuário', 'trim|required'); // Criando a regra
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|callback_check_database'); // Criando a regra
    

        if($this->form_validation->run() == FALSE) {
            //  Falha de validação -> Redirecionar para a pag de login            
            redirect('login', 'refresh');
        } else {
            //  Validação OK -> Acesso a área privada
            $login = $this->input->post('login');
            $sess_array = array();
            $sess_array = array(
                'usuariologin' => $login,
            );
            $this->session->set_userdata('login', $sess_array);
            redirect('home/dashboard', 'refresh');
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