<?php

class Area extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            // redireciona, tem que estar logado para ver esta p�gina
            redirect(base_url() . 'usuario/aut/login', 'refresh');
        }
    }

    function index() {

        $this->load->view('usuario/area');
    }

    // erro
    function erro() {
        $this->load->view('usuario/erro');
    }

}
?>