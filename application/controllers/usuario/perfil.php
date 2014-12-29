<?php

class Perfil extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            // redireciona, tem que estar logado para ver esta p�gina
            redirect(base_url() . 'admin/aut/login', 'refresh');
        }
    }

    function index() {
        //lista o perf�l do usu�rio
        $this->data['users'] = $this->ion_auth->get_users_array();
        $this->load->view('usuario/perfil', $this->data);
    }

    // alterar usu�rio 
    public function alterar($id) {
        if ($id != $this->session->userdata('user_id')) {
            // melhor uma p�gina de erro
            redirect('usuario/area/erro', 'refresh');
        }

        // lista o usu�rio
        $this->data['user'] = $this->ion_auth->get_user($id);
        $this->load->view('usuario/alterar', $this->data);
    }

    // alterando os dados do usu�rio
    public function gravar_usuario() {
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
            ),
        		
            array(
                'field' => 'group_id',
                'label' => 'Grupo',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->alterar_usuario($this->input->post('id'));
        } else {
            $id = $this->input->post('id');
            $data['first_name'] = $this->input->post('first_name');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['group_id'] = $this->input->post('group_id');


            if ($this->ion_auth->update_user($id, $data)) {
                $this->mensagem->set(
                        'mensagem', 'Usu&aacute;rio alterado com sucesso.'
                );

                redirect(base_url() . 'usuario/perfil/', 'refresh');
            } else {
                $this->mensagem->set(
                        'mensagem', 'Erro ao alterar Usu&aacute;rio!'
                );
            }
        }
    }

    // exclui um usu�rio
    function excluir($id) {

        if ($this->ion_auth->delete_user($id)) {
            // logout 
            $logout = $this->ion_auth->logout();

            // redireciona para a p�gina principal
            redirect('principal', 'refresh');
        } else {
            $this->mensagem->set(
                    'Erro ao excluir usuario!'
            );
        }
    }

}
?>