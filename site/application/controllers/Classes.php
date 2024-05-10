<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Classes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Visitas_model");
    }

    public function index() {
        $this->loadview('classes');
    }

    public function guerreiro() {
        $this->loadview('guerreiro');
    }

    public function mago() {
        $this->loadview('mago');
    }

    public function barbaro() {
        $this->loadview('barbaro');
    }

    public function feiticeira() {
        $this->loadview('feiticeira');
    }

    public function arqueiro() {
        $this->loadview('arqueiro');
    }

    public function sacerdote() {
        $this->loadview('sacerdote');
    }

    public function mercenario() {
        if ($this->config->item("versaoservidor") >= 142) {
            redirect("/classes");
        } else {
            $this->loadview('mercenario');
        }
    }

    public function espiritualista() {
        if ($this->config->item("versaoservidor") >= 142) {
            redirect("/classes");
        } else {
            $this->loadview('espiritualista');
        }
    }

    public function arcano() {
        if ($this->config->item("versaoservidor") >= 144) {
            redirect("/classes");
        } else {
            $this->loadview('arcano');
        }
    }

    public function mistico() {
        if ($this->config->item("versaoservidor") >= 144) {
            redirect("/classes");
        } else {
            $this->loadview('mistico');
        }
    }

    public function retalhador() {
        if ($this->config->item("versaoservidor") >= 153) {
            redirect("/classes");
        } else {
            $this->loadview('retalhador');
        }
    }

    public function tormentador() {
        if ($this->config->item("versaoservidor") >= 153) {
            redirect("/classes");
        } else {
            $this->loadview('tormentador');
        }
    }

    public function loadview($pagina) {
        $data['pagina'] = $pagina;
        $this->Visitas_model->insert_visita($pagina);
        $this->load->view('site/header', $data);
        $this->load->view('site/classes/' . $pagina);
        $this->load->view('site/footer');
    }

}
