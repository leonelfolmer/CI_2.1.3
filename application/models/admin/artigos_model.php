<?php

class Artigos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function cadastrar($data) {
        return $this->db->insert('artigos', $data);
    }

    function listar() {
        $query = $this->db->get('artigos', 10);
        return $query->result();
    }

    function alterar($id) {
        $this->db->where('id', $id);
        return $this->db->get('artigos');
    }

    function gravar_alteracao($data) {
        $this->db->where('id', $data['id']);
        return $this->db->update('artigos', $data);
    }

    function excluir($id) {
        $this->db->where('id', $id);
        return $this->db->delete('artigos');
    }

    // novo
    function excluir_imagem($id) {

        $sql = "SELECT 
		    		imagem_0,imagem_1,imagem_2,imagem_3,
    				imagem_4,imagem_5,imagem_6,imagem_7,
    				imagem_6,imagem_9
        		FROM artigos WHERE id = " . $id;

        $data = $this->db->query($sql);
        return $data->result();
    }

    // novo

    function listar_dados_artigo($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('artigos');
        return $query->result();
    }

}
?>