<?php

class Artigos extends CI_Controller {

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
        $data['titulo'] = "Administração | Artigos";

        $this->load->model('admin/categorias_model');
        $data['categorias'] = $this->categorias_model->listar();

        $this->load->model('admin/artigos_model');
        $data['artigos'] = $this->artigos_model->listar();

        $this->load->view('admin/elementos/html_header', $data);
        $this->load->view('admin/elementos/menu');

        // configuraçção ckeditor's descri��o do artigo
        $this->data['ckeditor_1'] = array(
            //ID da textarea que vai ser substituida
            'id' => 'descricao',
            'path' => 'js/admin/ckeditor',
            // Valores opcionais
            'config' => array(
                // 'toolbar' 	=> 	"Full", 	// usando toolbar completo
                'width' => "550px",
                'height' => '150px',
                'language' => 'pt-br', // tradu��o
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

        $this->load->view('admin/artigos', $this->data);
        $this->load->view('admin/elementos/html_footer');
    }

    // cadastra um artigo
    function cadastrar() {

        // confere se está vazio
        if ($this->input->post('url') == "") {
            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Oops!</strong> o campo URL deve ser preenchido.
					</div>'
            );

            redirect(base_url() . 'admin/artigos/', 'refresh');
        }

        // isto deve estar em models ...
        // confere se existe um artigo com a mesma url
        $query = $this->db->get_where('artigos', array('url' => url_title(
                    convert_accented_characters
                            ($this->input->post('url'))
            ))
        );

        if ($query->num_rows() > 0) {
            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Oops!</strong> já existe um artigo com essa URL.
					</div>'
            );

            redirect(base_url() . 'admin/artigos/', 'refresh');
        }


