<?php

class Usuarios extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            // redireciona, tem que estar logado para ver esta p�gina
            redirect(base_url() . 'admin/aut/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            // redireciona, tem que ser do grupo dos administradores para ver esta página
            redirect(base_url() . 'admin/aut/login', 'refresh');
        }
    }

    function index() {
        $data['titulo'] = "Administração | Usuários";

        $this->load->model('admin/dashboard_model');

        $this->load->view('admin/elementos/html_header', $data);
        $this->load->view('admin/elementos/menu');

        // lista os usuários
        $this->data['users'] = $this->ion_auth->get_users_array();

        $this->load->view('admin/usuarios', $this->data);
        $this->load->view('admin/elementos/html_footer');
    }

    // cadastrar usuário
    function cadastra() {
        $config = array(
            array(
                'field' => 'first_name',
                'label' => 'nome',
                'rules' => 'required'
            ),
        		
            array(
                'field' => 'email',
                'label' => 'e-mail',
                'rules' => 'required|valid_email'
            ),
        		
            array(
                'field' => 'password',
                'label' => 'senha',
                'rules' => 'required'
            ),
        		
            array(
                'field' => 'password_confirm',
                'label' => 'confirmação de senha',
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
                'group_id' => $this->input->post('group_id'),
                'active' => $this->input->post('active'),
            );

            // valida o e-mail, compara com o do banco se já exíste um igual
            if (!$this->ion_auth->email_check($email)) {
                $group_name = 'users';
                $this->ion_auth->register($username, $password, $email, $additional_data, $group_name);
            } else {
                // se existe, mostra o aviso que já exíste um e-mail igual cadastrado
                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-warning">
						  	<button type="button" class="close" data-dismiss="alert">×</button>
						 	<strong>Oops!</strong> este e-mail já exíste, escolha com outro
						</div>'
                );

                redirect('admin/usuarios', 'refresh');
            }

            // confere se criou o usuário e mostra a mensagem e redireciona
            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Okay!</strong> usuário cadastrado com sucesso
					 </div>'
            );

            redirect('admin/usuarios', 'refresh');
        }
    }

    // alterar usuário 
    public function alterar_usuario($id) {
        $data['titulo'] = "Administração | Alterar Usuário";

        $this->load->view('admin/elementos/html_header', $data);
        $this->load->view('admin/elementos/menu');

        // lista os usuários
        $this->data['user'] = $this->ion_auth->get_user($id);
        $this->load->view('admin/alterar_usuarios', $this->data);
        $this->load->view('admin/elementos/html_footer');
    }

    // alterando os dados do usuário
    public function gravar_usuario() {
        $config = array(
            array(
                'field' => 'first_name',
                'label' => 'nome',
                'rules' => 'required'
            ),
        		
            array(
				'field' => 'email',
				'label' => 'e-mail',
				'rules' => 'required|valid_email'
			),
        		
            array(
                'field' => 'password',
                'label' => 'senha',
                'rules' => ''
            ),
        		
            array(
                'field' => 'password_confirm',
                'label' => 'confirmção de senha',
                'rules' => 'matches[password]'
            ),
        		
            array(
                'field' => 'active',
                'label' => 'status',
                'rules' => 'required'
            ),
        		
            array(
                'field' => 'group_id',
                'label' => 'grupo',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->alterar_usuario($this->input->post('id'));
        } else {
            // gravando
            $id = $this->input->post('id');
            $data['first_name'] = $this->input->post('first_name');
            $data['email'] = $this->input->post('email');
            $data['active'] = $this->input->post('active');
            $data['password'] = $this->input->post('password');
            $data['group_id'] = $this->input->post('group_id');

            if ($this->ion_auth->update_user($id, $data)) {

                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-success">
						  		<button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>Okay!</strong> usuário alterado com sucesso
							</div>'
                );


                redirect(base_url() . 'admin/usuarios/', 'refresh');
            } else {
                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-error">
							  <button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>Oops!</strong> erro ao alterar usuário
							</div>'
                );

                redirect(base_url() . 'admin/usuarios/', 'refresh');
            }
        }
    }

    // exclui um usuário
    function excluir($id) {

        if ($this->ion_auth->delete_user($id)) {
            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-success">
						  		<button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>Okay!</strong> usuário excluido com sucesso
							</div>'
            );

            redirect(base_url() . 'admin/usuarios/', 'refresh');
        } else {

            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-error">
						  		<button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>Oops!</strong> erro ao excluir usuário
							</div>'
            );

            redirect(base_url() . 'admin/usuarios/', 'refresh');
        }
    }

    // checkbox
    function excluir_grupo() {

        // se não selecionou um checkbox
        if (!is_array($this->input->post('checkbox'))) {
            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-info">
						  		<button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>Oops!</strong> nenhum usuário foi selecionado
							</div>'
            );

            redirect(base_url() . 'admin/usuarios/', 'refresh');
        }

        // senão
        else {
            foreach ($this->input->post('checkbox') as $id) {
                $this->ion_auth->delete_user($id);
            }
        }

        $this->mensagem->set(
                'mensagem', '<div class="alert alert-success">
						  		<button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>Okay!</strong> usuário(s) excluidos com sucesso
							</div>'
        );

        redirect(base_url() . 'admin/usuarios/', 'refresh');
    }

    // pesquisa por um usuário ou lista todos
    function pesquisa_usuarios() {
        $dados['paginas'] = NULL;
        $dados['titulo'] = 'Resultados da Pesquisa';

        $query = $this->db->get('users');
        $dados['users'] = $query->result();

        $this->db->like('first_name', $this->input->post('pesquisa_usuarios'));

        $dados['users'] = $this->ion_auth->get_users();


        $this->load->view('admin/elementos/html_header', $dados);
        $this->load->view('admin/elementos/menu');


        if (count($dados['users']) > 0) {
            $this->load->view('admin/usuarios_pesquisa', $dados);
        } else {
            $dados['termo'] = $this->input->post('pesquisa_usuarios');

            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-info">
						  		<button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>Oops!</strong> nenhum usuário foi encontrado com esse nome
							</div>'
            );

            redirect(base_url() . 'admin/usuarios/', 'refresh');
        }

        $this->load->view('admin/elementos/html_footer');
    }

    // pesquisa por grupos
    function pesquisa_grupos() {
        $dados['paginas'] = NULL;
        $dados['titulo'] = 'Resultados da Pesquisa';

        $query = $this->db->get('users');
        $dados['users'] = $query->result();

        $this->db->like('group_id', $this->input->post('pesquisa_grupos'));

        $dados['users'] = $this->ion_auth->get_users();

        $this->load->view('admin/elementos/html_header', $dados);
        $this->load->view('admin/elementos/menu');

        if (count($dados['users']) > 0) {
            $this->load->view('admin/usuarios_pesquisa', $dados);
        } else {
            $dados['termo'] = $this->input->post('pesquisa_grupos');
            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-info">
						  		<button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>Oops!</strong> nenhum usuário foi encontrado com esse nome
							</div>'
            );

            redirect(base_url() . 'admin/usuarios/', 'refresh');
        }
        $this->load->view('admin/elementos/html_footer');
    }

}
?>