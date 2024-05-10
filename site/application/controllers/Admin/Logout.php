<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Usuarios_model $Usuarios
 * @property Cargos_model $Cargos
 * @property CI_Session $session
 * @property MY_Form_validation $form_validation
 */

class Logout extends AdminController
{

    public function __construct()
    {
        parent::__construct();

    }


    public function index()
    {
        if ($this->session->bloqueiologin != null) {
            $bloqueiologin = $this->session->bloqueiologin;
            $this->session->sess_destroy();
            $data = array(
                'bloqueiologin' => $bloqueiologin
            );
            $this->session->set_userdata($data);
            header('location: ' . base_url('admin/login'));
            exit();
        } else {
            $this->session->sess_destroy();
            header('location: ' . base_url('admin/login'));
            exit();
        }
    }

}
