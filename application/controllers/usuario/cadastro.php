<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists('Controller')) {

    class Controller extends CI_Controller {
        
    }

}

class Cadastro extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        //lista os usuários
        $this->load->view('usuario/novo_usuario');
    }

    // cria um novo usuário
    function novo_usuario() {
        $config = array(
            array(
                'field' => 'first_name',
                'label' => 'Nome completo',
                'rules' => 'required'
            ),
        		
            array(
                'field' => 'email',
                'label' => 'e-mail',
                'rules' => 'required|valid_email'
            ),
        		
            array(
                'field' => 'password',
                'label' => 'Senha',
                'rules' => 'required'
            ),
        		
            array(
                'field' => 'password_confirm',
                'label' => 'Confirma&ccedil;&atilde;o de senha',
                'rules' => 'required|matches[password]'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $username = strtolower($this->input->post('first_name'));

            $email = $this->input->post('email');

            $password = $this->input->post('password');

            $additional_data = array('first_name' => $this->input->post('first_name'),
                'group_id' => 2,
            );

            // valida o e-mail, compara com o do banco se já exíste um igual
            if (!$this->ion_auth->email_check($email)) {
                $group_name = 'users';
                $this->ion_auth->register($username, $password, $email, $additional_data, $group_name);
            } else {
                // se existe, mostra o aviso que já exíste um e-mail igual cadastrado
                $this->mensagem->set(
                        'mensagem', 'Este e-mail j&aacute; ex&iacute;ste, tente com outro.'
                );

                redirect('usuario/cadastro', 'refresh');
            }

            // confere se criou o usuário e mostra a mensagem e redireciona
            $this->mensagem->set(
                    'mensagem', 'Usu&aacute;rio cadastrado com sucesso.'
            );

            redirect('usuario/aut', 'refresh');
        }
    }

}
