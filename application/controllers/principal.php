<?php

class Principal extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    // pagina��o da principal
    function index($offset = 0) {
        $this->load->library('pagination');
        $dados['titulo'] = 'Artigos | Principal';

        $this->db->where('status', 'Ativo');
        $query = $this->db->get('categorias');
        $dados['categorias'] = $query->result();

        // backup
        /* $this->db->where('status', 'Ativo');
          $query = $this->db->get('artigos',2,$offset); // quantidade
          $dados['artigos'] = $query->result();
          $config['base_url'] = base_url() .'principal/index/';
          $config['total_rows'] = $this->db->count_all_results('artigos'); */

        /////////////////////////////////////////////////////

        $this->db->where('status', 'Ativo');
        $config['total_rows'] = $this->db->count_all_results('artigos');
        $this->db->or_where('status', 'Ativo');
        $query = $this->db->get('artigos', 2, $offset);
        $dados['artigos'] = $query->result();

        /////////////////////////////////////////////////////

        $config['base_url'] = base_url() . 'principal/index/';
        $config['per_page'] = '2'; // quantidade
        $config['uri_segment'] = '3';
        $config['num_links'] = '2';

        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';

        /* estilo dos bot�es

          $config['next_tag_open'] = '<div>';
          $config['next_tag_close'] = '</div>';

          $config['prev_tag_open'] = '<div>';
          $config['prev_tag_close'] = '</div>';

         */

        $this->pagination->initialize($config);
        $dados['paginas'] = $this->pagination->create_links();

        $this->load->view('elementos/html_header', $dados);
        $this->load->view('elementos/artigos_categorias', $dados);
        $this->load->view('artigos_principal', $dados);
        $this->load->view('elementos/html_footer');
    }

}
?>