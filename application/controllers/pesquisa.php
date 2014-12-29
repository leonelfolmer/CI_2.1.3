<?php

class Pesquisa extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $dados['titulo'] = 'Pesquisa avançada';

        $this->db->where('status', 'Ativo');
        $query = $this->db->get('categorias');
        $dados['categorias'] = $query->result();

        $this->load->view('elementos/html_header', $dados);
        $this->load->view('elementos/artigos_categorias', $dados);

        $this->load->view('pesquisa');
        $this->load->view('elementos/html_footer');
    }

    public function combobox() {

        $nome = $this->input->get('_name');
        $valor = $this->input->get('_value');

        $this->load->model('combo_model');

        echo json_encode($this->combo_model->get_dropdown($nome, $valor));
    }

}
?>