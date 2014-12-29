<?php

class Newsletter_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function cadastrar($data) {
        return $this->db->insert('newsletter', $data);
    }

}
?>