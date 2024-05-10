<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Categoria_eventos_model extends Crud_Model
{

    protected $table = "categoria_eventos";

    public function __construct()
    {
        parent::__construct($this->table);

    }
}
