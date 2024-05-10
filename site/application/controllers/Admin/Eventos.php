<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Eventos_model $Eventos
 * @property Categoria_eventos_model $Categorias
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Upload $upload
 * @property CI_Input $input
 */

class Eventos extends AdminController
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Eventos_model', 'Eventos');
        $this->load->model('Categoria_eventos_model', 'Categorias');
        if (!$this->has_permission("Gerenciar Notícias")) {
            $this->forbidden();
        }
    }


    public function index()
    {
        $dados['eventos'] = $this->Eventos->get_details()->result();
        $this->loadview("eventos/index", $dados);

    }

    public function form($id = 0)
    {

        $dados['evento'] = $this->Eventos->get_one($id);
        $dados['editing'] = $id ? true : false;
        if ($id && $dados['evento']->id != $id) {
            $this->set_flashdata('Falha ao editar a evento', "O ID informado é inválido", 'error');
            redirect(base_url('admin/eventos'));
        }

        $dados['categorias'] = $this->Categorias->get_dropdown_list(['nome']);
        $this->loadview("eventos/form", $dados);
    }


    public function salvar($id = 0)
    {
        $this->form_validation->set_rules('titulo', 'Título', 'required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('conteudo', 'Conteúdo', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->set_flashdata('Atenção', "Não foi possível processar a solicitação", 'error');
            $this->session->set_flashdata('form', $this->input->post());
            redirect(base_url('admin/eventos/form/' . $id));
        }

        $data = array(
            'titulo' => $this->input->post('titulo'),
            'conteudo' => $this->input->post('conteudo'),
            'categoria_id' => $this->input->post('categoria'),
        );

        if (!$id) {
            $data['datacriacao'] = date('Y-m-d H:i:s');
            $data['usuario_id'] = $this->session->id;

        }


        $sucesso = $this->Eventos->save($data, $id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar a evento', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Evento salvo', "O evento foi salva com sucesso!", 'success');
        }
        redirect(base_url('admin/eventos'));

    }

    public function deletar($id = null)
    {
        if (is_null($id)) {
            redirect(base_url('admin/eventos'));
        }
        $sucesso = $this->Eventos->delete($id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar a evento', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Evento deletada', "A evento foi deletada com sucesso!", 'success');
        }

        redirect(base_url('admin/eventos'));


    }

    public function bulkdelete()
    {
        $ids = $this->input->post('ids', TRUE);
        if (is_null($ids)) {
            redirect(base_url('admin/eventos'));
        }

        if (!$this->Eventos->bulkdelete($ids)) {
            $this->set_flashdata('Falha ao deletar as eventos', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Eventos deletadas', "Os eventos selecionados foram deletados com sucesso!", 'success');
        }

        redirect(base_url('admin/eventos'));
    }


    public function categorias()
    {
        $this->load->model('eventos_model');
        $dados['categorias'] = $this->Categorias->get_all()->result();

        $this->loadview("eventos/categorias", $dados);

    }

    public function salvar_categoria()
    {

        $id = $this->input->post('id');
        $nome = $this->input->post('nome');

        $data = array(
            'nome' => $nome,
        );

        if (!$id) {
            $data['datacriacao'] = date('Y-m-d H:i:s');
        }

        if (!$this->Categorias->save($data, $id)) {
            $this->set_flashdata('Atenção', "Não foi possível processar a solicitação", 'error');
        } else {

            $this->set_flashdata('Sucesso', "A categoria foi " . ($id ? "atualizada" : "criada") . " com sucesso!", 'success');
        }
        redirect(base_url('admin/eventos/categorias'));

    }


    public function deletar_categoria($id = null)
    {
        if (is_null($id)) {
            redirect(base_url('admin/eventos/categorias'));
        }

        $qtd_eventos = $this->Eventos->get_all_where(array('categoria_id' => $id))->num_rows();
        if ($qtd_eventos > 0) {
            $this->set_flashdata('Falha ao deletar a categoria', "Existem notícias associadas a esta caregoria.", 'error');
            redirect(base_url('admin/eventos/categorias'));
        }

        if (!$this->Categorias->delete($id)) {

            $this->set_flashdata('Falha ao deletar a categoria', "Não foi possível processar a solicitação", 'error');
        } else {

            $this->set_flashdata('Categoria deletada', "A categoria foi deletada com sucesso!", 'success');
        }

        redirect(base_url('admin/eventos/categorias'));

    }



}