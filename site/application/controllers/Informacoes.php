<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Description of Informacoes
 *
 * @property Visitas_model $Visitas
 * @property Tutoriais_model $Tutoriais
 * @property Eventos_model $Eventos
 * @property CI_Config $config
 * @property CI_Loader $load
 * @property CI_Input $input
 */

class Informacoes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Visitas_model", "Visitas");
        $this->load->model("Tutoriais_model", "Tutoriais");
        $this->load->model("Eventos_model", "Eventos");
    }

    public function index()
    {
        $this->loadview('informacoes');
    }

    public function servidor()
    {
        $this->loadview('servidor');
    }

    public function tutoriais()
    {
        $this->load->model('Tutoriais_model');
        $dados['tutoriais'] = $this->Tutoriais->get_details()->result();
        foreach ($dados['tutoriais'] as $tutorial) {
            $dados['categorias'][$tutorial->categoria][] = $tutorial;
        }
        $this->loadview('tutoriais', $dados);
    }

    public function eventos()
    {
        $this->load->model('Eventos_model');
        $dados['eventos'] = $this->Eventos->get_details()->result();
        $dados['categorias'] = array();
        foreach ($dados['eventos'] as $evento) {
            $dados['categorias'][$evento->categoria][] = $evento;
        }
        $this->loadview('eventos', $dados);
    }

    public function loadview($pagina, $data = null)
    {
        $data['pagina'] = $pagina;
        $this->Visitas->insert_visita($pagina);
        $this->load->view('site/header', $data);
        $this->load->view('site/informacoes/' . $pagina, $data);
        $this->load->view('site/footer', $data);
    }

}
