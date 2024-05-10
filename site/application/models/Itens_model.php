<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Itens_model extends Crud_model
{

    protected $table = "itens";

    public function __construct()
    {
        parent::__construct($this->table);

    }

    public function importRaeData($data)
    {
        //break the data into chunks
        $chunks = array_chunk($data, 1000);
        foreach ($chunks as $chunk) {
            //import with specific id
            if (!$this->db->insert_batch($this->table, $chunk, 'id', 1000)) {
                return false;
            }

        }
        return true;
    }

    public function get_item($itemid)
    {
        $this->db->where('itemid', $itemid);
        //return the first row as array
        return $this->db->get($this->table)->row_array();
    }

    public function get_itens($ids = array())
    {
        if (empty($ids)) {
            return array();
        }
        $this->db->where_in('itemid', $ids);
        return $this->db->get($this->table)->result();
    }
}
