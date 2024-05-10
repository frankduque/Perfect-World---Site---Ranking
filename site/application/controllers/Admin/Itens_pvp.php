<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Itens_pvp_model $Itens_pvp
 * @property Saque_itens_pvp_model $Saques
 * @property Itens_model $Itens
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Upload $upload
 * @property CI_Input $input
 */

class Itens_pvp extends AdminController
{


    public function __construct()
    {
        parent::__construct();

        if (!$this->has_permission("Gerenciar Ranking PVP")) {

            $this->forbidden();
        }
        $this->load->model('Itens_pvp_model', 'Itens_pvp');
        $this->load->model('Itens_model', 'Itens');
        $this->load->model('Saque_itens_pvp_model', 'Saques');
    }

    public function index()
    {
        $dados['itens'] = $this->Itens_pvp->get_all()->result();
        $this->loadview('competitivo/pvp/itens', $dados);

    }

    public function form($id = 0)
    {

        $dados['item'] = $this->Itens_pvp->get_one($id);
        $this->loadview('competitivo/pvp/form_item', $dados);

    }

    public function item()
    {
        if (!$this->input->is_ajax_request()) {
            redirect(base_url('admin/dashboard'));

        }

        $itemid = $this->input->post('itemid');
        header('Content-Type: application/json');
        if (is_null($itemid)) {
            $retorno['erro'] = "Não encontrado / Indisponível";
            echo json_encode($retorno);
            exit;
        }

        $item = $this->Itens->get_item($itemid);
        if (is_null($item)) {
            $retorno['erro'] = true;
        } else {
            $retorno = $item;
        }

        echo json_encode($retorno);

    }

    public function salvar($id = 0)
    {

        $this->form_validation->set_rules('itemid', 'Item ID', 'required|numeric');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('pontossaque', 'Pontos Saque', 'required|numeric');
        $this->form_validation->set_rules('pos', 'POS', 'required|numeric');
        $this->form_validation->set_rules('count', 'Count', 'required|numeric');
        $this->form_validation->set_rules('max_count', 'Max_count', 'required|numeric');
        $this->form_validation->set_rules('data', 'Data', 'required');
        $this->form_validation->set_rules('proctype', 'Proctype', 'required');
        $this->form_validation->set_rules('expire_date', 'Expire_date', 'required');
        $this->form_validation->set_rules('guid1', 'GUID1', 'required');
        $this->form_validation->set_rules('guid2', 'GUID2', 'required');
        $this->form_validation->set_rules('mask', 'Mask', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->set_flashdata("Falha ao salvar o item", validation_errors(), 'error');
            redirect(base_url('admin/itens_pvp/form/' . $id));

        }
        $dados = array(
            'itemid' => $this->input->post('itemid'),
            'nome' => $this->input->post('nome'),
            'pontossaque' => $this->input->post('pontossaque'),
            'pos' => $this->input->post('pos'),
            'count' => $this->input->post('count'),
            'max_count' => $this->input->post('max_count'),
            'data' => $this->input->post('data'),
            'proctype' => $this->input->post('proctype'),
            'expire_date' => $this->input->post('expire_date'),
            'guid1' => $this->input->post('guid1'),
            'guid2' => $this->input->post('guid2'),
            'mask' => $this->input->post('mask'),
        );
        $sucesso = $this->Itens_pvp->save($dados, $id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar o item', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Item salvo', "O item foi salvo com sucesso!", 'success');
        }
        redirect(base_url('admin/itens_pvp'));

    }

    public function deletar($id = null)
    {
        if (is_null($id)) {
            redirect(base_url('admin/itens_pvp'));
        }
        $sucesso = $this->Itens_pvp->delete($id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar o item', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Item deletado', "O item foi deletado com sucesso!", 'success');
        }
        redirect(base_url('admin/itens_pvp'));

    }

    public function bulkdelete()
    {
        $ids = $this->input->post('ids', TRUE);
        if (is_null($ids)) {
            redirect(base_url('admin/itens_pvp'));
        }
        $sucesso = $this->Itens_pvp->delete($ids);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar o item', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Item deletado', "O item foi deletado com sucesso!", 'success');
        }
        redirect(base_url('admin/itens_pvp'));

    }

    public function trocas()
    {
        $dados['trocas'] = $this->Saques->get_all()->result();

        $this->loadview('competitivo/pvp/trocas', $dados);

    }









}