<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Itens_pvp_model extends Crud_Model
{

    protected $table = "itens_pvp";

    public function __construct()
    {
        parent::__construct($this->table);

    }

}
