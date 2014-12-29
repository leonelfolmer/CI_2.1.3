<?php

class Categorias_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function cadastrar($data) {
        return $this->db->insert('categorias', $data);
    }

    function listar() {
        $query = $this->db->get('categorias');
        return $query->result();
    }

    function alterar($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('categorias');
        return $query->result();
    }

    function alterar_categoria($id) {
        $this->db->where('nome', $id);
        $query = $this->db->get('categorias');
        return $query->result();
    }

    function gravar_alteracao($data) {
        $this->db->where('id', $data['id']);
        return $this->db->update('categorias', $data);
    }

    function excluir($id) {
        $this->db->where('id', $id);
        return $this->db->delete('categorias');
    }

    // relacionados
    function artigos_categoria($id) {
        $this->db->where('categoria_id', $id);
        $query = $this->db->get('artigos');
        return $query->result();
    }

}
?>