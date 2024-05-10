<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Usuarios
 *
 * @property Configuracoes_model $Configuracoes
 * @property Cargos_model $Cargos
 * @property CI_Session $session
 * @property MY_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Upload $upload
 * @property CI_Config $config
 */

class Configuracoes extends AdminController
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Configuracoes_model', 'Configuracoes');
        if (!$this->has_permission("Gerenciar Configurações")) {
            $this->forbidden();
        }
    }

    public function gerais()
    {
        $this->loadview('configuracoes/gerais');

    }

    public function salvar_gerais()
    {
        $this->form_validation->set_rules('nomeservidor', 'Nome do Servidor', 'required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('versaoservidor', 'Versão do Servidor', 'required');
        $this->form_validation->set_rules('linkpainel', 'Link do Painel', 'required|valid_url');
        if ($this->form_validation->run() == FALSE) {
            $this->set_flashdata('Falha ao salvar a configuração', strip_tags(trim(validation_errors())), 'error');
            redirect(base_url('admin/configuracoes/gerais'));
        }

        $dados = array(
            'nomeservidor' => $this->input->post('nomeservidor', TRUE),
            'versaoservidor' => $this->input->post('versaoservidor', TRUE),
            'linkpainel' => $this->input->post('linkpainel', TRUE),
        );


        if (isset($_FILES['logo']['name']) and $_FILES['logo']['name'] != '') {
            $config['upload_path'] = FCPATH . 'assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png|webp|jpeg|svg';
            $config['max_size'] = 10240;
            $config['max_width'] = 2048;
            $config['max_height'] = 1600;
            $config['overwrite'] = TRUE;
            $config['file_name'] = "logo";
            $this->upload->initialize($config);
            if (!$this->upload->do_upload("logo")) {
                $this->set_flashdata('Falha ao salvar a configuração', "Não foi possível salvar a logo. " . $this->upload->display_errors(), 'error');
                redirect(base_url('admin/configuracoes/gerais'));
            } else {
                $dados['vlogo'] = $this->config->item("vlogo") + 1;
                $dados['extlogo'] = pathinfo($_FILES['logo']['name'])['extension'];
            }
        } else {
            $dados['vlogo'] = $this->config->item("vlogo");
            $dados['extlogo'] = $this->config->item("extlogo");
        }



        if (isset($_FILES['favicon']['name']) and $_FILES['favicon']['name'] != '') {
            $config['upload_path'] = FCPATH . 'assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png|webp|jpeg|svg';
            $config['max_size'] = 10240;
            $config['max_width'] = 2048;
            $config['max_height'] = 1600;
            $config['overwrite'] = TRUE;
            $config['file_name'] = "favicon";
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload("favicon")) {
                $this->set_flashdata('Falha ao salvar a configuração', "Não foi possível salvar o favicon. " . $this->upload->display_errors(), 'error');
                redirect(base_url('admin/configuracoes/gerais'));
            } else {
                $dados['vfavicon'] = $this->config->item("vfavicon") + 1;
                $dados['extfavicon'] = pathinfo($_FILES['favicon']['name'])['extension'];
            }
        } else {
            $dados['vfavicon'] = $this->config->item("vfavicon");
            $dados['extfavicon'] = $this->config->item("extfavicon");
        }

        $id = $this->Configuracoes->get_one_where(array('chave' => 'gerais'))->id;

        $data['valor'] = json_encode($dados);
        $sucesso = $this->Configuracoes->save($data, $id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar a configuração', "Não foi possível salvar as configurações. ", 'error');
        } else {
            $this->set_flashdata('Configurações salvas', "As configurações foram salvas com sucesso!", 'success');
        }
        redirect(base_url('admin/configuracoes/gerais'));


    }

    public function integracoes()
    {
        $this->loadview('configuracoes/integracoes');

    }

    public function salvar_integracoes()
    {
        $dados['usarrecaptcha'] = ($this->input->post('usarrecaptcha', TRUE) == 'on' ? 1 : 0);
        $dados['recaptchasitekey'] = $this->input->post('recaptchasitekey', TRUE);
        $dados['recaptchasecretkey'] = $this->input->post('recaptchasecretkey', TRUE);
        $dados['usardisqus'] = ($this->input->post('usardisqus', TRUE) == 'on' ? 1 : 0);
        $dados['disqusshortname'] = $this->input->post('disqusshortname', TRUE);
        $dados['usarmailchimp'] = ($this->input->post('usarmailchimp', TRUE) == 'on' ? 1 : 0);
        $dados['mailchimpcode'] = $_POST['mailchimpcode'];
        $dados['usaranalytics'] = ($this->input->post('usaranalytics', TRUE) == 'on' ? 1 : 0);
        $dados['analyticsid'] = $this->input->post('analyticsid', TRUE);
        $dados['usarfacebook'] = ($this->input->post('usarfacebook', TRUE) == 'on' ? 1 : 0);
        $dados['linkpaginafacebook'] = $this->input->post('linkpaginafacebook', TRUE);

        $id = $this->Configuracoes->get_one_where(array('chave' => 'integracoes'))->id;
        $data['valor'] = json_encode($dados);
        $sucesso = $this->Configuracoes->save($data, $id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar a configuração', "Não foi possível salvar as configurações. ", 'error');
        } else {
            $this->set_flashdata('Configurações salvas', "As configurações foram salvas com sucesso!", 'success');
        }
        redirect(base_url('admin/configuracoes/integracoes'));

    }

    public function competitivo()
    {

        $this->loadview('configuracoes/competitivo');

    }

    public function salvar_competitivo()
    {

        $dados['usarpvp'] = ($this->input->post('usarpvp', TRUE) == 'on' ? 1 : 0);
        $dados['mostrarzeradosenegativospvp'] = ($this->input->post('mostrarzeradosenegativospvp', TRUE) == 'on' ? 1 : 0);
        $dados['pontosmatarpvp'] = $this->input->post('pontosmatarpvp', TRUE);
        $dados['pontosmorrer'] = $this->input->post('pontosmorrer', TRUE);
        $dados['usarpve'] = ($this->input->post('usarpve', TRUE) == 'on' ? 1 : 0);
        $dados['usartw'] = ($this->input->post('usartw', TRUE) == 'on' ? 1 : 0);
        $dados['guildlisttxtultipdate'] = $this->config->item('guildlisttxtultipdate');
        $dados['guildlistpngultipdate'] = $this->config->item('guildlistpngultipdate');
        $dados['usargvg'] = ($this->input->post('usargvg', TRUE) == 'on' ? 1 : 0);
        $dados['mostrarzeradosenegativosgvg'] = ($this->input->post('mostrarzeradosenegativosgvg', TRUE) == 'on' ? 1 : 0);
        $dados['usarlistaclans'] = ($this->input->post('usarlistaclans', TRUE) == 'on' ? 1 : 0);
        $dados['limiterankingpvp'] = $this->input->post('limiterankingpvp', TRUE);
        $dados['limiterankingpve'] = $this->input->post('limiterankingpve', TRUE);
        $dados['limiterankinggvg'] = $this->input->post('limiterankinggvg', TRUE);
        $dados['usarmensagempvp'] = ($this->input->post('usarmensagempvp', TRUE) == 'on' ? 1 : 0);
        $dados['canalmensagenspvp'] = $this->input->post('canalmensagenspvp', TRUE);
        $dados['usartrocaitenspvp'] = ($this->input->post('usartrocaitenspvp', TRUE) == 'on' ? 1 : 0);
        $dados['comandoconsultapontos'] = $this->input->post('comandoconsultapontos', TRUE);
        $dados['comandoconsultaitens'] = $this->input->post('comandoconsultaitens', TRUE);
        $dados['comandosacaritens'] = $this->input->post('comandosacaritens', TRUE);
        if (isset($_FILES['iconlisttxt']['name']) and $_FILES['iconlisttxt']['name'] != '') {
            $config['upload_path'] = FCPATH . 'assets/upload/guildicons/';
            $config['allowed_types'] = 'txt';
            $config['max_size'] = 10240;
            $config['overwrite'] = TRUE;
            $config['file_name'] = "iconlist_guild";
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload("iconlisttxt")) {
                $this->session->set_flashdata('titulo', "Falha ao salvar as configurações");
                $this->session->set_flashdata('msg', "Não foi possível salvar o arquivo txt. " . $this->upload->display_errors());
                $this->session->set_flashdata('tipo', 'error');
                redirect(base_url('admin/configscompetitivo'));
            } else {
                $dados['guildlisttxtultupdate'] = date("Y-m-d H:i:s");
            }
        }
        if (isset($_FILES['iconlistpng']['name']) and $_FILES['iconlistpng']['name'] != '') {
            $config['upload_path'] = FCPATH . 'assets/upload/guildicons/';
            $config['allowed_types'] = 'png';
            $config['max_size'] = 102400;
            $config['overwrite'] = TRUE;
            $config['file_name'] = "iconlist_guild";
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload("iconlistpng")) {
                $this->session->set_flashdata('titulo', "Falha ao salvar as configurações");
                $this->session->set_flashdata('msg', "Não foi possível salvar o arquivo png. " . $this->upload->display_errors());
                $this->session->set_flashdata('tipo', 'error');
                redirect(base_url('admin/configscompetitivo'));
            } else {
                $dados['guildlistpngultupdate'] = date("Y-m-d H:i:s");
            }
        }

        $id = $this->Configuracoes->get_one_where(array('chave' => 'competitivo'))->id;
        $data['valor'] = json_encode($dados);
        $sucesso = $this->Configuracoes->save($data, $id);
        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar a configuração', "Não foi possível salvar as configurações. ", 'error');
        } else {
            $this->set_flashdata('Configurações salvas', "As configurações foram salvas com sucesso!", 'success');
        }

        redirect(base_url('admin/configuracoes/competitivo'));

    }

    public function updatepve()
    {
        $dados['usarupdatepve'] = ($this->input->post('usarupdatepve', TRUE) == 'on' ? 1 : 0);

        $id = $this->Configuracoes->get_one_where(array('chave' => 'pve'))->id;

        $data['valor'] = json_encode($dados);

        $sucesso = $this->Configuracoes->save($data, $id);

        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar a configuração', "Não foi possível salvar as configurações. ", 'error');
        } else {
            $this->set_flashdata('Configurações salvas', "As configurações foram salvas com sucesso!", 'success');
        }

        redirect(base_url('admin/pve'));

    }

    public function updatetw()
    {
        $dados['usarupdatetw'] = ($this->input->post('usarupdatetw', TRUE) == 'on' ? 1 : 0);

        $id = $this->Configuracoes->get_one_where(array('chave' => 'tw'))->id;

        $data['valor'] = json_encode($dados);

        $sucesso = $this->Configuracoes->save($data, $id);

        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar a configuração', "Não foi possível salvar as configurações. ", 'error');
        } else {
            $this->set_flashdata('Configurações salvas', "As configurações foram salvas com sucesso!", 'success');
        }

        redirect(base_url('admin/tw'));

    }

    public function mensageiro()
    {
        $dados['usarmensageiro'] = ($this->input->post('usarmensageiro', TRUE) == 'on' ? 1 : 0);

        $id = $this->Configuracoes->get_one_where(array('chave' => 'mensageiro'))->id;

        $data['valor'] = json_encode($dados);

        $sucesso = $this->Configuracoes->save($data, $id);

        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar a configuração', "Não foi possível salvar as configurações. ", 'error');
        } else {
            $this->set_flashdata('Configurações salvas', "As configurações foram salvas com sucesso!", 'success');
        }

        redirect(base_url('admin/mensageiro'));

    }

    public function scriptgolds()
    {
        $dados['usarscriptgolds'] = ($this->input->post('usarscriptgolds', TRUE) == 'on' ? 1 : 0);

        $id = $this->Configuracoes->get_one_where(array('chave' => 'scriptgolds'))->id;

        $data['valor'] = json_encode($dados);

        $sucesso = $this->Configuracoes->save($data, $id);

        if (!$sucesso) {
            $this->set_flashdata('Falha ao salvar a configuração', "Não foi possível salvar as configurações. ", 'error');
        } else {
            $this->set_flashdata('Configurações salvas', "As configurações foram salvas com sucesso!", 'success');
        }

        redirect(base_url('admin/scriptgolds'));
    }

}
