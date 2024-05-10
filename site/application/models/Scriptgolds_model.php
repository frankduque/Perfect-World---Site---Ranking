<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Scriptgolds_model extends Crud_model
{

    protected $table = 'scriptgolds';

    public function __construct()
    {
        parent::__construct($this->table);
    }



}
