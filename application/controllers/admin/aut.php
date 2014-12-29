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
            redirect(base_url() . 'admin/dashboard', 'refresh');
        }

        // �rea de login  
        $data['titulo'] = "Administração| Login";

        $this->load->view('admin/elementos/html_header', $data);
        $this->load->view('admin/login');
        $this->load->view('admin/elementos/html_footer');
    }

    // login do usu�rio
    function login() {
        // validando os erros
        $this->form_validation->set_rules('email', 'e-mail', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Senha', 'required');

        if ($this->form_validation->run() == true) {
            // confere se o usu�rio est� logado
            if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'))) {
                // se o login obteve sucesso
                redirect('admin/dashboard', 'refresh');
            } else { // se dados incorretos
                $this->mensagem->set(
                        'wrong_login', '<div class="alert alert-error">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong>Oh snap!</strong>
								  <ul>
                					<li>E-mail ou senha incorreto!</li>
								  </ul>	
            			  </div>'
                );

                $this->index();
            }
        } else {
            $this->index();
        }
    }

    // logout do usu�rio
    function logout() {
        // logout 
        $logout = $this->ion_auth->logout();

        // redireciona para a �rea de login
        redirect('admin/aut', 'refresh');
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

            // mostra os erros e mostra 
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['identity'] = $identity;
            $this->data['identity_human'] = $identity_human;

            // mensagem de erro 
            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-error">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong>Oh snap!</strong>
								<ul>
								  <li>' . $this->data['message'] . '</li>
								</ul>
            			 </div>
						 
							 <script>
								$("#login-tabs a").click(function(e) {
									e.preventDefault();
									$(this).tab("show");
								})
							
								$("#login-tabs a:last").tab("show");
							 </script>'
            );

            redirect('admin/aut', 'refresh');
        }

        // verifica se o e-mail digitado existe no banco
        $email = $this->input->post('email');

        // se n�o existe, mostra a mensagem
        if (!$this->ion_auth->email_check($email)) {
            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-warning">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong>Oh snap!</strong>
								<ul>
								  <li>E-mail n&atilde;o cadastrado!</li>
								</ul>
					 </div>
					 
						 <script>
							$("#login-tabs a").click(function(e) {
								e.preventDefault();
								$(this).tab("show");
							});
							
							$("#login-tabs a:last").tab("show");
						 </script>'
            );

            redirect('admin/aut', 'refresh');
        }
        // fim valida e-mail
        else {
            // executar o m�todo de esqueceu senha de e-mail um c�digo de ativa��o para o usu�rio
            $forgotten = $this->ion_auth->forgotten_password($this->input->post($identity));

            if ($forgotten) {
                // se n�o houver erros
                // mostra uma mensagem de confirma��o
                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-info">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong>Okay!</strong>
								<ul>
								   <li>Um e-mail foi enviado com as instru&ccedil;&otilde;es</li>
								<ul>
            			 </div>'
                );

                redirect('admin/aut', 'refresh');
            } else {
                // mostra a mensagem de erro
                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-error">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong>Oh snap!</strong>
								<ul>
								  <li>Ocorreu um erro!</li>
								</ul>  
            			 </div>'
                );

                redirect('admin/aut', 'refresh');
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
                    'mensagem', '<div class="alert alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong>Okay!</strong>
								<ul>
								  <li>Uma nova senha foi gerada e enviada para seu e-mail</li>
								</ul>  
            			 </div>
						 
							 <script>
								$("#login-tabs a").click(function(e) {
									e.preventDefault();
									$(this).tab("show");
								});
							
								$("#login-tabs a:last").tab("show");
							 </script>'
            );

            redirect('admin/aut', 'refresh');
        } else {
            // se a redefini��o n�o funcionou, envia de volta para a p�gina de senha esquecida
            $this->session->set_flashdata('message', $this->ion_auth->errors());

            // mostra a mensagem de erro
            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-error">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong>Oh snap!</strong>
								<ul>
								  <li>Ocorreu um erro!</li>
								</ul>  
            			 </div>
						 
							 <script>
								$("#login-tabs a").click(function(e) {
									e.preventDefault();
									$(this).tab("show");
								});
							
								$("#login-tabs a:last").tab("show");
							 </script>'
            );

            redirect('admin/aut', 'refresh');
        }
    }

    // ativando o usu�rio
    function activate($id, $code = false) {
        if ($code !== false)
            $activation = $this->ion_auth->activate($id, $code);
        else if ($this->ion_auth->is_admin())
            $activation = $this->ion_auth->activate($id);


        if ($activation) {
            //redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('aut', 'refresh');
        } else {
            //redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect('aut/forgot_password', 'refresh');
        }
    }

    //deactivate the user
    function deactivate($id = NULL) {
        // no funny business, force to integer
        $id = (int) $id;

        $this->form_validation->set_rules('confirm', 'confirmation', 'required');
        $this->form_validation->set_rules('id', 'user ID', 'required|is_natural');

        if ($this->form_validation->run() == FALSE) {
            // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->ion_auth->get_user_array($id);
            $this->load->view('aut/deactivate_user', $this->data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                    show_404();
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
                    $this->ion_auth->deactivate($id);
                }
            }

            //redirect them back to the auth page
            redirect('aut', 'refresh');
        }
    }

    function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce() {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}