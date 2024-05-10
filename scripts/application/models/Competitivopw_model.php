<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Competitivopw_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db = $this->load->database("pw", TRUE);
    }

    function getAccounts() {
        $query = $this->db->select("ID, name");
        $query = $this->db->get("users");
        return $query->result();
    }

    function sendGold($conta, $quantidade) {
        $sql = "CALL usecash(" . $this->db->escape($conta) . ", 1, 0, 1, 0, " . $this->db->escape($quantidade) . ", 1, @error)";
        $this->db->simple_query($sql);
    }

}
