<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Eventos_model extends Crud_Model
{

    protected $table = "eventos";

    public function __construct()
    {
        parent::__construct($this->table);
    }

    public function get_details()
    {
        $this->db->select('eventos.*, categoria_eventos.nome as categoria');
        $this->db->join('categoria_eventos', 'categoria_eventos.id = eventos.categoria_id', 'left');
        return $this->db->get($this->table);

    }

}
