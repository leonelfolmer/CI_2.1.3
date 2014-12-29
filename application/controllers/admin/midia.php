<?php

class Midia extends CI_Controller {

    private $data = array();

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            // redireciona, tem que estar logado para ver esta p�gina
            redirect(base_url() . 'admin/aut/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            // redireciona, tem que ser do grupo dos administradores para ver esta p�gina
            redirect(base_url() . 'admin/aut/login', 'refresh');
        }
    }

    function index() {
        $data['titulo'] = "Administração | Mídia";

        $this->load->view('admin/elementos/html_header', $data);
        $this->load->view('admin/elementos/menu');
        $this->load->view('admin/midia', $this->data);
        $this->load->view('admin/elementos/html_footer');
    }

}
?>