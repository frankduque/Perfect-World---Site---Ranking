<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Updatepve_model $Updatepve
 * @property Competitivo_personagem_model $Personagem
 * @property Competitivo_pvp_model $Competitivo_pvp
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Upload $upload
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Config $config
 */

class Personagens extends AdminController
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->has_permission("Gerenciar Ranking PVE")) {

            $this->forbidden();
        }
        $this->load->model('Updatepve_model', 'Updatepve');
        $this->load->model('Competitivo_personagem_model', 'Personagem');
        $this->load->model('Competitivo_pvp_model', 'Competitivo_pvp');
    }


    public function index()
    {

        redirect(base_url('admin/pve'));

    }
    public function detalhes($charid = null)
    {
        if (is_null($charid)) {
            redirect(base_url('admin/pvp'));
        }

        $dados['personagem'] = $this->Personagem->get_details($charid);
        $dados['bloqueado'] = $this->Competitivo_pvp->personagem_bloqueado($charid);

        $dados['kills'] = $this->Competitivo_pvp->get_kills($charid);
        $dados['deaths'] = $this->Competitivo_pvp->get_deaths($charid);

        if (is_null($dados['personagem'])) {
            $this->session->set_flashdata('titulo', "Falha ao buscar detalhes");
            $this->session->set_flashdata('msg', "Não foi possível encontrar os detalhes do personagem");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/pvp'));
        }

        $this->loadview('personagens/detalhes', $dados);
    }

  

    public function bloquear($charid, $return_id = false)
    {

        if (!$charid) {
            redirect(base_url('admin/pvp'));
        }

        $sucesso = $this->Competitivo_pvp->bloquear_personagem($charid);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao bloquear o personagem', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Personagem bloqueado', "O personagem foi bloqueado com sucesso!", 'success');
        }

        redirect($_SERVER['HTTP_REFERER']);


    }

    public function desbloquear($charid, $return_id = false)
    {

        if (!$charid) {
            redirect(base_url('admin/pvp'));
        }

        $sucesso = $this->Competitivo_pvp->desbloquear_personagem($charid);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao desbloquear o personagem', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Personagem desbloqueado', "O personagem foi desbloqueado com sucesso!", 'success');
        }
        redirect($_SERVER['HTTP_REFERER']);

    }



}