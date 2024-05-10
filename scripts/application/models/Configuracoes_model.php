<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracoes_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function salvarConfigs($dados, $chave) {
        $data = array(
            'valor' => json_encode($dados),
        );
        $this->db->where('chave', $chave);
        $query = $this->db->get('configuracoes');
        if ($query->num_rows() > 0) {
            $this->db->where('chave', $chave);
            $this->db->update('configuracoes', $data);
        } else {
            $this->db->set('chave', $chave);
            $this->db->insert('configuracoes', $data);
        }
        return ($this->db->affected_rows() != 1 ? false : true);
    }

}
