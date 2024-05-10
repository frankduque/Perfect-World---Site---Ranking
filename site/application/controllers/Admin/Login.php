<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once (APPPATH . "controllers/Admin/AdminController.php");

/**
 * Description of Dashboard
 *
 * @property Usuarios_model $Usuarios
 * @property CI_Session $session
 * @property MY_Form_validation $form_validation
 * @property CI_Config $config
 * @property CI_Input $input
 * @property CI_Loader $load
 */

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Usuarios_model', 'Usuarios');

    }


    public function index()
    {
        $this->load->view('painel/admin/auth/header');
        $this->load->view('painel/admin/auth/login');
        $this->load->view('painel/admin/auth/footer');
    }

    public function logar()
    {


        //Validação do Formulário
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[8]|max_length[20]');
        if ($this->config->item("usarrecaptcha") == 1 and !is_null($this->config->item("recaptchasitekey"))) {
            $this->form_validation->set_rules('g-recaptcha-response', 'reCaptcha', 'callback_check_recaptcha');
        }
        if ($this->form_validation->run() == FALSE) {
            $this->index();
            exit;
        }


        //Trata o bloqueio de login
        if ($this->session->bloqueiologin != null) {
            $tempodebloqueio = (time() - $this->session->bloqueiologin) / 60;
            if ($tempodebloqueio >= $this->config->item('duracao_bloqueio_login')) {
                $this->session->bloqueiologin = null;
                $this->session->falhalogin = 0;
            } else {
                $this->set_flashdata('Falha ao realizar o login', 'Sessão bloqueada', 'Por questões de segurança essa sessão foi bloqueada, por favor tente novamente mais tarde.', 'error');
                redirect(base_url('admin/login'));

            }
        }


        //Verifica se o usuário existe
        $where = array(
            'email' => $this->input->post('email', TRUE)
        );
        $usuario = $this->Usuarios->get_details($where)->row();

        if (is_null($usuario)) {
            $this->errologin();
            $this->set_flashdata('Falha ao realizar o login', 'Usuário não encontrado', 'O usuário digitado não foi encontrado, por favor tente novamente.', 'error');
            redirect(base_url('admin/login'));
        }

        //Verifica se a senha está correta
        if (!password_verify($this->input->post('senha', TRUE), $usuario->senha)) {
            $this->errologin();
            $this->set_flashdata('Falha ao realizar o login', 'Usuário ou senha incorretos', 'O usuário ou senha digitatos estão incorretos, por favor tente novamente.', 'error');
            redirect(base_url('admin/login'));
        }


        //prosseguir com o login

        if ($usuario->permissao != 'Admin') {
            $arrperm = json_decode($usuario->permissoes);
        } else {
            $arrperm = $this->config->item("permissoes");
        }

        $session_data = array(
            'id' => $usuario->id,
            'nome' => $usuario->nome,
            'permissao' => $usuario->permissao,
            'permissoes' => $arrperm,
            "email" => $usuario->email
        );
       
        $this->session->set_userdata($session_data);
        $this->session->falhalogin = 0;
        if (isset($this->session->redirect) and !is_null($this->session->redirect)) {
            $redirecionar = $this->session->redirect;
            $this->session->unset_userdata('redirect');
            redirect($redirecionar);
        } else {
            redirect(base_url('admin/dashboard'));
        }

    }

    public function errologin()
    {
        $this->session->falhalogin += 1;
        if ($this->session->falhalogin >= $this->config->item('tentativaslogin')) {
            $this->session->bloqueiologin = time();
        }
    }

    public function set_flashdata($header, $titulo, $msg, $tipo)
    {
        $this->session->set_flashdata('header', $header);
        $this->session->set_flashdata('titulo', $titulo);
        $this->session->set_flashdata('msg', $msg);
        $this->session->set_flashdata('tipo', $tipo);
    }
}
