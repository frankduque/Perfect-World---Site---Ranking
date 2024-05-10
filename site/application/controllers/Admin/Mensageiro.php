<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Mensageiro_model $Mensageiro
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Upload $upload
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Config $config
 */

class Mensageiro extends AdminController
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->has_permission("Gerenciar Mensageiro")) {

            $this->forbidden();
        }
        $this->load->model('Mensageiro_model', 'Mensageiro');
    }




    public function index()
    {
        $dados['mensagens'] = $this->Mensageiro->get_all()->result();
        $this->loadview('mensageiro/index', $dados);

    }

    public function form($id = 0)
    {
        $dados['mensagem'] = $this->Mensageiro->get_one($id);
        if ($id && $dados['mensagem']->id != $id) {
            $this->set_flashdata('Falha ao editar o update', "O ID informado é inválido", 'error');
            redirect(base_url('admin/mensageiro'));
        }

        if ($id) {
            $periodicidade = explode(" ", $dados['mensagem']->periodicidade);
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

        $this->loadview('mensageiro/form', $dados);

    }

    public function salvar($id = 0)
    {
        $this->form_validation->set_rules('minutos', 'Minutos', 'required');
        $this->form_validation->set_rules('horas', 'Horas', 'required');
        $this->form_validation->set_rules('dias', 'Dias', 'required');
        $this->form_validation->set_rules('meses', 'Meses', 'required');
        $this->form_validation->set_rules('diassemana', 'Dias da semana', 'required');
        $this->form_validation->set_rules('mensagem', 'Mensagem', 'required');
        $this->form_validation->set_rules('canal', 'Canal', 'required');
        if ($this->form_validation->run() == FALSE) {
            //convert validation errors to one line string
            $erros = validation_errors();
            $erros = str_replace("\n", "", $erros);
            $erros = strip_tags($erros);

            $this->set_flashdata('Falha ao salvar o update', $erros, 'error');
            redirect(base_url('admin/mensageiro/form/' . $id));

        }

        $dados['periodicidade'] = $this->input->post('minutos') . " " . $this->input->post('horas') . " " . $this->input->post('dias') . " " . $this->input->post('meses') . " " . $this->input->post('diassemana');
        $dados['mensagem'] = $this->input->post('mensagem');
        $dados['canal'] = $this->input->post('canal');
        $sucesso = $this->Mensageiro->save($dados, $id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar o update', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Update salvo', "O update foi salva com sucesso!", 'success');
        }

        redirect(base_url('admin/mensageiro'));

    }

    public function deletar($id = null)
    {
        if (!$id) {
            redirect(base_url('admin/pve'));
        }

        $sucesso = $this->Mensageiro->delete($id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar o update', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Update deletado', "O update foi deletado com sucesso!", 'success');
        }
        redirect(base_url('admin/mensageiro'));


    }

    public function bulkdelete()
    {
        $ids = $this->input->post('ids', TRUE);
        if (is_null($ids)) {
            redirect(base_url('admin/pve/atualizacao'));
        }

        $sucesso = $this->Mensageiro->bulkdelete($ids);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar os updates', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Updates deletados', "Os updates foram deletados com sucesso!", 'success');
        }
        redirect(base_url('admin/mensageiro'));

    }
}