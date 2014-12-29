<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Combo_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_dropdown($nome, $valor) {
        $arr = array();
        switch ($nome) {
            case 'estado' :
                $query = $this->db->where('estado_id', $valor)
                        ->get('cidades');

                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                        $arr[] = array($row->id => $row->nome);
                    }
                } else {
                    $arr[] = array('0' => 'Sem Cidade');
                }

                break;
            case 'cidade' :
                $query = $this->db->where('cidade_id', $valor)
                        ->get('bairros');

                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                        $arr[] = array($row->id => $row->nome);
                    }
                } else {
                    $arr[] = array('0' => 'Sem Bairro');
                }
                break;
            default :
                $arr[] = array(
                    array('1' => 'Data 1'),
                    array('2' => 'Data 2'),
                    array('3' => 'Data 3')
                );
                break;
        }
        return $arr;
    }

}

