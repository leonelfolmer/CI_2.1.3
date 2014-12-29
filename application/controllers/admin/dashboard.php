<?php

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();

        /*
          se estiver com o m�dulo de usuario comum instalado, retirar e rever todas
          as p�ginas de autentica��o com os par�metros corrtos.
         */
        if (!$this->ion_auth->logged_in()) {
            // redireciona, tem que estar logado para ver esta p�gina
            redirect(base_url() . 'admin/aut/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            // redireciona, tem que ser do grupo dos administradores para ver esta p�gina
            redirect(base_url() . 'admin/aut/login', 'refresh');
        }
    }

    function index() {
        $data['titulo'] = "Dashboard";

        $this->load->model('admin/dashboard_model');
        $data['categorias'] = $this->dashboard_model->listar_categorias();
        $data['artigos'] = $this->dashboard_model->listar_artigos();

        $this->load->view('admin/elementos/html_header', $data);

        $this->load->view('admin/elementos/menu');

        $this->load->view('admin/dashboard');
        $this->load->view('admin/elementos/html_footer');
    }
    
    function backup() {
    	
    	// Load the DB utility class
    	$this->load->dbutil();
    	
    	$prefs = array(
    			//'tables'      => array('table1', 'table2'),  // Array of tables to backup.
    			//'ignore'      => array(),           // List of tables to omit from the backup
    			'format'      => 'zip',             // gzip, zip, txt
    			'filename'    => 'db.sql',    // File name - NEEDED ONLY WITH ZIP FILES
    			//'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
    			//'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
    			//'newline'     => "\n"               // Newline character used in backup file
    	);
 	
    	
    	// Backup your entire database and assign it to a variable
    	$backup =& $this->dbutil->backup($prefs);
    	
    	// Load the file helper and write the file to your server
    	$this->load->helper('file');
    	write_file('/dev/CI_2.1.3/bd.zip', $backup);

    	// Load the download helper and send the file to your desktop
    	$this->load->helper('download');
    	force_download('bd.zip', $backup);
    	
    }
}
?>