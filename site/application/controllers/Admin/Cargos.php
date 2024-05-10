<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Usuarios_model $Usuarios
 * @property Cargos_model $Cargos
 * @property CI_Session $session
 * @property MY_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Config $config
 */

class Cargos extends AdminController
{

    public function __construct()
    {
        parent::__construct();


        if (!$this->has_permission("Gerenciar Cargos")) {
            $this->forbidden();
        }
        $this->load->model('Usuarios_model', 'Usuarios');
        $this->load->model('Cargos_model', 'Cargos');
    }


    public function index()
    {
        $dados['cargos'] = $this->Cargos->get_details()->result();
        $this->loadview("cargos/index", $dados);

    }

    public function form($id = 0)
    {

        $dados['cargo'] = $this->Cargos->get_one($id);
        $dados['permissoes'] = $this->config->item('permissoes');
        if ($id && $dados['cargo']->id != $id) {
            $this->set_flashdata('Falha ao editar o cargo', "O ID informado é inválido", 'error');
            redirect(base_url('admin/cargos'));
            exit;
        }

        $this->loadview("cargos/form", $dados);
    }

    public function salvar($id = 0)
    {
        $this->form_validation->set_rules('nomecargo', 'Cargo', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
            exit;
        }

        $data = array(
            'cargo' => $this->input->post('nomecargo'),
            'permissoes' => json_encode($this->input->post('permissoes'))
        );

        $sucesso = $this->Cargos->save($data, $id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar o cargo', "Não foi possível processar a solicitação", 'error');
            redirect(base_url('admin/cargos'));
        } else {
            $this->set_flashdata('Cargo salvo', "O cargo foi salvo com sucesso!", 'success');
            redirect(base_url('admin/cargos'));
        }

    }


    public function deletar($id = null)
    {
        //Verifica se o id foi informado
        if (is_null($id)) {
            redirect(base_url('admin/cargos'));
            exit;
        }

        //busca os dados do cargo
        $cargo = $this->Cargos->get_details(['id' => $id])->row();

        //Verifica se existem usuários associados ao cargo
        if ($cargo->usuarios > 0) {
            $this->set_flashdata('Falha ao deletar o cargo', "Existem usuários associadas a este cargo.", 'error');
            redirect(base_url('admin/cargos'));
            exit;
        }

        //Deleta o cargo
        $sucesso = $this->Cargos->delete($id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar o cargo', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Cargo deletado', "O cargo foi deletado com sucesso!", 'success');
        }
        redirect(base_url('admin/cargos'));

    }

}
