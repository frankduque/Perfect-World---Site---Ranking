<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Racas
 *
 * @property Visitas_model $Visitas_model
 * @property CI_Config $config
 */
class Racas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Visitas_model");
    }

    public function index()
    {
        $this->loadview('racas');
    }

    public function humanos()
    {
        $this->loadview('humanos');
    }

    public function selvagens()
    {
        $this->loadview('selvagens');
    }

    public function alados()
    {
        $this->loadview('alados');
    }

    public function abissais()
    {

        if ($this->config->item("versaoservidor") >= 142) {
            $this->loadview('abissais');
        } else {
            redirect("/racas");
        }
    }

    public function guardioes()
    {
        if ($this->config->item("versaoservidor") >= 144) {
            $this->loadview('guardioes');
        } else {
            redirect("/racas");
        }
    }

    public function sombrios()
    {
        if ($this->config->item("versaoservidor") >= 153) {
            $this->loadview('sombrios');
        } else {
            redirect("/racas");
        }
    }

    public function loadview($pagina)
    {
        $data['pagina'] = $pagina;
        $this->Visitas_model->insert_visita($pagina);
        $this->load->view('site/header', $data);
        $this->load->view('site/racas/' . $pagina);
        $this->load->view('site/footer');
    }

}
