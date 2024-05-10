<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Downloads_model extends Crud_model
{

    protected $table = "downloads";

    public function __construct()
    {
        parent::__construct($this->table);

    }

    public function total_downloads()
    {
        $this->db->select('sum(downloads) as total');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->row()->total;
    }

    function add_download($id)
    {
        $this->db->set('downloads', 'downloads+1', FALSE);
        $this->db->where('id', $id);
        $this->db->update($this->table);
    }
}
