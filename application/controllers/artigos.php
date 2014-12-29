<?php

class Artigos extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    // exibindo detalhes de um artigo
    function detalhe($url) {

        // t�tulo do detalhe
        $this->load->model('titulos_model');
        $titulo = $this->titulos_model->titulo_detalhe($url);

        foreach ($titulo as $titulo) {
            $dados['titulo'] = $titulo->titulo;
        }

        $this->load->model('categorias_model');
        $dados['categorias'] = $this->categorias_model->listar_dados_categoria();

        $this->load->model('artigos_model');
        $dados['detalhes_artigo'] = $this->artigos_model->listar_dados_artigo($url);

        $this->load->view('elementos/html_header', $dados);
        $this->load->view('elementos/artigos_categorias', $dados);
        $this->load->view('artigo_detalhes', $dados);
        $this->load->view('elementos/html_footer');
    }

    function categoria($url) {
        // título da categoria
        $this->load->model('titulos_model');
        $titulo = $this->titulos_model->titulo_categoria($url);

        foreach ($titulo as $titulo) {
            $dados['titulo'] = $titulo->nome;
        }

        $this->load->model('categorias_model');
        $dados['categorias'] = $this->categorias_model->listar_dados_categoria();

        // lista os artigos da categoria
        $this->load->model('categorias_model');
        $dados['artigos_categoria'] = $this->categorias_model->listar_dados_artigos_categoria($url);

        $this->load->view('elementos/html_header', $dados);
        $this->load->view('elementos/artigos_categorias', $dados);
        $this->load->view('categoria_artigos', $dados);
        $this->load->view('elementos/html_footer');
    }

    // pesquisa com paginação
    public function pesquisa() {

        $this->load->model('search_model');
        $this->load->library('pagination');

        $dados['paginas'] = NULL;
        $dados['titulo'] = 'Resultados da Pesquisa';

        $this->load->model('categorias_model');
        $dados['categorias'] = $this->categorias_model->listar_dados_categoria();

        $this->load->model('artigos_model');
        $dados['artigos'] = $this->artigos_model->listar_dados_artigos();


        $searchterm = $this->search_model->searchterm_handler($this->input->get_post('searchterm', TRUE));
        $limit = ($this->uri->segment(3) > 0) ? $this->uri->segment(3) : 0;


        $config['base_url'] = base_url() . 'artigos/pesquisa';
        $config['total_rows'] = $this->search_model->search_record_count($searchterm);
        $config['per_page'] = '20';
        $config['uri_segment'] = '3';


        //$choice = $config['total_rows']/$config['per_page'];
        //$config['num_links'] = round($choice);
        $config['num_links'] = '2'; // limita em dois para cada ladado

        $config['first_link'] = 'Primeiro';
        $config['last_link'] = '&Uacute;ltimo';

        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';

        /* estilo dos bot�es

          $config['next_tag_open'] = '<div>';
          $config['next_tag_close'] = '</div>';

          $config['prev_tag_open'] = '<div>';
          $config['prev_tag_close'] = '</div>';

         */

        $this->pagination->initialize($config);

        $data['results'] = $this->search_model->search($searchterm, $limit);
        $data['links'] = $this->pagination->create_links();
        $data['searchterm'] = $searchterm;

        $this->load->view('elementos/html_header', $dados);
        $this->load->view('elementos/artigos_categorias', $dados);
        $this->load->view('pesquisa_paginacao', $data);
        $this->load->view('elementos/html_footer');
    }

}
?>