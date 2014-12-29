<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists('Controller')) {

    class Controller extends CI_Controller {
        
    }

}

class Aut extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if ($this->ion_auth->logged_in()) {
            // se j� est� logado n�o precisa ver esta p�gina ent�o redireciona
            redirect(base_url() . 'usuario/area', 'refresh');
        }

        $this->load->view('usuario/login');
    }

    // login do usu�rio
    function login() {
        // validando os erros
        $this->form_validation->set_rules('email', 'e-mail', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Senha', 'required');

        if ($this->form_validation->run() == true) {
            // confere se o usu�rio est� logado
            if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'))) { // se o login obteve sucesso
                redirect('usuario/area', 'refresh');
            } else { // se dados incorretos
                $this->mensagem->set(
                        'mensagem', '<div class="login-box-error-small corners">
                			<p>e-mail ou senha inv&aacute;lido!</p>
            			 </div>'
                );

                $this->index();
            }
        } else {
            // mostrando os erros da valida��o
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'value' => $this->form_validation->set_value('email'),
            );

            $this->data['password'] = array(
				'name' => 'password',
				'id' => 'password',
				'type' => 'password',
            );

            $this->index();
        }
    }

    // logout do usu�rio
    function logout() {
        // logout 
        $logout = $this->ion_auth->logout();

        // redireciona para a p�gina principal
        redirect('principal', 'refresh');
    }

    // esqueceu a senha
    function esqueceu() {
        // resgata o tipo de identidade do config e envia para a view
        $identity = $this->config->item('identity', 'ion_auth');

        // se algu�m usar underscore
        $identity_human = ucwords(str_replace('_', ' ', $identity));

        $config = array(
            array(
                'field' => 'email',
                'label' => 'e-mail',
                'rules' => 'required|valid_email'
            )
        );

        $this->form_validation->set_rules($config, $identity, $identity_human);

        if ($this->form_validation->run() == false) {
            // input
            $this->data[$identity] = array('name' => $identity,
                'id' => $identity, // troca
            );

            // mostra os erros e mostra aba tabs-3
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['identity'] = $identity;
            $this->data['identity_human'] = $identity_human;

            // mensagem de erro 
            $this->mensagem->set(
                    'mensagem', '<div class="login-box-error-small corners">
                			' . $this->data['message'] . '
            			 </div>'
            );

            redirect('usuario/aut', 'refresh');
        }

        // verifica se o e-mail digitado existe no banco
        $email = $this->input->post('email');

        // se n�o existe, mostra a mensagem
        if (!$this->ion_auth->email_check($email)) {
            $this->mensagem->set(
                    'mensagem', '<div class="login-box-error-small corners">
							<p>Este e-mail n&atilde;o existe em nosso cadastro!</p>
					 </div>'
            );

            redirect('usuario/aut', 'refresh');
        }
        // fim valida e-mail
        else {
            // executar o m�todo de esqueceu senha de e-mail um c�digo de ativa��o para o usu�rio
            $forgotten = $this->ion_auth->forgotten_password($this->input->post($identity));

            if ($forgotten) {
                // se n�o houver erros
                // mostra uma mensagem de confirma��o
                $this->mensagem->set(
                        'mensagem', '<div class="login-box-warning-small corners">
                			<p>Um e-mail foi enviado com as instru&ccedil;&otilde;es</p>
            			 </div>'
                );

                redirect('usuario/aut', 'refresh');
            } else {
                // mostra a mensagem de erro
                $this->mensagem->set(
                        'mensagem', '<div class="login-box-error-small corners">
                			<p>Ocorreu um erro!</p>
            			 </div>'
                );

                redirect('usuario/aut', 'refresh');
            }
        }
    }

    // redefini��o de senha - o passo final para a senha esquecida
    public function resetar($code) {
        $reset = $this->ion_auth->forgotten_password_complete($code);

        if ($reset) {

            // se tudo correu bem, envia para a p�gina de login
            $this->session->set_flashdata('message', $this->ion_auth->messages());

            // mostra a mensagem de sucesso
            $this->mensagem->set(
                    'mensagem', '<div class="login-box-warning-small corners">
                			<p>Uma nova senha foi gerada e enviada para seu e-mail</p>
            			 </div>'
            );

            redirect('usuario/aut', 'refresh');
        } else {
            // se a redefini��o n�o funcionou, envia de volta para a p�gina de senha esquecida
            $this->session->set_flashdata('message', $this->ion_auth->errors());

            // mostra a mensagem de erro
            $this->mensagem->set(
                    'mensagem', '<div class="login-box-error-small corners">
                			<p>Ocorreu um erro!</p>
            			 </div>'
            );

            redirect('usuario/aut', 'refresh');
        }
    }

}
?>