        $validacoes = array(
            array(
            	'field' => 'categoria',
                'label' => 'categoria',
                'rules' => 'required|min_length[1]'
            ),
        		
            array(
            	'field' => 'categoria_id',
                'label' => 'id da categoria',
                'rules' => 'required'
            ),
        		
            array(
            	'field' => 'titulo',
                'label' => 'título',
                'rules' => 'required|min_length[5]'
            ),
        		
            array(
            	'field' => 'url',
                'label' => 'URL',
                'rules' => 'required|min_length[4]|max_length[70]'
            ),
        		
            array(
            	'field' => 'data',
                'label' => 'data',
                'rules' => 'required'
            ),
        		
            array(
            	'field' => 'descricao',
                'label' => 'descrição',
                'rules' => 'required|min_length[15]'
            ),
        		
            array(
            	'field' => 'status',
                'label' => 'status',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($validacoes);



        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            /*
             * Multi upload/database para a galeria de imagens prettyPhoto
             * Para a atualização: if($_FILES['imagem_']['size'] == 0){}
             *  
             *  */


            $arr_files = @$_FILES['userfile'];

            $_FILES = array();

            foreach (array_keys($arr_files['name']) as $h)
                $_FILES["imagem_{$h}"] = array('name' => $arr_files['name'][$h],
                    'type' => $arr_files['type'][$h],
                    'tmp_name' => $arr_files['tmp_name'][$h],
                    'error' => $arr_files['error'][$h],
                    'size' => $arr_files['size'][$h]);


            // Limite da quantidade de arquivos
            if (count($_FILES) > 10) {
                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-error">
								  <button type="button" class="close" data-dismiss="alert">×</button>
								  <strong>Oops!</strong> quantidade de arquivos não permitida.
								</div>'
                );

                redirect(base_url() . 'admin/artigos/', 'refresh');
            }




            // upload
            $this->load->library('upload');

            $arr_config_upload = array(
                'allowed_types' => 'gif|jpg|png',
                'upload_path' => './assets/uploads/imagens/'
            );

            foreach (array_keys($_FILES) as $h) {

                $this->upload->initialize($arr_config_upload);

                if ($this->upload->do_upload($h)) {

                    $arr_file_data = $this->upload->data();

                    /* Message: Undefined offset:
                     * Mudar o index.php para production
                     * essa mensagem de erro não está inteferindo no funcionamento
                     * do upload multiplo.    
                     */
                    for ($i = 0; $i <= 9; $i++) {

                        $imagem = "imagem_" . $i;

                        $data[$imagem] = $arr_files['name'][$i];

                        //========================================================
                        // resize
                        $this->load->library('image_lib');

                        $arr_config_resize = array(
                            // resize config
                            'image_library' => 'gd2',
                            'source_image' => './assets/uploads/imagens/' . $arr_files['name'][$i],
                            'maintain_ratio' => TRUE,
                            'overwrite' => TRUE, // ver em caso de FALSE
                            'width' => 610,
                            'height' => 460
                        );

                        // resize
                        $this->image_lib->clear();
                        $this->image_lib->initialize($arr_config_resize);
                        $this->image_lib->resize();
                    } // fim for
                }
            }
            // fim da galeria


            $data['categoria'] = $this->input->post('categoria');
            $data['categoria_id'] = $this->input->post('categoria_id');
            $data['titulo'] = $this->input->post('titulo');
            $data['url'] = url_title(convert_accented_characters($this->input->post('url')));
            $data['data'] = date('Y-m-d', strtotime($this->input->post('data')));
            $data['descricao'] = $this->input->post('descricao');
            $data['status'] = $this->input->post('status');
            $data['galeria'] = $this->input->post('galeria');

            $this->load->model('admin/artigos_model');

            if ($this->artigos_model->cadastrar($data)) {

                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-success">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  <strong>Okay!</strong> artigo cadastrado com sucesso!
						</div>'
                );

                redirect(base_url() . 'admin/artigos/', 'refresh');
            } else {
                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-error">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  <strong>Oops!</strong> ocorreu um erro ao cadastrar o artigo!
						</div>'
                );
                redirect(base_url() . 'admin/artigos/', 'refresh');
            }
        }
    }

    // altera um artigo
    function alterar($id) {
        $data['titulo'] = "Administração | Alterar artigo";

        $this->load->model('admin/categorias_model');
        $data['categorias'] = $this->categorias_model->listar();

        $this->load->model('admin/artigos_model');
        $data['artigos'] = $this->artigos_model->listar();

        $data['dados_artigo'] = $this->artigos_model->listar_dados_artigo($id);

        $this->load->view('admin/elementos/html_header', $data);
        $this->load->view('admin/elementos/menu');


        // configuração ckeditor's descrição do artigo
        $this->data['ckeditor_1'] = array(
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
                'filebrowserWindowHeight'	=> '538',
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

        $this->load->view('admin/alterar_artigo', $this->data);
        $this->load->view('admin/elementos/html_footer');
    }

    function gravar_alteracao() {
        $validacoes = array(
            array(
            	'field' => 'categoria',
                'label' => 'categoria',
                'rules' => 'required|min_length[1]'
            ),
        		
            array(
            	'field' => 'categoria_id',
                'label' => 'id da categoria',
                'rules' => 'required'
            ),
        		
            array(
            	'field' => 'titulo',
                'label' => 'Título',
                'rules' => 'required|min_length[5]'
            ),
        		
            array(
            	'field' => 'url',
                'label' => 'link permanente',
                'rules' => 'required|min_length[4]|max_length[70]'
            ),
        		
            array(
            	'field' => 'data',
                'label' => 'data',
                'rules' => 'required|min_length[1]'
            ),
        		
            array(
            	'field' => 'descricao',
                'label' => 'descrição',
                'rules' => 'required|min_length[15]'
            ),
        		
            array(
            	'field' => 'status',
                'label' => 'status',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($validacoes);
        if ($this->form_validation->run() == FALSE) {
            $this->alterar($this->input->post('id'));
        } else {
            $data['id'] = $this->input->post('id');
            $data['categoria'] = $this->input->post('categoria');
            $data['categoria_id'] = $this->input->post('categoria_id');
            $data['titulo'] = $this->input->post('titulo');
            $data['url'] = url_title(convert_accented_characters($this->input->post('url')));
            $data['data'] = date('Y-m-d', strtotime($this->input->post('data')));
            $data['descricao'] = $this->input->post('descricao');
            $data['status'] = $this->input->post('status');

            $this->load->model('admin/artigos_model');

            if ($this->artigos_model->gravar_alteracao($data)) {
                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-success">
            				<button type="button" class="close" data-dismiss="alert">×</button>
            				<strong>Okay!</strong> artigo alterado com sucesso.
          				</div>'
                );
                redirect(base_url() . 'admin/artigos/', 'refresh');
            } else {
                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-error">
            				<button type="button" class="close" data-dismiss="alert">×</button>
            				<strong>Oops!</strong> erro ao alterar artigo.
          				</div>'
                );
                redirect(base_url() . 'admin/artigos/', 'refresh');
            }
        }
    }

    // exclui um único artigo
    function excluir($id) {
        $this->load->model('admin/artigos_model');

        // não está excluindo com eficiência
        // excluindo as imagens do artigo/diretório
        for ($i = 0; $i <= 9; $i++) {

            $imagem = "imagem_" . $i;

            $excluir = $this->artigos_model->excluir_imagem($id);
            @unlink('./assets/uploads/imagens/' . $excluir[0]->$imagem);
        } // fim excluindo as imagens

        if ($this->artigos_model->excluir($id)) {
            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-success">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  <strong>Okay!</strong> artigo excluido com sucesso.
						</div>'
            );

            redirect(base_url() . 'admin/artigos/', 'refresh');
        } else {
            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-error">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  <strong>Oops!</strong> erro ao excluir artigo. 
						</div>'
            );

            redirect(base_url() . 'admin/artigos/', 'refresh');
        }
    }

