<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Downloads_model $Downloads
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Upload $upload
 * @property CI_Input $input
 */

class Downloads extends AdminController
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Downloads_model', 'Downloads');
        if (!$this->has_permission("Gerenciar Downloads")) {
            $this->forbidden();
        }
    }

    public function index()
    {
        $dados['downloads'] = $this->Downloads->get_all()->result();
        $this->loadview("downloads/index", $dados);

    }

    public function form($id = 0)
    {

        $dados['download'] = $this->Downloads->get_one($id);
        $dados['editing'] = $id ? true : false;
        if ($id && $dados['download']->id != $id) {
            $this->set_flashdata('Falha ao editar o download', "O ID informado é inválido", 'error');
            redirect(base_url('admin/downloads'));
        }

        $this->loadview("downloads/form", $dados);


    }


    public function salvar($id = 0)
    {

        //Validação do formulário
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->form();
            exit;
        }

        //preparação dos dados para salvar
        $dados = array(
            'nome' => $this->input->post('nome', TRUE),
            'link' => $this->input->post('link', TRUE),
            'tipo' => $this->input->post('tipo', TRUE),
        );

        if (!$id) {
            $dados['downloads'] = 0;
            $dados['datacriacao'] = date('Y-m-d H:i:s');
            $dados['caminho_imagem'] = base_url("assets/site/img/download.png");

        } else {
            $dados['dataupdate'] = date('Y-m-d H:i:s');
        }

        if (isset($_FILES['imagem']['name']) and $_FILES['imagem']['name'] != '') {
            $extensao = pathinfo($_FILES['imagem']['name'])['extension'];
            $file_name = uniqid($extensao . "_");
            $config['upload_path'] = FCPATH . 'assets/upload/downloads/';
            $config['allowed_types'] = 'gif|jpg|png|webp|jpeg|svg';
            $config['max_size'] = 10240;
            $config['max_width'] = 2048;
            $config['max_height'] = 1600;
            $config['overwrite'] = TRUE;
            $config['file_name'] = $file_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload("imagem")) {
                $dados['caminho_imagem'] = base_url("assets/upload/downloads/" . $file_name . "." . $extensao);
            }
        }


        $sucesso = $this->Downloads->save($dados, $id);

        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar o download', "Não foi possível processar a solicitação", 'error');
            redirect(base_url('admin/downloads'));
            exit;
        }
        $this->set_flashdata('Download salvo', "O download foi salvo com sucesso!", 'success');
        redirect(base_url('admin/downloads'));


    }

    public function deletar($id = null)
    {
        if (is_null($id)) {
            redirect(base_url('admin/downloads'));
        }

        $sucesso = $this->Downloads->delete($id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar o download', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Download deletado', "O download foi deletado com sucesso!", 'success');
        }
        redirect(base_url('admin/downloads'));

    }


    public function bulkdelete()
    {
        $ids = $this->input->post('ids', TRUE);
        if (is_null($ids)) {
            redirect(base_url('admin/downloads'));
        }

        if (!$this->Downloads->bulkdelete($ids)) {
            $this->set_flashdata('Falha ao deletar os downloads', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Download deletado', "Os downloads selecionados foram deletados com sucesso!", 'success');
        }

        redirect(base_url('admin/downloads'));

    }

}
