<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Mensagens_pvp_model $Mensagens
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Upload $upload
 * @property CI_Input $input
 */

class Mensagens_pvp extends AdminController
{

    public $placeholders = array(
        'nick_matou' => 'Mostra o nick do personagem que matou',
        'nick_morreu' => 'Mostra o nick do personagem que morreu',
        'classe_matou' => 'Mostra a classe do personagem que matou',
        'classe_morreu' => 'Mostra a classe do personagem que morreu',
        'pontos_matou' => 'Mostra os pontos pvp do personagem que matou',
        'pontos_morreu' => 'Mostra os pontos pvp do personagem que morreu',
        'posicao_matou' => 'Mostra a posição do personagem que matou',
        'posicao_morreu' => 'Mostra a posição do personagem que morreu',
        'nivel_matou' => 'Mostra o nível do personagem que matou',
        'nivel_morreu' => 'Mostra o nível do personagem que morreu',
        'guilda_matou' => 'Mostra a guilda do personagem que matou',
        'guilda_morreu' => 'Mostra a guilda do personagem que morreu',
    );

    public function __construct()
    {
        parent::__construct();

        if (!$this->has_permission("Gerenciar Ranking PVP")) {

            $this->forbidden();
        }
        $this->load->model('Mensagens_pvp_model', 'Mensagens');
    }


    public function index()
    {
        $dados['mensagens'] = $this->Mensagens->get_all()->result();
        $dados['placeholders'] = $this->placeholders;
        $this->loadview('competitivo/pvp/mensagens', $dados);
    }

    public function form($id = 0)
    {

        $dados['mensagem'] = $this->Mensagens->get_one($id);
        if (is_null($dados['mensagem'])) {
            $this->set_flashdata('Falha ao editar a mensagem', "O ID informado é inválido", 'error');
            redirect(base_url('admin/mensagens_pvp'));
        } else {
            $dados['is_editing'] = $id > 0;
            $dados['placeholders'] = $this->placeholders;
            $this->loadview("competitivo/pvp/form_mensagem", $dados);
        }

    }

    public function salvar($id = 0)
    {

        $this->form_validation->set_rules('mensagem', 'Mensagem', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->set_flashdata('Falha ao salvar a mensagem', strip_tags(trim(validation_errors())), 'error');
            redirect(base_url('admin/mensagens_pvp/form/' . $id));
        }

        $data = array(
            'mensagem' => $this->input->post('mensagem', TRUE),
        );

        $sucesso = $this->Mensagens->save($data, $id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao editar a mensagem', "Não foi possível processar a solicitação", 'error');
            redirect(base_url('admin/mensagens_pvp'));
        } else {
            $this->set_flashdata('Mensagem atualizada', "A mensagem foi atualizada com sucesso!", 'success');
            redirect(base_url('admin/mensagens_pvp'));
        }

    }


    public function deletar($id)
    {
        if (!$id) {
            redirect(base_url('admin/mensagens_pvp'));
        }

        $sucesso = $this->Mensagens->delete($id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar a mensagem', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Mensagem deletada', "A kill foi deletada com sucesso!", 'success');
        }
        redirect(base_url('admin/mensagens_pvp'));

    }



    public function bulkdelete()
    {
        $ids = $this->input->post('ids', TRUE);
        if (is_null($ids)) {
            redirect(base_url('admin/mensagens_pvp'));
        }

        $sucesso = $this->Mensagens->bulkdelete($ids);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar as mensagens', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Sucesso', "As mensagens selecionadas foram deletadas com sucesso!", 'success');
        }
        redirect(base_url('admin/mensagens_pvp'));

    }







}