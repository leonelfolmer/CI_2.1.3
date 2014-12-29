<?php

class Contato extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $dados['titulo'] = 'Fale Conosco';
        $query = $this->db->get('categorias');
        $dados['categorias'] = $query->result();

        $this->load->view('elementos/html_header', $dados);
        $this->load->view('elementos/artigos_categorias', $dados);
        $this->load->view('contato');
        $this->load->view('elementos/html_footer');
    }

    function enviar() {
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required|min_length[4]|max_length[20]'
            ),
            array(
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'trim|required|valid_email'
            ),
            array(
                'field' => 'mensagem',
                'label' => 'Mensagem',
                'rules' => 'required| min_length[100]| max_length[400]| htmlspecialchars'
            ),
            array(
                'field' => 'anexo',
                'label' => 'Anexo',
                'rules' => 'allowed_types[jpg|png]'
            )
        );

        $this->form_validation->set_message('required', 'O campo %s &eacute; requerido.');
        $this->form_validation->set_message('valid_email', 'O campo %s deve conter um endere&ccedil;o de e-mail.');
        $this->form_validation->set_message('min_length', 'O campo %s deve conter pelo menos %s caracteres.');
        $this->form_validation->set_message('max_length', 'O campo %s deve conter no m&aacute;ximo %s caracteres.');

        $this->form_validation->set_message('max_length', 'O campo %s deve conter no m&aacute;ximo %s caracteres.');


        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $nome = $this->input->post('nome');
            $email = $this->input->post('email');
            $mensagem = $this->input->post('mensagem');

            $this->load->library('email');

            $this->email->from($email, $nome);

            // destino do formulário
            $this->email->to('leonel@leonelfolmer.com');
            $this->email->subject('Contato encaminhado pelo website');
            $this->email->message($mensagem);

            // envio de anexo
            move_uploaded_file($_FILES['attachments']['tmp_name'], "user_uploads/attachments/attachment.pdf");
            $this->email->attach("assets/uploads/attachments/attachment.pdf");

            $this->email->send();

            $dados['titulo'] = 'Fale Conosco';

            $query = $this->db->get('categorias');
            $dados['categorias'] = $query->result();

            $this->load->view('elementos/html_header', $dados);
            $this->load->view('elementos/artigos_categorias', $dados);
            $this->load->view('sucesso');
            $this->load->view('elementos/html_footer');
        }
    }

}
?>