<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Welcome
 *
 * @property Visitas_model $Visitas
 * @property Noticias_model $Noticias
 */

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Visitas_model", "Visitas");
        $this->load->model("Noticias_model", "Noticias");
    }

    public function index() {
        $this->Visitas->insert_visita("index");
        $dados['pagina'] = "index";
        $this->load->model('Noticias_model');
        $query = array(
            'limit' => 3
        );
        $dados['noticias'] = $this->Noticias->get_details($query);
        $this->load->view('site/header', $dados);
        $this->load->view('site/index', $dados);
        $this->load->view('site/footer', $dados);
    }

}
