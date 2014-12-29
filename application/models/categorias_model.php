<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categorias_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function listar_dados_categoria() {
        $this->db->where('status', 'Ativo');
        $query = $this->db->get('categorias');
        return $query->result();
    }

    function listar_dados_artigos_categoria($url) {
        $this->db->select('artigos.*,categorias.url as nome_categoria');
        $this->db->join('categorias', 'artigos.categoria = categorias.url');
        $this->db->where('artigos.categoria =', $url);
        $query = $this->db->get('artigos');

        return $query->result();
    }

}

