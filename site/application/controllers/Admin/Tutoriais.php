<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Tutoriais_model $Tutoriais
 * @property Categoria_tutoriais_model $Categorias
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Upload $upload
 * @property CI_Input $input
 */

class Tutoriais extends AdminController
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Tutoriais_model', 'Tutoriais');
        $this->load->model('Categoria_tutoriais_model', 'Categorias');
        if (!$this->has_permission("Gerenciar Notícias")) {
            $this->forbidden();
        }
    }


    public function index()
    {
        $dados['tutoriais'] = $this->Tutoriais->get_details()->result();
        $this->loadview("tutoriais/index", $dados);

    }

    public function form($id = 0)
    {

        $dados['tutorial'] = $this->Tutoriais->get_one($id);
        $dados['editing'] = $id ? true : false;
        if ($id && $dados['tutorial']->id != $id) {
            $this->set_flashdata('Falha ao editar a tutorial', "O ID informado é inválido", 'error');
            redirect(base_url('admin/tutoriais'));
        }

        $dados['categorias'] = $this->Categorias->get_dropdown_list(['nome']);
        $this->loadview("tutoriais/form", $dados);
    }


    public function salvar($id = 0)
    {
        $this->form_validation->set_rules('titulo', 'Título', 'required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('conteudo', 'Conteúdo', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->set_flashdata('Atenção', "Não foi possível processar a solicitação", 'error');
            $this->session->set_flashdata('form', $this->input->post());
            redirect(base_url('admin/tutoriais/form/' . $id));
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


        $sucesso = $this->Tutoriais->save($data, $id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar a tutorial', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Tutorial salvo', "O tutorial foi salva com sucesso!", 'success');
        }
        redirect(base_url('admin/tutoriais'));

    }

    public function deletar($id = null)
    {
        if (is_null($id)) {
            redirect(base_url('admin/tutoriais'));
        }
        $sucesso = $this->Tutoriais->delete($id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar a tutorial', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Tutorial deletada', "A tutorial foi deletada com sucesso!", 'success');
        }

        redirect(base_url('admin/tutoriais'));


    }

    public function bulkdelete()
    {
        $ids = $this->input->post('ids', TRUE);
        if (is_null($ids)) {
            redirect(base_url('admin/tutoriais'));
        }

        if (!$this->Tutoriais->bulkdelete($ids)) {
            $this->set_flashdata('Falha ao deletar as tutoriais', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('tutoriais deletadas', "As tutoriais selecionados foram deletados com sucesso!", 'success');
        }

        redirect(base_url('admin/tutoriais'));
    }


    public function categorias()
    {
        $this->load->model('tutoriais_model');
        $dados['categorias'] = $this->Categorias->get_all()->result();

        $this->loadview("tutoriais/categorias", $dados);

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
        redirect(base_url('admin/tutoriais/categorias'));

    }


    public function deletar_categoria($id = null)
    {
        if (is_null($id)) {
            redirect(base_url('admin/tutoriais/categorias'));
        }

        $qtd_tutoriais = $this->Tutoriais->get_all_where(array('categoria_id' => $id))->num_rows();
        if ($qtd_tutoriais > 0) {
            $this->set_flashdata('Falha ao deletar a categoria', "Existem notícias associadas a esta caregoria.", 'error');
            redirect(base_url('admin/tutoriais/categorias'));
        }

        if (!$this->Categorias->delete($id)) {

            $this->set_flashdata('Falha ao deletar a categoria', "Não foi possível processar a solicitação", 'error');
        } else {

            $this->set_flashdata('Categoria deletada', "A categoria foi deletada com sucesso!", 'success');
        }

        redirect(base_url('admin/tutoriais/categorias'));

    }



}