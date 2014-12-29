<?php

class Dashboard_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function cadastrar($data) {
        return $this->db->insert('artigos', $data);
    }

    function listar_artigos() {
        $query = $this->db->get('artigos', 2);
        //$this->db->limit(2);
        $this->db->order_by("titulo", "desc");
        return $query->result();
    }

    function listar_categorias() {
        $query = $this->db->get('categorias');
        return $query->result();
    }

}
?>