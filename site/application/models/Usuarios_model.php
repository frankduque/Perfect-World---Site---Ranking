<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Usuarios_model extends Crud_model
{

    protected $table = "usuarios";
    public function __construct()
    {
        parent::__construct($this->table);

    }

    public function get_details($where = array())
    {
        $this->db->select('usuarios.*, cargos_usuarios.cargo, cargos_usuarios.permissoes');
        $this->db->join('cargos_usuarios', 'cargos_usuarios.id = usuarios.cargo_id', 'left');
        $this->db->where($where);
        return $this->db->get($this->table);
    }

    public function is_any_admin($ids)
    {
        $this->db->where_in('id', $ids);
        $this->db->where('permissao', 'Admin');
        return $this->db->get($this->table)->num_rows();
    }


}
