<?php

class Usuarios_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function alterar($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->result();
    }

    function alterar_usuario($id) {
        $this->db->where('username', $id);
        $query = $this->db->get('users');
        return $query->result();
    }

    function gravar_alteracao($data) {
        $this->db->where('id', $data['id']);
        return $this->db->update('users', $data);
    }

}
?>