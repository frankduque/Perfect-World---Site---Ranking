<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Tutoriais_model extends Crud_Model
{


    protected $table = "tutoriais";

    public function __construct()
    {
        parent::__construct($this->table);
    }

    public function get_details()
    {
        $this->db->select('tutoriais.*, categoria_tutoriais.nome as categoria');
        $this->db->join('categoria_tutoriais', 'categoria_tutoriais.id = tutoriais.categoria_id', 'left');
        return $this->db->get($this->table);
    }

}
