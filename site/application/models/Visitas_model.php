<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Visitas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert_visita($pagina) {
        $this->db->where('pagina', $pagina);
        $query = $this->db->get("acessos_paginas");
        if ($query->num_rows() == 1) {
            $this->db->where('pagina', $pagina);
            $this->db->set('acessos', 'acessos + 1', FALSE);
            $this->db->set('ultimo_acesso', 'NOW()', FALSE);
            $this->db->update('acessos_paginas');
        } else {
            $this->db->set('pagina', $pagina);
            $this->db->set('acessos', '1');
            $this->db->set('ultimo_acesso', 'NOW()', FALSE);
            $this->db->insert('acessos_paginas');
        }
        $this->insert_visita_unica($pagina);
    }

    public function insert_visita_unica($pagina) {
        $this->db->where('pagina', $pagina);
        $this->db->where('ip', $_SERVER['REMOTE_ADDR']);
        $query = $this->db->get("acessos_unicos_paginas");
        if ($query->num_rows() == 0) {
            $this->db->set('pagina', $pagina);
            $this->db->set('ip', $_SERVER['REMOTE_ADDR']);
            $this->db->set('ultimo_acesso', 'NOW()', FALSE);
            $this->db->insert('acessos_unicos_paginas');
        }
    }

    public function get_mais_acessadas($limite = null) {
        if (!is_null($limite)) {
            $this->db->limit($limite, 0);
        }
        $this->db->select('a.pagina, a.acessos, u.unicos');
        $this->db->from('acessos_paginas a');
        $this->db->join('(SELECT u.pagina, count(*) as unicos FROM acessos_unicos_paginas u group by pagina) u', 'a.pagina = u.pagina', 'LEFT', NULL);
        $this->db->order_by('a.acessos', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_total_acessos() {
        $this->db->select('sum(acessos) as total_acessos');
        $this->db->from('acessos_paginas');
        $query = $this->db->get();
        $resultado = $query->row();
        return $resultado->total_acessos;
    }

}
