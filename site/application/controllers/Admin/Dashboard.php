<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Usuarios_model $Usuarios
 * @property Visitas_model $Visitas
 * @property Downloads_model $Downloads
 * @property CI_Session $session
 */

class Dashboard extends AdminController
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Usuarios_model', 'Usuarios');
        $this->load->model('Visitas_model', 'Visitas');
        $this->load->model('Downloads_model', 'Downloads');
    }

    public function index()
    {
        $dados = array();
        if ($this->has_permission("Gerenciar Dashboard")) {
            //Buscar as 5 páginas mais visitadas
            $dados['acessos'] = $this->Visitas->get_mais_acessadas(5);
            $dados['total_acessos'] = $this->Visitas->get_total_acessos();
            //Buscar as 5 downloads mais baixados

            $dados['downloads'] = $this->Downloads->get_all_where(array(), 5, 0, 'downloads', 'DESC')->result();
            $dados['total_downloads'] = $this->Downloads->total_downloads();
            $dados['tem_permissao'] = true;
        }


        $this->loadview("dashboard/index", $dados);
    }

    public function acessos()
    {
        if ($this->has_permission("Gerenciar Dashboard")) {
            $dados['acessos'] = $this->Visitas->get_mais_acessadas();
            $soma = 0;
            foreach ($dados['acessos'] as $acesso) {
                $soma += $acesso->acessos;
            }
            $dados['total_acessos'] = $soma;
            $this->loadview("dashboard/acessos", $dados);
        } else {
            $this->set_flashdata('Acesso negado', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.", 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function downloads()
    {
        if ($this->has_permission("Gerenciar Dashboard")) {
            $dados['downloads'] = $this->Downloads->get_all_where(array(), 5, 0, 'downloads', 'DESC')->result();
            $dados['total_downloads'] = $this->Downloads->total_downloads();

            $this->loadview("dashboard/downloads", $dados);
        } else {
            $this->set_flashdata('Acesso negado', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.", 'error');
            redirect(base_url('admin/dashboard'));
        }
    }


}
