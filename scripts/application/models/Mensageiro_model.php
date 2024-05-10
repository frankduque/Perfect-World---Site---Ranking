<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mensageiro_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getMensagens() {
        $query = $this->db->get("mensageiro");
        return $query->result();
    }

   
}
