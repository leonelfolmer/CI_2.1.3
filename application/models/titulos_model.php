<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Titulos_model extends CI_Model {

    function titulo_detalhe($url) {
        $this->db->select('titulo');
        $this->db->where('url', $url);
        $query = $this->db->get('artigos');

        foreach ($query->result() as $row) {
            $titulo[] = $row;
        }
        return $titulo;
    }

    function titulo_categoria($url) {
        $this->db->select('nome');
        $this->db->where('url', $url);
        $query = $this->db->get('categorias');

        foreach ($query->result() as $row) {
            $nome[] = $row;
        }
        return $nome;
    }

}

