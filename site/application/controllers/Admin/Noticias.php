<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Noticias_model $Noticias
 * @property Categoria_noticias_model $Categorias
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Upload $upload
 * @property CI_Input $input
 */

class Noticias extends AdminController
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Noticias_model', 'Noticias');
        $this->load->model('Categoria_noticias_model', 'Categorias');
        if (!$this->has_permission("Gerenciar Notícias")) {
            $this->forbidden();
        }
    }


    public function index()
    {
        $dados['noticias'] = $this->Noticias->get_details();
        $this->loadview("noticias/index", $dados);

    }

    public function form($id = 0)
    {

        $dados['noticia'] = $this->Noticias->get_one($id);
        $dados['editing'] = $id ? true : false;
        if ($id && $dados['noticia']->id != $id) {
            $this->set_flashdata('Falha ao editar a noticia', "O ID informado é inválido", 'error');
            redirect(base_url('admin/noticias'));
        }

        $dados['categorias'] = $this->Categorias->get_dropdown_list(['nome']);
        $this->loadview("noticias/form", $dados);
    }


    public function salvar($id = 0)
    {
        $this->form_validation->set_rules('titulo', 'Título', 'required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('resumo', 'Resumo', 'required|min_length[1]|max_length[250]');
        $this->form_validation->set_rules('conteudo', 'Conteúdo', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->form();
            exit;
        }

        $data = array(
            'titulo' => $this->input->post('titulo'),
            'conteudo' => $this->input->post('conteudo'),
            'categoria_id' => $this->input->post('categoria'),
            'resumo' => $this->input->post('resumo'),
            'destaque' => $this->input->post('destaque') ? 1 : 0,
        );

        if ($id) {
            $data['dataupdate'] = date('Y-m-d H:i:s');
        } else {
            $data['usuario_id'] = $this->session->id;
            $data['datacriacao'] = date('Y-m-d H:i:s');
            $data['arquivo_header'] = base_url("assets/site/img/blog-img-1.jpg");

        }

        if (isset($_FILES['imagem']['name']) and $_FILES['imagem']['name'] != '') {
            $extensao = pathinfo($_FILES['imagem']['name'])['extension'];
            $file_name = uniqid($extensao . "_");

            $config['upload_path'] = FCPATH . 'assets/upload/noticias/';
            $config['allowed_types'] = 'gif|jpg|png|webp|jpeg|svg';
            $config['max_size'] = 10240;
            $config['max_width'] = 2048;
            $config['max_height'] = 1600;
            $config['overwrite'] = TRUE;
            $config['file_name'] = $file_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload("imagem")) {
                $data['arquivo_header'] = base_url("assets/upload/noticias/" . $file_name . "." . $extensao);

            } else {
                $this->set_flashdata('Falha ao salvar a noticia', $this->upload->display_errors(), 'error');
                redirect(base_url('admin/noticias'));
            }
        }

        $sucesso = $this->Noticias->save($data, $id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar a noticia', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Noticia salva', "A notícia foi salva com sucesso!", 'success');
        }
        redirect(base_url('admin/noticias'));

    }

    public function deletar($id = null)
    {
        if (is_null($id)) {
            redirect(base_url('admin/noticias'));
        }
        $sucesso = $this->Noticias->delete($id);
        if (!$sucesso) {
            $this->set_flashdata('titulo', "Falha ao deletar a noticia", "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Noticia deletada', "A notícia foi deletada com sucesso!", 'success');
        }

        redirect(base_url('admin/noticias'));


    }

    public function bulkdelete()
    {
        $ids = $this->input->post('ids', TRUE);
        if (is_null($ids)) {
            redirect(base_url('admin/noticias'));
        }

        if (!$this->Noticias->bulkdelete($ids)) {
            $this->set_flashdata('Falha ao deletar as noticias', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Noticias deletadas', "As noticias selecionados foram deletados com sucesso!", 'success');
        }

        redirect(base_url('admin/noticias'));
    }


    public function categorias()
    {
        $this->load->model('Noticias_model');
        $dados['categorias'] = $this->Categorias->get_all()->result();

        $this->loadview("noticias/categorias", $dados);

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
            $this->set_flashdata('Falha ao editar a categoria', "Não foi possível processar a solicitação", 'error');
        } else {

            $this->set_flashdata('Sucesso', "A categoria foi " . ($id ? "atualizada" : "criada") . " com sucesso!", 'success');
        }
        redirect(base_url('admin/noticias/categorias'));

    }


    public function deletar_categoria($id = null)
    {
        if (is_null($id)) {
            redirect(base_url('admin/noticias/categorias'));
        }

        $qtd_noticias = $this->Noticias->get_all_where(array('categoria_id' => $id))->num_rows();
        if ($qtd_noticias > 0) {
            $this->set_flashdata('Falha ao deletar a categoria', "Existem notícias associadas a esta caregoria.", 'error');
            redirect(base_url('admin/noticias/categorias'));
        }

        if (!$this->Categorias->delete($id)) {

            $this->set_flashdata('Falha ao deletar a categoria', "Não foi possível processar a solicitação", 'error');
        } else {

            $this->set_flashdata('Categoria deletada', "A categoria foi deletada com sucesso!", 'success');
        }

        redirect(base_url('admin/noticias/categorias'));

    }



}