<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Configuracoes_model extends Crud_Model
{

    protected $table = "configuracoes";

    public function __construct()
    {
        parent::__construct($this->table);

    }

}