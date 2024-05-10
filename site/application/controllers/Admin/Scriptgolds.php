<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Scriptgolds_model $Scriptgolds
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Upload $upload
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Config $config
 */

class Scriptgolds extends AdminController
{

    protected $placeholders = [
        'quantidade' => 'Quantidade de Golds',
        'levelminimo' => 'Level Mínimo',
        'cultivominimo' => 'Cultivo Mínimo',
    ];

    public function __construct()
    {
        parent::__construct();

        if (!$this->has_permission("Gerenciar Script Golds")) {

            $this->forbidden();
        }
        $this->load->model('Scriptgolds_model', 'Scriptgolds');
    }




    public function index()
    {
        $dados['golds'] = $this->Scriptgolds->get_all()->result();
        $this->loadview('scriptgolds/index', $dados);

    }

    public function form($id = 0)
    {
        $dados['script'] = $this->Scriptgolds->get_one($id);
        $dados['placeholders'] = $this->placeholders;

        if ($id && $dados['script']->id != $id) {
            $this->set_flashdata('Falha ao editar o update', "O ID informado é inválido", 'error');
            redirect(base_url('admin/scriptgolds'));
        }

        if ($id) {
            $periodicidade = explode(" ", $dados['script']->periodicidade);
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

        $this->loadview('scriptgolds/form', $dados);

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
        $this->form_validation->set_rules('levelminimo', 'Level Mínimo', 'required');
        $this->form_validation->set_rules('cultivominimo', 'Cultivo Mínimo', 'required');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'required');
        if ($this->form_validation->run() == FALSE) {
            //convert validation errors to one line string
            $erros = validation_errors();
            $erros = str_replace("\n", "", $erros);
            $erros = strip_tags($erros);

            $this->set_flashdata('Falha ao salvar o update', $erros, 'error');
            redirect(base_url('admin/scriptgolds/form/' . $id));

        }

        $dados['periodicidade'] = $this->input->post('minutos') . " " . $this->input->post('horas') . " " . $this->input->post('dias') . " " . $this->input->post('meses') . " " . $this->input->post('diassemana');
        $dados['mensagem'] = $this->input->post('mensagem');
        $dados['canal'] = $this->input->post('canal');
        $dados['levelminimo'] = $this->input->post('levelminimo');
        $dados['cultivominimo'] = $this->input->post('cultivominimo');
        $dados['quantidade'] = $this->input->post('quantidade');
        $dados['unicoip'] = ($this->input->post('unicoip', TRUE) == 'on' ? 1 : 0);
        $dados['estaronline'] = ($this->input->post('estaronline', TRUE) == 'on' ? 1 : 0);
        $dados['unicoconta'] = ($this->input->post('unicoconta', TRUE) == 'on' ? 1 : 0);
        $dados['usarrankingpve'] = ($this->input->post('usarrankingpve', TRUE) == 'on' ? 1 : 0);
        $dados['entregarviaapi'] = ($this->input->post('entregarviaapi', TRUE) == 'on' ? 1 : 0);

        $sucesso = $this->Scriptgolds->save($dados, $id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar o update', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Update salvo', "O update foi salva com sucesso!", 'success');
        }

        redirect(base_url('admin/scriptgolds'));

    }

    public function deletar($id = null)
    {
        if (!$id) {
            redirect(base_url('admin/pve'));
        }

        $sucesso = $this->Scriptgolds->delete($id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar o update', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Update deletado', "O update foi deletado com sucesso!", 'success');
        }
        redirect(base_url('admin/scriptgolds'));


    }

    public function bulkdelete()
    {
        $ids = $this->input->post('ids', TRUE);
        if (is_null($ids)) {
            redirect(base_url('admin/pve/atualizacao'));
        }

        $sucesso = $this->Scriptgolds->bulkdelete($ids);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar os updates', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Updates deletados', "Os updates foram deletados com sucesso!", 'success');
        }
        redirect(base_url('admin/scriptgolds'));

    }
}