// checkbox // falta unlink imagens igual excluir único ítem.
    function excluir_grupo() {
        $this->load->model('admin/artigos_model');

        // se não selecionou um checkbox
        if (!is_array($this->input->post('checkbox'))) {
            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-info">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  <strong>Oops!</strong> nenhum artigo foi selecionado.
						</div>'
            );
            redirect(base_url() . 'admin/artigos/', 'refresh');
        } else {
            foreach ($this->input->post('checkbox') as $id) {
                $this->artigos_model->excluir($id);
            }
        }

        $this->mensagem->set(
                'mensagem', '<div class="alert alert-success">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  <strong>Okay!</strong> artigos excluidos com sucesso.
						</div>'
        );

        redirect(base_url() . 'admin/artigos/', 'refresh');
    }

    // faz uma pesquisa dos artigos cadastrados na categoria selecionada.
    function pesquisa_categorias() {
        $dados['paginas'] = NULL;
        $dados['titulo'] = 'Resultados da Pesquisa';

        $query = $this->db->get('artigos');
        $dados['artigos'] = $query->result();

        $this->db->like('categoria', $this->input->post('pesquisa'));

        $query = $this->db->get('artigos');
        $dados['artigos'] = $query->result();


        $this->load->view('admin/elementos/html_header', $dados);
        $this->load->view('admin/elementos/menu');


        if (count($dados['artigos']) > 0) {
            $this->load->view('admin/artigos_pesquisa', $dados);
        } else {
            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-warning">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  <strong>Oops!</strong> nenhum artigo encontrado.
						</div>'
            );

            redirect(base_url() . 'admin/artigos/', 'refresh');
        }
        $this->load->view('admin/elementos/html_footer');
    }

    // faz uma pesquisa por artigos
    function pesquisa_artigos() {
        $dados['paginas'] = NULL;
        $dados['titulo'] = 'Resultados da Pesquisa';

        $query = $this->db->get('categorias');
        $dados['categorias'] = $query->result();

        $this->db->like('titulo', $this->input->post('pesquisa'));
        $this->db->or_like('descricao', $this->input->post('pesquisa'));

        $query = $this->db->get('artigos');
        $dados['artigos'] = $query->result();


        $this->load->view('admin/elementos/html_header', $dados);
        $this->load->view('admin/elementos/menu');


        if (count($dados['artigos']) > 0) {
            $this->load->view('admin/artigos_pesquisa', $dados);
        } else {
            $dados['termo'] = $this->input->post('pesquisa');

            $this->mensagem->set(
                    'mensagem', '<div class="alert alert-warning">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong>Oops!</strong> nenhum artigo foi encontrado com esse nome!
						  </div>'
            );
            redirect(base_url() . 'admin/artigos/', 'refresh');
        }
        $this->load->view('admin/elementos/html_footer');
    }

}
?>