<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Updatetw_model $Updatetw
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Upload $upload
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Config $config
 */

class Tw extends AdminController
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->has_permission("Gerenciar Ranking TW")) {

            $this->forbidden();
        }
        $this->load->model('Updatetw_model', 'Updatetw');
    }


    

    public function index()
    {
        $dados['updates'] = $this->Updatetw->get_all()->result();
        $this->loadview('competitivo/tw/index', $dados);

    }

    public function form($id = 0)
    {
        $dados['update'] = $this->Updatetw->get_one($id);
        if ($id && $dados['update']->id != $id) {
            $this->set_flashdata('Falha ao editar o update', "O ID informado é inválido", 'error');
            redirect(base_url('admin/tw'));
        }

        if ($id) {
            $periodicidade = explode(" ", $dados['update']->periodicidade);
            $dados['minutos'] = $periodicidade[0];
            $dados['horas'] = $periodicidade[1];
            $dados['dias'] = $periodicidade[2];
            $dados['meses'] = $periodicidade[3];
            $dados['diassemana'] = $periodicidade[4];
        } else {
            $dados['minutos'] = '*/15';
            $dados['horas'] = '*';
            $dados['dias'] = '*';
            $dados['meses'] = '*';
            $dados['diassemana'] = '*';


        }

        $this->loadview('competitivo/tw/form', $dados);

    }

    public function salvar($id = 0)
    {
        $this->form_validation->set_rules('minutos', 'Minutos', 'required');
        $this->form_validation->set_rules('horas', 'Horas', 'required');
        $this->form_validation->set_rules('dias', 'Dias', 'required');
        $this->form_validation->set_rules('meses', 'Meses', 'required');
        $this->form_validation->set_rules('diassemana', 'Dias da semana', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->set_flashdata('Falha ao salvar o update', validation_errors(), 'error');
            redirect(base_url('admin/tw/form/' . $id));

        }

        $dados['periodicidade'] = $this->input->post('minutos') . " " . $this->input->post('horas') . " " . $this->input->post('dias') . " " . $this->input->post('meses') . " " . $this->input->post('diassemana');

        $sucesso = $this->Updatetw->save($dados, $id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar o update', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Update salvo', "O update foi salva com sucesso!", 'success');
        }

        redirect(base_url('admin/tw'));

    }

    public function deletar($id = null)
    {
        if (!$id) {
            redirect(base_url('admin/pve'));
        }

        $sucesso = $this->Updatetw->delete($id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar o update', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Update deletado', "O update foi deletado com sucesso!", 'success');
        }
        redirect(base_url('admin/tw'));


    }

    public function bulkdelete()
    {
        $ids = $this->input->post('ids', TRUE);
        if (is_null($ids)) {
            redirect(base_url('admin/pve/atualizacao'));
        }

        $sucesso = $this->Updatetw->bulkdelete($ids);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar os updates', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Updates deletados', "Os updates foram deletados com sucesso!", 'success');
        }
        redirect(base_url('admin/tw'));

    }
}