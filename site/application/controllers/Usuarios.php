<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function usuarioexiste() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('Usuarios_model');
            $usuario = $this->Usuarios_model->get_usuario_by_email($this->input->post('email', TRUE), $this->input->post('id', TRUE));
            if (is_null($usuario)) {
                header('Content-Type: application/json');
                header("HTTP/1.1 404 Not Found");
            } else {
                header('Content-Type: application/json');
                header("HTTP/1.1 200 OK");
            }
        }
    }

}
