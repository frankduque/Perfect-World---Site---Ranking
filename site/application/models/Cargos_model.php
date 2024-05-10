<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Cargos_model extends Crud_model
{

    protected $table = "cargos_usuarios";

    public function __construct()
    {
        parent::__construct($this->table);

    }

    public function get_details($where = array())
    {
        $this->db->select('cargos_usuarios.*, coalesce(count(usuarios.id),0) as usuarios');
        $this->db->join('usuarios', 'usuarios.cargo_id = cargos_usuarios.id', 'left');
        if (isset($where['id'])) {
            $this->db->where('cargos_usuarios.id', $where['id']);
            unset($where['id']);
        }
        $this->db->where($where);
        $this->db->group_by('cargos_usuarios.id');
        return $this->db->get($this->table);
    }
}
