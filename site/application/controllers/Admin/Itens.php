<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Itens_model $Itens
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Upload $upload
 * @property CI_Input $input
 */

class Itens extends AdminController
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Itens_model', 'Itens');
        if (!$this->has_permission("Gerenciar Itens")) {
            $this->forbidden();
        }
    }

    public function index()
    {

        $this->loadview("itens/index");

    }

    public function ajax_list()
    {

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];
        $where = array();
        if ($search) {
            $where['search'] = array(
                'nome' => $search,
                'descricao' => $search,
                'itemid' => $search
            );
        }


        $data = $this->Itens->get_all($length, $start, $where);
        //mostra o sql gerado
        $resultado = $data->result();

        if ($search) {
            $total = $this->Itens->get_all(99999999, 0, $where)->num_rows();

        } else {
            $total = $this->Itens->count_all();

        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Itens->count_all(),
            "recordsFiltered" => $total,
            "data" => $resultado
        );

        echo json_encode($output);

    }

    public function form($id = 0)
    {

        $dados['item'] = $this->Itens->get_one($id);
        $itemRelativePath = 'assets/site/img/personagem/icones/' . $dados['item']->itemid . '.png';

        $dados['item']->imagem = (
            file_exists(FCPATH . $itemRelativePath) ?
            base_url($itemRelativePath) :
            base_url('assets/site/img/personagem/icones/0.png'));
        $dados['editing'] = $id ? true : false;
        if ($id && $dados['item']->id != $id) {
            $this->set_flashdata('Falha ao editar o item', "O ID informado é inválido", 'error');
            redirect(base_url('admin/itens'));
        }

        $this->loadview("itens/form", $dados);


    }


    public function salvar($id = 0)
    {

        //Validação do formulário
        $this->form_validation->set_rules('itemid', 'Id', 'required');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->set_flashdata('Falha ao salvar o item', "Não foi possível processar a solicitação", 'error');
            redirect(base_url('admin/itens/form'));
            exit;
        }

        //preparação dos dados para salvar
        $dados = array(
            'itemid' => $this->input->post('itemid', TRUE),
            'nome' => $this->input->post('nome', TRUE),
            'cor' => $this->input->post('cor', TRUE),
            'descricao' => $this->input->post('descricao', TRUE),
            'pos' => $this->input->post('pos', TRUE),
            'count' => $this->input->post('count', TRUE),
            'max_count' => $this->input->post('max_count', TRUE),
            'data' => $this->input->post('data', TRUE),
            'proctype' => $this->input->post('proctype', TRUE),
            'expire_date' => $this->input->post('expire_date', TRUE),
            'guid1' => $this->input->post('guid1', TRUE),
            'guid2' => $this->input->post('guid2', TRUE),
            'mask' => $this->input->post('mask', TRUE),

        );

        if (!$id) {
            $dados['datacriacao'] = date('Y-m-d H:i:s');

        }

        if ($_FILES['imagem']['name']) {
            $config['upload_path'] = FCPATH . 'assets/site/img/personagem/icones/';

            $config['allowed_types'] = 'png';
            $config['max_size'] = 1024;
            $config['max_width'] = 32;
            $config['max_height'] = 32;
            $config['file_name'] = $dados['id'];
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('imagem')) {
                $this->set_flashdata('Falha ao salvar o item', $this->upload->display_errors(), 'error');
                redirect(base_url('admin/itens/form'));
                exit;
            }
        }

        $sucesso = $this->Itens->save($dados, $id);

        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar o item', "Não foi possível processar a solicitação", 'error');
            redirect(base_url('admin/itens/form'));
            exit;
        }
        $this->set_flashdata('Item salvo', "O item foi salvo com sucesso!", 'success');
        redirect(base_url('admin/itens'));


    }

    public function deletar($id = null)
    {
        if (is_null($id)) {
            redirect(base_url('admin/itens'));
        }

        $sucesso = $this->Itens->delete($id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao deletar o item', "Não foi possível processar a solicitação", 'error');
            redirect(base_url('admin/itens'));
            exit;
        } else {
            $this->set_flashdata('Item deletado', "O item foi deletado com sucesso!", 'success');
        }
        redirect(base_url('admin/itens'));

    }


    public function bulkdelete()
    {
        $ids = $this->input->post('ids', TRUE);
        if (is_null($ids)) {
            $this->set_flashdata('Falha ao deletar os itens', "Não foi possível processar a solicitação", 'error');
            redirect(base_url('admin/itens'));
        }

        if (!$this->Itens->bulkdelete($ids)) {
            $this->set_flashdata('Falha ao deletar os itens', "Não foi possível processar a solicitação", 'error');
        } else {
            $this->set_flashdata('Download deletado', "Os itens selecionados foram deletados com sucesso!", 'success');
        }

        redirect(base_url('admin/itens'));

    }

    public function importar()
    {
        $opcional = array();

        if ($_FILES['rae']['name']) {
            //upload do arquivo RAE
            $config['upload_path'] = FCPATH . 'assets/painel/rae/';
            $config['allowed_types'] = ['tab'];
            $config['max_size'] = 10240;
            $config['file_name'] = 'rae.tab';
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('rae')) {
                $this->set_flashdata('Falha ao importar os itens', $this->upload->display_errors(), 'error');
            } else {
                $opcional['update_rae_data'] = TRUE;
            }

        }
        if ($_FILES['icones']['name']) {
            //upload do arquivo de itens
            $config['upload_path'] = FCPATH . 'assets/painel/icones/';
            $config['allowed_types'] = ['zip'];
            $config['max_size'] = 1024000;
            $config['file_name'] = 'icones.zip';
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('icones')) {
                echo
                    $this->set_flashdata('Falha ao importar os icones', $this->upload->display_errors(), 'error');
            } else {
                $opcional['update_icones'] = TRUE;
            }
        }


        $this->set_flashdata('Arquivos importados', "Os arquivos estão sendo processados, este processo pode demorar até 5 minutos", 'success', $opcional);
        redirect(base_url('admin/itens'));
    }

    public function processar_rae()
    {
        $update_rae_data = $this->input->post('update_rae_data', TRUE);

        if (!$update_rae_data) {
            exit;
        }
        // Processar arquivo RAE
        $conteudo = file_get_contents(FCPATH . 'assets/painel/rae/rae.tab');
        $linhas = explode("\n", $conteudo);
        $itens = array();
        foreach ($linhas as $linha) {
            if (isset($linha[0]) && isset($linha[1]) && isset($linha[2])) {

                $dados = explode("\t", $linha);
                $itens[] = array(
                    'itemid' => $dados[0],
                    'cor' => $dados[1],
                    'nome' => $dados[2],
                    'descricao' => isset($dados[3]) ? $dados[3] : '',
                    'datacriacao' => date('Y-m-d H:i:s')
                );
            }
        }

        $sucesso = $this->Itens->importRaeData($itens);
        if (!$sucesso) {
            echo 'Falha ao importar os itens';
        } else {
            echo 'Itens importados com sucesso';
        }

    }

    public function processar_icones()
    {
        //remove max_execution_time
        set_time_limit(0);
        $update_icones = $this->input->post('update_icones', TRUE);

        if (!$update_icones) {
            exit;
        }

        $zipFilePath = FCPATH . 'assets/painel/icones/icones.zip';

        $extractPath = FCPATH . 'assets/site/img/personagem/icones/';
        // Processar arquivo de icones
        $zip = new ZipArchive;
        // Abre o arquivo ZIP
        if ($zip->open($zipFilePath) === TRUE) {
            // Contador para o número de imagens extraídas
            $extractedImages = 0;

            // Itera sobre todas as entradas no arquivo ZIP
            for ($i = 0; $i < $zip->numFiles; $i++) {
                // Obtém o nome do arquivo
                $filename = $zip->getNameIndex($i);

                $fileinfo = pathinfo($filename);
                // Verifica se o arquivo é uma imagem PNG
                if ($fileinfo['extension'] == 'png') {
                    copy("zip://$zipFilePath#$filename", $extractPath . $fileinfo['filename'] . '.png');
                    $extractedImages++;
                }
            }

            // Fecha o arquivo ZIP
            $zip->close();

            echo "Imagens extraídas com sucesso. Total de imagens extraídas: $extractedImages";
        } else {
            echo 'Falha ao abrir o arquivo ZIP';
        }
    }

}
