<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Artigos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function listar_dados_artigo($url) {
        $this->db->where('url', $url);
        $query = $this->db->get('artigos');
        return $query->result();
    }

    function listar_dados_artigos() {
        $query = $this->db->get('artigos');
        return $query->result();
    }

}

