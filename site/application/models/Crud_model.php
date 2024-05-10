<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Crud_model extends CI_Model
{

    protected $table;

    public function __construct($table)
    {
        parent::__construct();


        $this->use_table($table);
    }

    protected function use_table($table)
    {
        $this->table = $table;
    }

    function get_array_value($array, $key)
    {
        if (is_array($array) && array_key_exists($key, $array)) {
            return $array[$key];
        }
    }

    function get_one($id = 0)
    {
        return $this->get_one_where(array('id' => $id));
    }

    function get_one_where($where = array())
    {
        $result = $this->db->get_where($this->table, $where, 1);
        if ($result->num_rows()) {
            return $result->row();
        } else {
            $db_fields = $this->db->list_fields($this->table);
            $fields = new stdClass();
            foreach ($db_fields as $field) {
                $fields->$field = "";
            }
            return $fields;
        }
    }

    function get_all($limit = 1000000, $offset = 0, $where = array(), $sort_by_field = null, $sort_order = "ASC")
    {
        return $this->get_all_where($where, $limit, $offset, $sort_by_field, $sort_order);

    }

    function get_all_where($where = array(), $limit = 1000000, $offset = 0, $sort_by_field = null, $sort_order = "ASC")
    {
        $where_in = $this->get_array_value($where, "where_in");
        if ($where_in) {
            foreach ($where_in as $key => $value) {
                $this->db->where_in($key, $value);
            }
            unset($where["where_in"]);
        }

        $search = $this->get_array_value($where, "search");
        if ($search) {
            $like_clause = '';

            foreach ($search as $key => $value) {
                // Adiciona uma cláusula LIKE para cada campo de pesquisa
                if ($key == "itemid") {
                    $like_clause .= " $key LIKE '$value%' OR";

                } else {
                    $like_clause .= " $key LIKE '$value%' OR";
                    $like_clause .= " $key LIKE '%$value%' OR";
                }
            }

            // Remove o "OR" extra no final da string
            $like_clause = rtrim($like_clause, ' OR');

            // Adiciona a cláusula LIKE à consulta com o operador OR
            $this->db->where("($like_clause)", null, false);
            unset($where["search"]);
        }

        if ($sort_by_field) {
            $this->db->order_by($sort_by_field, $sort_order);
        }


        return $this->db->get_where($this->table, $where, $limit, $offset);

    }

    function save(&$data = array(), $id = 0)
    {

        if ($id) {
            //update
            $where = array("id" => $id);

            $success = $this->update_where($data, $where);
            return $success;
        } else {
            //insert
            if ($this->db->insert($this->table, $data)) {
                $insert_id = $this->db->insert_id();
                return $insert_id;
            }
        }
    }

    function update_where($data = array(), $where = array())
    {
        if (count($where)) {
            if ($this->db->update($this->table, $data, $where)) {
                $id = $this->get_array_value($where, "id");
                if ($id) {
                    return $id;
                } else {
                    return true;
                }
            }
        }
    }

    function delete($id)
    {

        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return ($this->db->affected_rows() != 1 ? false : true);
    }

    function bulkdelete($ids = array())
    {
        $this->db->where_in('id', $ids);
        $this->db->delete($this->table);
        return ($this->db->affected_rows() >= 1 ? true : false);
    }

    function get_dropdown_list($option_fields = array(), $key = "id", $where = array())
    {
        $list_data = $this->get_all_where($where, 0, 0, $option_fields[0])->result();
        $result = array();
        foreach ($list_data as $data) {
            $text = "";
            foreach ($option_fields as $option) {
                $text .= $data->$option . " ";
            }
            $result[$data->$key] = $text;
        }
        return $result;
    }

    function count_all()
    {
        return $this->db->count_all($this->table);
    }

}