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
        $this->form_validation->set_rules('password', 'Senha', 'trim|required|callback_check_database'); // Criando a regra
    

        if($this->form_validation->run() == FALSE) {
            $this->load->view('view_login');
        } else {
            // redirect('home/dashboard', 'refresh');
        }
    }

    function check_database($senha)
    {
        $login = $this->input->post('login');
        $result = $this->model_usuario->login($login, $senha);
        var_dump($result);
        $usuarioid = '';
        $usuarionome = '';

        if($result) {
            foreach($result as $linha) {
                $dados['usuarioid'] = $linha->id;
                $dados['usuarionome'] = $linha->usuario_nome;
            }
            return TRUE;
        }else {
            $this->form_validation->set_message('check_database', '');
            return FALSE;
        }
    }
}