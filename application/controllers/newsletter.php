<?php

class Newsletter extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $dados['titulo'] = 'Newsletter';
        $this->load->model('newsletter_model');

        $this->db->where('status', 'Ativo');
        $query = $this->db->get('categorias');
        $dados['categorias'] = $query->result();

        $this->load->view('elementos/html_header', $dados);
        $this->load->view('elementos/artigos_categorias', $dados);
        $this->load->view('newsletter');
        $this->load->view('elementos/html_footer');
    }

    function adicionar() {
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required|min_length[4]|max_length[20]'
            ),
        		
            array(
                'field' => 'email',
                'label' => 'e-mail',
                'rules' => 'trim|required|valid_email'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data['nome'] = $this->input->post('nome');
            $data['email'] = $this->input->post('email');

            $this->load->model('newsletter_model');
            if ($this->newsletter_model->cadastrar($data)) {
                $this->index();
            } else {
                echo "Erro ao assinar a Newsletter";
            }
        }
    }

}
?>