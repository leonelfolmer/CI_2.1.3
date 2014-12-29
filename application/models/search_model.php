<?php

class Search_model extends CI_Model {

    public function __construct() {
        parent:: __construct();
    }

    public function record_count() {
        return $this->db->count_all('cidades');
    }

    public function search_record_count($searchterm) {
        $sql = "SELECT COUNT(*) As cnt FROM cidades WHERE nome LIKE '%" . $searchterm . "%'";
        $q = $this->db->query($sql);
        $row = $q->row();
        return $row->cnt;
    }

    public function search($searchterm, $limit) {
        $sql = "SELECT * FROM cidades 
				WHERE nome LIKE '%" . $searchterm . "%' LIMIT " . $limit . ",20";
        $q = $this->db->query($sql);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return 0;
        }
    }

    public function fetch_bd($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('cidades');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        } else {
            return FALSE;
        }
    }

    public function searchterm_handler($searchterm) {
        if ($searchterm) {
            $this->session->set_userdata('searchterm', $searchterm);
            return $searchterm;
        } elseif ($this->session->userdata('searchterm')) {
            $searchterm = $this->session->userdata('searchterm');
            return $searchterm;
        } else {
            $searchterm = "";
            return $searchterm;
        }
    }

}
?>