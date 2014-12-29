<?php

class Categorias extends CI_Controller {

    private $data = array();

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            // redireciona, tem que estar logado para ver esta p�gina
            redirect(base_url() . 'admin/aut/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            // redireciona, tem que ser do grupo dos administradores para ver esta p�gina
            redirect(base_url() . 'admin/aut/login', 'refresh');
        }
    }

    function index() {
        $data['titulo'] = "Administração | Categorias";

        $this->load->model('admin/categorias_model');
        $data['categorias'] = $this->categorias_model->listar();

        $this->load->view('admin/elementos/html_header', $data);
        $this->load->view('admin/elementos/menu');

        // configuração ckeditor's
        $this->data['ckeditor'] = array(
            //ID da textarea que vai ser substituida
            'id' => 'descricao',
            'path' => 'js/admin/ckeditor',
            // Valores opcionais
            'config' => array(
                // 'toolbar' 	=> 	"Full", 	// usando toolbar completo
                'width' => "550px",
                'height' => '150px',
                'language' => 'pt-br', // tradução
                // ckfinder path
                'filebrowserBrowseUrl' 		=> '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserImageBrowseUrl' => '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserFlashBrowseUrl' => '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserUploadUrl' 		=> '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserImageUploadUrl' => '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserFlashUploadUrl' => '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserWindowWidth' 	=> '800',
                'filebrowserWindowHeight' 	=> '538',
                'toolbar' => array(// configurando toolbar customizado
                    array('Bold', 'Italic'),
                    array('Underline', 'Strike', 'FontSize'),
                    array('Image', 'Link', 'Unlink'),
                    array('PasteText'),
                    array('Maximize'),
                // quebra de linha '/'
                )
            )
        );

        $this->load->view('admin/categorias', $this->data);
        $this->load->view('admin/elementos/html_footer');
    }

    // adiciona uma categoria
    function adicionar() {
        $config = array(
            array(
                'field' => 'nome',
                'label' => 'nome',
                'rules' => 'required|min_length[4]|max_length[20]'
            ),
        		
            array(
                'field' => 'url',
                'label' => 'URL',
                'rules' => 'required|min_length[4]|max_length[45]'
            ),
        		
            array(
                'field' => 'descricao',
                'label' => 'descrição',
                'rules' => 'required| min_length[20]| max_length[100]| htmlspecialchars'
            ),
        		
            array(
                'field' => 'status',
                'label' => 'status',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data['nome'] = $this->input->post('nome');
            $data['url'] = url_title(convert_accented_characters($this->input->post('url')));
            $data['descricao'] = $this->input->post('descricao');
            $data['status'] = $this->input->post('status');

            $this->load->model('admin/categorias_model');

            if ($this->categorias_model->cadastrar($data)) {

                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-success">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  <strong>Okay!</strong> categoria cadastrada com sucesso.
						</div>'
                );

                redirect(base_url() . 'admin/categorias/', 'refresh');
            } else {
                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-error">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  <strong>Oops!</strong> ocorreu um erro ao cadastrar a categoria.
						</div>'
                );
                redirect(base_url() . 'admin/categorias/', 'refresh');
            }
        }
    }

    // altera uma categoria
    function alterar($id) {
        $data['titulo'] = "Administração | Alterar categoria";

        $this->load->model('admin/categorias_model');
        $data['dados_categoria'] = $this->categorias_model->alterar($id);

        $this->load->view('admin/elementos/html_header', $data);
        $this->load->view('admin/elementos/menu');

        // configura��o ckeditor's
        $this->data['ckeditor'] = array(
            //ID da textarea que vai ser substituida
            'id' => 'descricao',
            'path' => 'js/admin/ckeditor',
            // Valores opcionais
            'config' => array(
                // 'toolbar' 	=> 	"Full", 	// usando toolbar completo
                'width' => "550px",
                'height' => '150px',
                'language' => 'pt-br', // tradução
                // ckfinder path
                'filebrowserBrowseUrl' 		=> '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserImageBrowseUrl' => '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserFlashBrowseUrl' => '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserUploadUrl' 		=> '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserImageUploadUrl' => '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserFlashUploadUrl' => '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserWindowWidth' 	=> '800',
                'filebrowserWindowHeight' 	=> '538',
                'toolbar' => array(// configurando toolbar customizado
                    array('Bold', 'Italic'),
                    array('Underline', 'Strike', 'FontSize'),
                    array('Image', 'Link', 'Unlink'),
                    array('PasteText'),
                    array('Maximize'),
                // quebra de linha '/'
                )
            )
        );

        $this->load->view('admin/alterar_categoria', $this->data);
        $this->load->view('admin/elementos/html_footer');
    }

    function gravar_alteracao() {
        $config = array(
            array(
                'field' => 'nome',
                'label' => 'nome',
                'rules' => 'required|min_length[4]|max_length[20]'
            ),
        		
            array(
                'field' => 'url',
                'label' => 'Link Permanente',
                'rules' => 'required|min_length[4]|max_length[45]'
            ),
        		
            array(
                'field' => 'descricao',
                'label' => 'descrição',
                'rules' => 'required| min_length[20]| max_length[100]| htmlspecialchars'
            ),
        		
            array(
                'field' => 'status',
                'label' => 'status',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->alterar($this->input->post('id'));
        } else {
            $data['id'] = $this->input->post('id');
            $data['nome'] = $this->input->post('nome');
            $data['url'] = url_title(convert_accented_characters($this->input->post('url')));
            $data['descricao'] = $this->input->post('descricao');
            $data['status'] = $this->input->post('status');

            $this->load->model('admin/categorias_model');
            if ($this->categorias_model->gravar_alteracao($data)) {

                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-success">
            				<button type="button" class="close" data-dismiss="alert">×</button>
            				<strong>Okay!</strong> categoria alterada com sucesso.
          				</div>'
                );
                redirect(base_url() . 'admin/categorias/', 'refresh');
            } else {
                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-error">
            				<button type="button" class="close" data-dismiss="alert">×</button>
            				<strong>Oops!</strong> erro ao alterar cartegoria.
          				</div>'
                );
                redirect(base_url() . 'admin/categorias/', 'refresh');
            }
        }
    }

    function excluir($id) {
        $this->load->model('admin/categorias_model');
        // se houver artigos relacionados não excluir ou ...

        if ($this->categorias_model->artigos_categoria($id) == false) {

            $this->categorias_model->excluir($id);

            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Okay!</strong> categoria excluida com sucesso.
					</div>'
            );

            redirect(base_url() . 'admin/categorias/', 'refresh');
        } else {
            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Oops!</strong> exístem artigos relacionados a essa categoria.
						
						<p></p>
					
				        <p>
							<a class="btn btn-danger" href="confirma/' . $id . '">Não importa, quero apagar</a> 
						</p>
			          
					</div>'
            );

            redirect(base_url() . 'admin/categorias/', 'refresh');
        }
    }

    function excluir_grupo() {
        $this->load->model('admin/categorias_model');


        foreach ($this->input->post('checkbox') as $id) {
            if ($this->categorias_model->artigos_categoria($id) == false) {
                foreach ($this->input->post('checkbox') as $id) {
                    $this->categorias_model->excluir($id);
                }

                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-success">
							  <button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>Okay!</strong> categorias excluidas com sucesso.
							</div>'
                );

                redirect(base_url() . 'admin/categorias/', 'refresh');
            } else {
                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Oops!</strong> exístem artigos relacionados.		          
					</div>'
                );

                redirect(base_url() . 'admin/categorias/', 'refresh');
            }
        }
    }

    // confirma exclussão 	
    function confirma($id) {
        $this->load->model('admin/categorias_model');

        if ($this->categorias_model->excluir($id)) {

            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Okay!</strong> excluido com sucesso.
					</div>'
            );

            redirect(base_url() . 'admin/categorias/', 'refresh');
        }
    }

    // faz um pesquisa por categorias // a query deve ir no model!!!
    function pesquisa_categorias() {
        $dados['paginas'] = NULL;
        $dados['titulo'] = 'Resultados da Pesquisa';

        $query = $this->db->get('categorias');
        $dados['categorias'] = $query->result();

        $this->db->like('nome', $this->input->post('pesquisa'));
        $this->db->or_like('descricao', $this->input->post('pesquisa'));

        $query = $this->db->get('categorias');
        $dados['categorias'] = $query->result();


        $this->load->view('admin/elementos/html_header', $dados);
        $this->load->view('admin/elementos/menu');

        if (count($dados['categorias']) > 0) {
            $this->load->view('admin/categorias_pesquisa', $dados);
        } else {
            $dados['termo'] = $this->input->post('pesquisa');

            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-warning">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Oops!</strong> nenhuma categoria foi encontrada com esse nome
				  </div>'
            );
            redirect(base_url() . 'admin/categorias/', 'refresh');
        }
        $this->load->view('admin/elementos/html_footer');
    }

}
?>