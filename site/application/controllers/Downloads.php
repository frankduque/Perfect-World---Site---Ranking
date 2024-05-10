<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Dashboard
 *
 * @property Visitas_model $Visitas
 * @property Downloads_model $Downloads
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Upload $upload
 * @property CI_Input $input
 */
class Downloads extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Visitas_model", 'Visitas');
        $this->load->model("Downloads_model", "Downloads");
    }

    public function index()
    {
        $this->Visitas->insert_visita("downloads");
        $this->loadview('downloads');
    }

    public function download($id = null)
    {
        if ($this->input->is_ajax_request()) {
            if (!is_null($id)) {
                $download = $this->Downloads->get_one($id);
                if ($download) {
                    echo json_encode($download->link);
                    $this->Downloads->add_download($id);
                }
            }
        } else {
            redirect(base_url("downloads"));
        }
    }

    public function loadview($pagina, $data = null)
    {
        $data['pagina'] = $pagina;
        $downloads = $this->Downloads->get_all()->result();

        $data['clients'] = array();
        $data['patchers'] = array();
        foreach ($downloads as $download) {
            if ($download->tipo == "client") {
                $data['clients'][] = $download;
            } else {
                $data['patchers'][] = $download;
            }
        }

        $this->load->view('site/header', $data);
        $this->load->view('site/downloads/' . $pagina, $data);
        $this->load->view('site/footer', $data);
    }

}
