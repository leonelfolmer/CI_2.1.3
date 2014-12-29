<?php

class Contato_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function listar() {
        $query = $this->db->get('contato');
        return $query->result();
    }

    function alterar($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('contato');
        return $query->result();
    }

    function alterar_contato($id) {
        $this->db->where('descricao', $id);
        $query = $this->db->get('contato');
        return $query->result();
    }

    function gravar_alteracao($data) {
        $this->db->where('id', $data['id']);
        return $this->db->update('contato', $data);
    }

}
?>