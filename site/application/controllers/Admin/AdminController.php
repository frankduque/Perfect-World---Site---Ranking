<?php


defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of AdminController
 *
 * @property CI_Session $session
 */

class AdminController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios_model');

        if (!$this->_checa_sessao()) {
            redirect('admin/login');
        }

    }

    private function _checa_sessao()
    {
        if (isset($this->session->id) and in_array($this->session->permissao, ['Admin', 'Equipe'])) {
            return true;
        } else {
            return false;
        }
    }

    public function loadview($pagina, $data = null)
    {
        $data['pagina'] = $pagina;
        $this->load->view('painel/admin/header', $data);
        $this->load->view('painel/admin/' . $pagina, $data);
        $this->load->view('painel/admin/footer', $data);
    }

    public function has_permission($permissao)
    {

        if (!in_array($permissao, $this->session->permissoes)) {
            return false;
        }
        return true;
    }

    public function forbidden()
    {
        $this->set_flashdata('Acesso negado', "Você não tem permissão para acessar esta página.", 'error');
        redirect('admin/dashboard');
    }

    public function set_flashdata($titulo, $mensagem, $tipo = 'info', $opicional = array())
    {
        $this->session->set_flashdata('titulo', $titulo);
        $this->session->set_flashdata('msg', $mensagem);
        $this->session->set_flashdata('tipo', $tipo);
        if (count($opicional) > 0) {
            foreach ($opicional as $key => $value) {
                $this->session->set_flashdata($key, $value);
            }
        }

    }

}
