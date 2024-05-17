<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Usuarios
 *
 * @property Usuarios_model $Usuarios
 * @property Cargos_model $Cargos
 * @property CI_Session $session
 * @property MY_Form_validation $form_validation
 * @property CI_Input $input
 */

class Usuarios extends AdminController
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Usuarios_model', 'Usuarios');
        $this->load->model('Cargos_model', 'Cargos');
        if (!$this->has_permission("Gerenciar Usuários")) {
            $this->forbidden();
        }
    }

    public function index()
    {
        $dados['usuarios'] = $this->Usuarios->get_all()->result();
        $this->loadview("usuarios/index", $dados);

    }

    public function form($id = 0)
    {
        $dados['usuario'] = $this->Usuarios->get_one($id);

        if ($id && $dados['usuario']->id != $id) {
            $this->set_flashdata('Falha ao editar o usuário', "O ID informado é inválido", 'error');
            redirect(base_url('admin/usuarios'));
        }
        $dados['cargos_dropdown'] = $this->Cargos->get_dropdown_list(['cargo']);

        $this->loadview("usuarios/form", $dados);

    }

    public function salvar($id = 0)
    {

        $editting = $id ? true : false;
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('cargo', 'Cargo', 'required');

        if (!$editting || ($editting and !is_null($this->input->post('senha', TRUE)) and !empty($this->input->post('senha', TRUE)))) {
            $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]');
            $this->form_validation->set_rules('resenha', 'Repetir Senha', 'required|matches[senha]');
        }

        if ($editting) {
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[usuarios.email.id.' . $id . ']');
        } else {
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[usuarios.email]');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->form($id);
            exit;
        }

        $cargo = $this->input->post('cargo', TRUE);

        $data = [
            'nome' => $this->input->post('nome', TRUE),
            'email' => $this->input->post('email', TRUE),
            'senha' => password_hash($this->input->post('senha', TRUE), PASSWORD_DEFAULT),
            'cargo_id' => $cargo == "Admin" ? null : $cargo,
            'permissao' => $cargo == "Admin" ? "Admin" : "Equipe"

        ];

        $sucesso = $this->Usuarios->save($data, $id);

        if (!$sucesso) {
            $this->set_flashdata('Falha ao ' . ($editting ? "atualizar" : "cadastrar") . " o usuário", "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Sucesso', "O usuário foi " . ($editting ? "atualizado" : "cadastrado") . " com sucesso!", 'success');
        }

        redirect(base_url('admin/usuarios'));


    }

    public function deletar($id = null)
    {
        if (is_null($id)) {
            redirect(base_url('admin/usuarios'));
            exit;
        }

        if ($id == $this->session->id) {
            $this->set_flashdata('Falha ao deletar o usuário', "Não é possivel deletar o próprio usuário.", 'error');
            redirect(base_url('admin/usuarios'));
            exit;
        }


        $sucesso = $this->Usuarios->delete($id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar o usuário', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Usuário deletado', "O usuário foi deletado com sucesso!", 'success');
        }
        redirect(base_url('admin/usuarios'));

    }

    public function bulkdelete()
    {

        //Validação do Formulário
        $ids = $this->input->post('ids', TRUE);
     
        if (is_null($ids)) {
            redirect(base_url('admin/usuarios'));
            exit;
        }

     
        //Verifica se o usuário está tentando deletar a si mesmo
        if (in_array($this->session->id, $ids)) {
            $this->set_flashdata('Falha ao deletar o usuário', "Não é possivel deletar o próprio usuário.", 'error');
            redirect(base_url('admin/usuarios'));
            exit;
        }


        //Verifica se o usuário está tentando deletar um admin
        if ($this->Usuarios->is_any_admin($ids) > 0) {
            $this->set_flashdata('Falha ao deletar os usuários', "Não é possivel deletar um administrador.", 'error');
            redirect(base_url('admin/usuarios'));
            exit;
        }

        if (!$this->Usuarios->bulkdelete($ids)) {
            $this->set_flashdata('Falha ao deletar os usuários', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Usuários deletados', "Os usuários selecionados foram deletados com sucesso!", 'success');
        }

        redirect(base_url('admin/usuarios'));

    }

}
