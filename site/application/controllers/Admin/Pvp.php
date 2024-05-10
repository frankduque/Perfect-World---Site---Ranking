<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Competitivo_pvp_model $Competitivo_pvp
 * @property Competitivo_personagem_model $Personagem
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Upload $upload
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Config $config
 */

class Pvp extends AdminController
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->has_permission("Gerenciar Ranking PVP")) {

            $this->forbidden();
        }
        $this->load->model('Competitivo_pvp_model', 'Competitivo_pvp');
        $this->load->model('Competitivo_personagem_model', 'Personagem');
    }


    public function index()
    {

        $this->loadview("competitivo/pvp/index");

    }

  


    public function deletar_kill($id, $charid)
    {
        if (!$id) {
            redirect(base_url('admin/pvp'));
        }

        $sucesso = $this->Competitivo_pvp->delete($id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar a kill', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Kill deletada', "A kill foi deletada com sucesso!", 'success');
        }
        redirect(base_url('admin/personagens/detalhes/' . $charid));

    }

    public function bulkdeletekills($charid)
    {
        $ids = $this->input->post('ids', TRUE);
        if (is_null($ids)) {
            redirect(base_url('admin/personagens/detalhes/' . $charid));
        }

        $sucesso = $this->Competitivo_pvp->bulkdelete($ids);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar as kills', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Sucesso', "As kills/deaths selecionadas foram deletadas com sucesso!", 'success');
        }
        redirect(base_url('admin/personagens/detalhes/' . $charid));

    }

}