<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Updatepve_model extends Crud_model
{

    protected $table = "updatepve";

    public function __construct()
    {
        parent::__construct($this->table);

    }

}
