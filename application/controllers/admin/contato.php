<?php

class Contato extends CI_Controller {

    private $data = array();

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            // redireciona, tem que estar logado para ver esta página
            redirect(base_url() . 'admin/aut/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            // redireciona, tem que ser do grupo dos administradores para ver esta página
            redirect(base_url() . 'admin/aut/login', 'refresh');
        }
    }

    function index() {
        $data['titulo'] = "Administração | contato";

        $this->load->model('admin/contato_model');
        $data['contato'] = $this->contato_model->listar();

        $this->load->view('admin/elementos/html_header', $data);
        $this->load->view('admin/elementos/menu');
        $this->load->view('admin/contato', $this->data);
        $this->load->view('admin/elementos/html_footer');
    }

    // altera a p�gina contato
    function alterar($id) {
        $data['titulo'] = "Administração | Formulário";

        $this->load->model('admin/contato_model');
        $data['dados_contato'] = $this->contato_model->alterar($id);

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
                'filebrowserBrowseUrl' 			=> '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserImageBrowseUrl' 	=> '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserFlashBrowseUrl' 	=> '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserUploadUrl' 			=> '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserImageUploadUrl' 	=> '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserFlashUploadUrl' 	=> '/CI_2.1.3/js/admin/global/ckfinder.html',
                'filebrowserWindowWidth' 		=> '800',
                'filebrowserWindowHeight' 		=> '538',
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

        $this->load->view('admin/alterar_contato', $this->data);
        $this->load->view('admin/elementos/html_footer');
    }

    function gravar_alteracao() {
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'descricao',
                'label' => 'Descrição',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->alterar($this->input->post('id'));
        } else {
            $data['id'] = $this->input->post('id');
            $data['descricao'] = $this->input->post('descricao');

            $this->load->model('admin/contato_model');
            if ($this->contato_model->gravar_alteracao($data)) {
                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-success">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  <strong>Okay!</strong> alterado com successo!
						</div>'
                );

                redirect(base_url() . 'admin/contato/alterar/1', 'refresh');
            } else {
                $this->mensagem->set(
                        'mensagem', '<div class="alert alert-error">
						  <button type="button" class="close" data-dismiss="alert">×</button>
						  <strong>Oops!</strong> erro ao alterar a página de contato.
						</div>'
                );

                redirect(base_url() . 'admin/contato/alterar/1', 'refresh');
            }
        }
    }

}
?>