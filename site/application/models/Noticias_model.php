<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Noticias_model extends Crud_Model
{

    protected $table = "noticias";

    public function __construct()
    {
        parent::__construct($this->table);

    }

    public function get_details($query = array())
    {
        $this->db->select('noticias.*, categoria_noticias.nome as categoria, usuarios.nome as autor');
        $this->db->join('categoria_noticias', 'categoria_noticias.id = noticias.categoria_id');
        $this->db->join('usuarios', 'usuarios.id = noticias.usuario_id');

        if (isset($query['id'])) {
            $this->db->where('noticias.id', $query['id']);
        }
        if (isset($query['limit'])) {
            $this->db->limit($query['limit']);
        }

        if (isset($query['categoria_id'])) {
            $this->db->where('noticias.categoria_id', $query['categoria_id']);
        }

        if (isset($query['chavepesquisa'])) {
            $this->db->like('titulo', $query['chavepesquisa']);
        }

        if (isset($query['paginaatual'])) {
            $this->db->limit($this->config->item('noticiasppagina'), ($query['paginaatual'] - 1) * $this->config->item('noticiasppagina'));
        }

        if (isset($query['destaque'])) {
            $this->db->where('destaque', 1);
        }

        return $this->db->get($this->table)->result();
    }

    public function get_next($id)
    {
        $this->db->select('id, titulo');
        $this->db->where('id >', $id);
        $this->db->order_by('id', 'ASC');
        $this->db->limit(1);
        $id = $this->db->get($this->table)->row()->id;
        if ($id) {
            return $this->get_details(array('id' => $id))[0];
        } else {
            return false;
        }

    }

    public function get_previous($id)
    {
        $this->db->select('id, titulo');
        $this->db->where('id <', $id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $id = $this->db->get($this->table)->row()->id;
        if ($id) {
            return $this->get_details(array('id' => $id))[0];
        } else {
            return false;
        }

    }

}
