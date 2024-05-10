<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Categoria_noticias_model extends Crud_Model
{

    protected $table = "categoria_noticias";

    public function __construct()
    {
        parent::__construct($this->table);

    }

    public function get_details($query = array())
    {
       //precisa mostrar o número de notícias por categoria
        $this->db->select('categoria_noticias.*, count(noticias.id) as noticias');
        $this->db->join('noticias', 'noticias.categoria_id = categoria_noticias.id', 'left');
        $this->db->group_by('categoria_noticias.id');
        return $this->db->get($this->table)->result();
    }
}
