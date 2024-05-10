<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Dashboard
 *
 * @property Usuarios_model $Usuarios
 * @property Cargos_model $Cargos
 * @property CI_Session $session
 * @property MY_Form_validation $form_validation
 * @property CI_Config $config
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Upload $upload
 * @property Downloads_model $Downloads_model
 * @property Noticias_model $Noticias_model
 * @property Categorias_model $Categorias_model
 * @property Tutorial_model $Tutorial_model
 * @property Patchers_model $Patchers_model
 * @property Eventos_model $Eventos_model
 * 
 */

class Admin extends CI_Controller {

    
    
    

    /*
     * 
     * 
     * 
     *      TW
     * 
     * 
     * 
     */

    public function tw() {
        if (in_array("tw/gerenciar", $this->session->permissoes)) {
            $this->load->model("Competitivo_model");
            $dados['updates'] = $this->Competitivo_model->get_updatestw();
            $this->loadview('tw/tw', $dados);
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function adicionarupdatetw() {
        if (in_array("tw/gerenciar", $this->session->permissoes)) {
            $this->loadview('tw/adicionarupdatetw');
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function salvarupdatetw() {
        if (in_array("tw/gerenciar", $this->session->permissoes)) {
            $this->form_validation->set_rules('minutos', 'Minutos', 'required|callback_minutos_check');
            $this->form_validation->set_rules('horas', 'Horas', 'required|callback_horas_check');
            $this->form_validation->set_rules('dias', 'Dias', 'required|callback_dias_check');
            $this->form_validation->set_rules('meses', 'Meses', 'required|callback_meses_check');
            $this->form_validation->set_rules('diassemana', 'Dias da semana', 'required|callback_diassemana_check');
            if ($this->form_validation->run() == FALSE) {
                $this->adicionarupdatetw();
            } else {
                $this->load->model('Competitivo_model');
                $sucesso = $this->Competitivo_model->salvarupdatetw();
                if (!$sucesso) {
                    $this->session->set_flashdata('titulo', "Falha ao salvar o update");
                    $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/tw'));
                } else {
                    $this->session->set_flashdata('titulo', "Update salvo");
                    $this->session->set_flashdata('msg', "O update foi salva com sucesso!");
                    $this->session->set_flashdata('tipo', 'success');
                    redirect(base_url('admin/tw'));
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function editarsupdatetw($id = null) {
        if (in_array("tw/gerenciar", $this->session->permissoes)) {
            if (is_null($id)) {
                $this->session->set_flashdata('titulo', "Falha ao editar o update");
                $this->session->set_flashdata('msg', "O ID informado é inválido");
                $this->session->set_flashdata('tipo', 'error');
                redirect(base_url('admin/tw'));
            } else {
                $this->load->model('Competitivo_model');
                $dados['update'] = $this->Competitivo_model->get_updatetw($id);
                if (is_null($dados['update'])) {
                    $this->session->set_flashdata('titulo', "Falha ao editar o update");
                    $this->session->set_flashdata('msg', "O ID informado é inválido");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/tw'));
                } else {
                    $pieces = explode(" ", $dados['update']->periodicidade);
                    $dados['minutos'] = $pieces[0];
                    $dados['horas'] = $pieces[1];
                    $dados['dias'] = $pieces[2];
                    $dados['meses'] = $pieces[3];
                    $dados['diassemana'] = $pieces[4];
                    $dados['periodicidade'] = $dados['update']->periodicidade;
                    $this->loadview("tw/editarupdatetw", $dados);
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function atualizarupdatetw($id = null) {
        if (in_array("tw/gerenciar", $this->session->permissoes)) {
            if (is_null($id)) {
                $this->session->set_flashdata('titulo', "Falha ao editar o update");
                $this->session->set_flashdata('msg', "O ID informado é inválido");
                $this->session->set_flashdata('tipo', 'error');
                redirect(base_url('admin/tw'));
            } else {
                $this->form_validation->set_rules('minutos', 'Minutos', 'required|callback_minutos_check');
                $this->form_validation->set_rules('horas', 'Horas', 'required|callback_horas_check');
                $this->form_validation->set_rules('dias', 'Dias', 'required|callback_dias_check');
                $this->form_validation->set_rules('meses', 'Meses', 'required|callback_meses_check');
                $this->form_validation->set_rules('diassemana', 'Dias da semana', 'required|callback_diassemana_check');
                if ($this->form_validation->run() == FALSE) {
                    $this->editarsupdatetw($id);
                } else {
                    $this->load->model('Competitivo_model');
                    $sucesso = $this->Competitivo_model->salvarupdatetw($id);
                    if (!$sucesso) {
                        $this->session->set_flashdata('titulo', "Falha ao editar o update");
                        $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                        $this->session->set_flashdata('tipo', 'error');
                        redirect(base_url('admin/editarsupdatetw/' . $id));
                    } else {
                        $this->session->set_flashdata('titulo', "update atualizado");
                        $this->session->set_flashdata('msg', "O update foi atualizado com sucesso!");
                        $this->session->set_flashdata('tipo', 'success');
                        redirect(base_url('admin/tw'));
                    }
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function deletarupdatetw($id = null) {
        if (in_array("tw/gerenciar", $this->session->permissoes)) {
            if (is_null($id)) {
                redirect(base_url('admin/tw'));
            } else {
                $this->load->model('competitivo_model');
                $sucesso = $this->competitivo_model->deletar_updatetw($id);
                if (!$sucesso) {
                    $this->session->set_flashdata('titulo', "Falha ao deletar o update");
                    $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/tw'));
                } else {
                    $this->session->set_flashdata('titulo', "Update deletado");
                    $this->session->set_flashdata('msg', "O update foi deletado com sucesso!");
                    $this->session->set_flashdata('tipo', 'success');
                    redirect(base_url('admin/tw'));
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function bulkdeleteupdatetw() {
        if (in_array("tw/gerenciar", $this->session->permissoes)) {
            $ids = $this->input->post('ids', TRUE);
            if (is_null($ids)) {
                redirect(base_url('admin/tw'));
            } else {
                $this->load->model('competitivo_model');
                $sucesso = $this->competitivo_model->bulk_delete_updatetw($ids);
                if (!$sucesso) {
                    $this->session->set_flashdata('titulo', "Falha ao deletar os updates");
                    $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/tw'));
                } else {
                    $this->session->set_flashdata('titulo', "Updates deletadas");
                    $this->session->set_flashdata('msg', "Os updates selecionados foram deletados com sucesso!");
                    $this->session->set_flashdata('tipo', 'success');
                    redirect(base_url('admin/tw'));
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    /*
     * 
     * 
     *      RANKING PVE 
     * 
     * 
     */

    public function pve() {
        if (in_array("rankingpve/gerenciar", $this->session->permissoes)) {
            $this->load->model("Competitivo_model");
            $dados['updates'] = $this->Competitivo_model->get_updatespve();
            $this->loadview('pve/pve', $dados);
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function adicionarupdatepve() {
        if (in_array("rankingpve/gerenciar", $this->session->permissoes)) {
            $this->loadview('pve/adicionarupdatepve');
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function salvarupdatepve() {
        if (in_array("rankingpve/gerenciar", $this->session->permissoes)) {
            $this->form_validation->set_rules('minutos', 'Minutos', 'required|callback_minutos_check');
            $this->form_validation->set_rules('horas', 'Horas', 'required|callback_horas_check');
            $this->form_validation->set_rules('dias', 'Dias', 'required|callback_dias_check');
            $this->form_validation->set_rules('meses', 'Meses', 'required|callback_meses_check');
            $this->form_validation->set_rules('diassemana', 'Dias da semana', 'required|callback_diassemana_check');
            if ($this->form_validation->run() == FALSE) {
                $this->adicionarupdatepve();
            } else {
                $this->load->model('Competitivo_model');
                $sucesso = $this->Competitivo_model->salvarupdatepve();
                if (!$sucesso) {
                    $this->session->set_flashdata('titulo', "Falha ao salvar o update");
                    $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/pve'));
                } else {
                    $this->session->set_flashdata('titulo', "Update salvo");
                    $this->session->set_flashdata('msg', "O update foi salva com sucesso!");
                    $this->session->set_flashdata('tipo', 'success');
                    redirect(base_url('admin/pve'));
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function editarupdatepve($id = null) {
        if (in_array("rankingpve/gerenciar", $this->session->permissoes)) {
            if (is_null($id)) {
                $this->session->set_flashdata('titulo', "Falha ao editar o update");
                $this->session->set_flashdata('msg', "O ID informado é inválido");
                $this->session->set_flashdata('tipo', 'error');
                redirect(base_url('admin/pve'));
            } else {
                $this->load->model('Competitivo_model');
                $dados['update'] = $this->Competitivo_model->get_updatepve($id);
                if (is_null($dados['update'])) {
                    $this->session->set_flashdata('titulo', "Falha ao editar o update");
                    $this->session->set_flashdata('msg', "O ID informado é inválido");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/pve'));
                } else {
                    $pieces = explode(" ", $dados['update']->periodicidade);
                    $dados['minutos'] = $pieces[0];
                    $dados['horas'] = $pieces[1];
                    $dados['dias'] = $pieces[2];
                    $dados['meses'] = $pieces[3];
                    $dados['diassemana'] = $pieces[4];
                    $dados['periodicidade'] = $dados['update']->periodicidade;
                    $this->loadview("pve/editarupdatepve", $dados);
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function atualizarupdatepve($id = null) {
        if (in_array("rankingpve/gerenciar", $this->session->permissoes)) {
            if (is_null($id)) {
                $this->session->set_flashdata('titulo', "Falha ao editar o update");
                $this->session->set_flashdata('msg', "O ID informado é inválido");
                $this->session->set_flashdata('tipo', 'error');
                redirect(base_url('admin/pve'));
            } else {
                $this->form_validation->set_rules('minutos', 'Minutos', 'required|callback_minutos_check');
                $this->form_validation->set_rules('horas', 'Horas', 'required|callback_horas_check');
                $this->form_validation->set_rules('dias', 'Dias', 'required|callback_dias_check');
                $this->form_validation->set_rules('meses', 'Meses', 'required|callback_meses_check');
                $this->form_validation->set_rules('diassemana', 'Dias da semana', 'required|callback_diassemana_check');
                if ($this->form_validation->run() == FALSE) {
                    $this->editarupdatepve($id);
                } else {
                    $this->load->model('Competitivo_model');
                    $sucesso = $this->Competitivo_model->salvarupdatepve($id);
                    if (!$sucesso) {
                        $this->session->set_flashdata('titulo', "Falha ao editar o update");
                        $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                        $this->session->set_flashdata('tipo', 'error');
                        redirect(base_url('admin/editarupdatepve/' . $id));
                    } else {
                        $this->session->set_flashdata('titulo', "Update atualizado");
                        $this->session->set_flashdata('msg', "O update foi atualizado com sucesso!");
                        $this->session->set_flashdata('tipo', 'success');
                        redirect(base_url('admin/pve'));
                    }
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function deletarupdatepve($id = null) {
        if (in_array("rankingpve/gerenciar", $this->session->permissoes)) {
            if (is_null($id)) {
                redirect(base_url('admin/pve'));
            } else {
                $this->load->model('competitivo_model');
                $sucesso = $this->competitivo_model->deletar_updatepve($id);
                if (!$sucesso) {
                    $this->session->set_flashdata('titulo', "Falha ao deletar o update");
                    $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/pve'));
                } else {
                    $this->session->set_flashdata('titulo', "Update deletado");
                    $this->session->set_flashdata('msg', "O update foi deletado com sucesso!");
                    $this->session->set_flashdata('tipo', 'success');
                    redirect(base_url('admin/pve'));
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function bulkdeleteupdatepve() {
        if (in_array("rankingpve/gerenciar", $this->session->permissoes)) {
            $ids = $this->input->post('ids', TRUE);
            if (is_null($ids)) {
                redirect(base_url('admin/pve'));
            } else {
                $this->load->model('competitivo_model');
                $sucesso = $this->competitivo_model->bulk_delete_updatepve($ids);
                if (!$sucesso) {
                    $this->session->set_flashdata('titulo', "Falha ao deletar os updates");
                    $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/pve'));
                } else {
                    $this->session->set_flashdata('titulo', "Updates deletadas");
                    $this->session->set_flashdata('msg', "Os updates selecionados foram deletados com sucesso!");
                    $this->session->set_flashdata('tipo', 'success');
                    redirect(base_url('admin/pve'));
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    /*
     * 
     * 
     * 
     *      MENSAGEIRO
     * 
     * 
     * 
     */

    public function mensageiro() {
        if (in_array("mensageiro/gerenciar", $this->session->permissoes)) {
            $this->load->model("Mensageiro_model");
            $dados['mensagens'] = $this->Mensageiro_model->get_mensagens();
            $this->loadview('mensageiro/mensagens', $dados);
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function adicionarmensageiro() {
        if (in_array("mensageiro/gerenciar", $this->session->permissoes)) {
            $this->loadview('mensageiro/adicionarmensagem');
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function minutos_check($str) {
        if (preg_match("/^(\*|[1-5]?[0-9](-[1-5]?[0-9])?)(\/[1-9][0-9]*)?(,(\*|[1-5]?[0-9](-[1-5]?[0-9])?)(\/[1-9][0-9]*)?)*$/", $str)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('minutos_check', 'O campo %s não é valido!');
            return FALSE;
        }
    }

    public function horas_check($str) {
        if (preg_match("/^(\*|(1?[0-9]|2[0-3])(-(1?[0-9]|2[0-3]))?)(\/[1-9][0-9]*)?(,(\*|(1?[0-9]|2[0-3])(-(1?[0-9]|2[0-3]))?)(\/[1-9][0-9]*)?)*$/", $str)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('horas_check', 'O campo %s não é valido!');
            return FALSE;
        }
    }

    public function dias_check($str) {
        if (preg_match("/^(\*|([1-9]|[1-2][0-9]?|3[0-1])(-([1-9]|[1-2][0-9]?|3[0-1]))?)(\/[1-9][0-9]*)?(,(\*|([1-9]|[1-2][0-9]?|3[0-1])(-([1-9]|[1-2][0-9]?|3[0-1]))?)(\/[1-9][0-9]*)?)*$/", $str)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('dias_check', 'O campo %s não é valido!');
            return FALSE;
        }
    }

    public function meses_check($str) {
        if (preg_match("/^(\*|([1-9]|1[0-2]?)(-([1-9]|1[0-2]?))?)(\/[1-9][0-9]*)?(,(\*|([1-9]|1[0-2]?)(-([1-9]|1[0-2]?))?)(\/[1-9][0-9]*)?)*$/", $str)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('meses_check', 'O campo %s não é valido!');
            return FALSE;
        }
    }

    public function diassemana_check($str) {
        if (preg_match("/^(\*|[0-6](-[0-6])?)(\/[1-9][0-9]*)?(,(\*|[0-6](-[0-6])?)(\/[1-9][0-9]*)?)*$/", $str)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('diassemana_check', 'O campo %s não é valido!');
            return FALSE;
        }
    }

    public function salvarmensageiro() {
        if (in_array("mensageiro/gerenciar", $this->session->permissoes)) {
            $this->form_validation->set_rules('texto', 'Texto', 'required|max_length[120]');
            $this->form_validation->set_rules('canalmensagem', 'Canal de envio', 'required|greater_than_equal_to[0]|less_than_equal_to[15]');
            $this->form_validation->set_rules('minutos', 'Minutos', 'required|callback_minutos_check');
            $this->form_validation->set_rules('horas', 'Horas', 'required|callback_horas_check');
            $this->form_validation->set_rules('dias', 'Dias', 'required|callback_dias_check');
            $this->form_validation->set_rules('meses', 'Meses', 'required|callback_meses_check');
            $this->form_validation->set_rules('diassemana', 'Dias da semana', 'required|callback_diassemana_check');
            if ($this->form_validation->run() == FALSE) {
                $this->adicionarmensageiro();
            } else {
                $this->load->model('Mensageiro_model');
                $sucesso = $this->Mensageiro_model->salvarmensagem();
                if (!$sucesso) {
                    $this->session->set_flashdata('titulo', "Falha ao salvar a mensagem");
                    $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/mensageiro'));
                } else {
                    $this->session->set_flashdata('titulo', "Mensagem salva ");
                    $this->session->set_flashdata('msg', "A mensagem foi salva com sucesso!");
                    $this->session->set_flashdata('tipo', 'success');
                    redirect(base_url('admin/mensageiro'));
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function editarsmensageiro($id = null) {
        if (in_array("mensageiro/gerenciar", $this->session->permissoes)) {
            if (is_null($id)) {
                $this->session->set_flashdata('titulo', "Falha ao editar a mensagem");
                $this->session->set_flashdata('msg', "O ID informado é inválido");
                $this->session->set_flashdata('tipo', 'error');
                redirect(base_url('admin/mensageiro'));
            } else {
                $this->load->model('Mensageiro_model');
                $dados['mensagem'] = $this->Mensageiro_model->get_mensagem($id);
                if (is_null($dados['mensagem'])) {
                    $this->session->set_flashdata('titulo', "Falha ao editar a mensagem");
                    $this->session->set_flashdata('msg', "O ID informado é inválido");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/mensageiro'));
                } else {
                    $pieces = explode(" ", $dados['mensagem']->periodicidade);
                    $dados['minutos'] = $pieces[0];
                    $dados['horas'] = $pieces[1];
                    $dados['dias'] = $pieces[2];
                    $dados['meses'] = $pieces[3];
                    $dados['diassemana'] = $pieces[4];
                    $dados['periodicidade'] = $dados['mensagem']->periodicidade;
                    $this->loadview("mensageiro/editarmensagem", $dados);
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function atualizarmensageiro($id = null) {
        if (in_array("mensageiro/gerenciar", $this->session->permissoes)) {
            if (is_null($id)) {
                $this->session->set_flashdata('titulo', "Falha ao editar a mensagem");
                $this->session->set_flashdata('msg', "O ID informado é inválido");
                $this->session->set_flashdata('tipo', 'error');
                redirect(base_url('admin/mensageiro'));
            } else {
                $this->form_validation->set_rules('texto', 'Texto', 'required|max_length[120]');
                $this->form_validation->set_rules('canalmensagem', 'Canal de envio', 'required|greater_than_equal_to[0]|less_than_equal_to[15]');
                $this->form_validation->set_rules('minutos', 'Minutos', 'required|callback_minutos_check');
                $this->form_validation->set_rules('horas', 'Horas', 'required|callback_horas_check');
                $this->form_validation->set_rules('dias', 'Dias', 'required|callback_dias_check');
                $this->form_validation->set_rules('meses', 'Meses', 'required|callback_meses_check');
                $this->form_validation->set_rules('diassemana', 'Dias da semana', 'required|callback_diassemana_check');
                if ($this->form_validation->run() == FALSE) {
                    $this->editarsmensageiro($id);
                } else {
                    $this->load->model('Mensageiro_model');
                    $sucesso = $this->Mensageiro_model->salvarmensagem($id);
                    if (!$sucesso) {
                        $this->session->set_flashdata('titulo', "Falha ao editar a mensagem");
                        $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                        $this->session->set_flashdata('tipo', 'error');
                        redirect(base_url('admin/editarsmensageiro/' . $id));
                    } else {
                        $this->session->set_flashdata('titulo', "Mensagem atualizada");
                        $this->session->set_flashdata('msg', "A mensagem foi atualizada com sucesso!");
                        $this->session->set_flashdata('tipo', 'success');
                        redirect(base_url('admin/mensageiro'));
                    }
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function deletarmensageiro($id = null) {
        if (in_array("mensageiro/gerenciar", $this->session->permissoes)) {
            if (is_null($id)) {
                redirect(base_url('admin/mensageiro'));
            } else {
                $this->load->model('Mensageiro_model');
                $sucesso = $this->Mensageiro_model->deletar_mensagem($id);
                if (!$sucesso) {
                    $this->session->set_flashdata('titulo', "Falha ao deletar a mensagem");
                    $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/mensageiro'));
                } else {
                    $this->session->set_flashdata('titulo', "Mensagem deletada");
                    $this->session->set_flashdata('msg', "A mensagem foi deletada com sucesso!");
                    $this->session->set_flashdata('tipo', 'success');
                    redirect(base_url('admin/mensageiro'));
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function bulkdeletemensageiro() {
        if (in_array("mensageiro/gerenciar", $this->session->permissoes)) {
            $ids = $this->input->post('ids', TRUE);
            if (is_null($ids)) {
                redirect(base_url('admin/mensageiro'));
            } else {
                $this->load->model('Mensageiro_model');
                $sucesso = $this->Mensageiro_model->bulk_delete_mensagens($ids);
                if (!$sucesso) {
                    $this->session->set_flashdata('titulo', "Falha ao deletar as mensagens");
                    $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/mensageiro'));
                } else {
                    $this->session->set_flashdata('titulo', "Mensagens deletadas");
                    $this->session->set_flashdata('msg', "As mensagens selecionadas foram deletados com sucesso!");
                    $this->session->set_flashdata('tipo', 'success');
                    redirect(base_url('admin/mensageiro'));
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    /*
     * 
     * 
     * 
     *      Script Golds
     * 
     * 
     * 
     */

    public function scriptgolds() {
        if (in_array("scriptgolds/gerenciar", $this->session->permissoes)) {
            $this->load->model("Competitivo_model");
            $dados['golds'] = $this->Competitivo_model->get_scriptgolds();
            $this->loadview('scriptgolds/golds', $dados);
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function adicionarscriptgolds() {
        if (in_array("scriptgolds/gerenciar", $this->session->permissoes)) {
            $this->loadview('scriptgolds/incluirscriptgold');
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function salvarscriptgolds() {
        if (in_array("scriptgolds/gerenciar", $this->session->permissoes)) {
            $this->form_validation->set_rules('levelminimo', 'Level mínimo', 'required');
            $this->form_validation->set_rules('quantidade', 'Quantidade', 'required|greater_than_equal_to[1]');
            $this->form_validation->set_rules('minutos', 'Minutos', 'required|callback_minutos_check');
            $this->form_validation->set_rules('horas', 'Horas', 'required|callback_horas_check');
            $this->form_validation->set_rules('dias', 'Dias', 'required|callback_dias_check');
            $this->form_validation->set_rules('meses', 'Meses', 'required|callback_meses_check');
            $this->form_validation->set_rules('diassemana', 'Dias da semana', 'required|callback_diassemana_check');
            if ($this->form_validation->run() == FALSE) {
                $this->adicionarscriptgolds();
            } else {
                $this->load->model('Competitivo_model');
                $sucesso = $this->Competitivo_model->salvarscriptgold();
                if (!$sucesso) {
                    $this->session->set_flashdata('titulo', "Falha ao salvar o script");
                    $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/scriptgolds'));
                } else {
                    $this->session->set_flashdata('titulo', "Script salvo");
                    $this->session->set_flashdata('msg', "O script foi salvo com sucesso!");
                    $this->session->set_flashdata('tipo', 'success');
                    redirect(base_url('admin/scriptgolds'));
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function editarscriptgold($id = null) {
        if (in_array("scriptgolds/gerenciar", $this->session->permissoes)) {
            if (is_null($id)) {
                $this->session->set_flashdata('titulo', "Falha ao editar o script");
                $this->session->set_flashdata('msg', "O ID informado é inválido");
                $this->session->set_flashdata('tipo', 'error');
                redirect(base_url('admin/scriptgolds'));
            } else {
                $this->load->model('Competitivo_model');
                $dados['script'] = $this->Competitivo_model->get_scriptgold($id);
                if (is_null($dados['script'])) {
                    $this->session->set_flashdata('titulo', "Falha ao editar o script");
                    $this->session->set_flashdata('msg', "O ID informado é inválido");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/scriptgolds'));
                } else {
                    $pieces = explode(" ", $dados['script']->periodicidade);
                    $dados['minutos'] = $pieces[0];
                    $dados['horas'] = $pieces[1];
                    $dados['dias'] = $pieces[2];
                    $dados['meses'] = $pieces[3];
                    $dados['diassemana'] = $pieces[4];
                    $dados['periodicidade'] = $dados['script']->periodicidade;
                    $this->loadview("scriptgolds/editarscriptgold", $dados);
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function atualizarscriptgold($id = null) {
        if (in_array("scriptgolds/gerenciar", $this->session->permissoes)) {
            if (is_null($id)) {
                $this->session->set_flashdata('titulo', "Falha ao editar o script");
                $this->session->set_flashdata('msg', "O ID informado é inválido");
                $this->session->set_flashdata('tipo', 'error');
                redirect(base_url('admin/scriptgolds'));
            } else {
                $this->form_validation->set_rules('levelminimo', 'Level mínimo', 'required');
                $this->form_validation->set_rules('quantidade', 'Quantidade', 'required|greater_than_equal_to[1]');
                $this->form_validation->set_rules('minutos', 'Minutos', 'required|callback_minutos_check');
                $this->form_validation->set_rules('horas', 'Horas', 'required|callback_horas_check');
                $this->form_validation->set_rules('dias', 'Dias', 'required|callback_dias_check');
                $this->form_validation->set_rules('meses', 'Meses', 'required|callback_meses_check');
                $this->form_validation->set_rules('diassemana', 'Dias da semana', 'required|callback_diassemana_check');
                if ($this->form_validation->run() == FALSE) {
                    $this->editarscriptgold($id);
                } else {
                    $this->load->model('Competitivo_model');
                    $sucesso = $this->Competitivo_model->salvarscriptgold($id);
                    if (!$sucesso) {
                        $this->session->set_flashdata('titulo', "Falha ao editar o script");
                        $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                        $this->session->set_flashdata('tipo', 'error');
                        redirect(base_url('admin/editarscriptgold/' . $id));
                    } else {
                        $this->session->set_flashdata('titulo', "Script atualizado");
                        $this->session->set_flashdata('msg', "O script foi atualizado com sucesso!");
                        $this->session->set_flashdata('tipo', 'success');
                        redirect(base_url('admin/scriptgolds'));
                    }
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function deletarscriptgolds($id = null) {
        if (in_array("scriptgolds/gerenciar", $this->session->permissoes)) {
            if (is_null($id)) {
                redirect(base_url('admin/scriptgolds'));
            } else {
                $this->load->model('Competitivo_model');
                $sucesso = $this->Competitivo_model->deletarScriptGold($id);
                if (!$sucesso) {
                    $this->session->set_flashdata('titulo', "Falha ao deletar o script");
                    $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/scriptgolds'));
                } else {
                    $this->session->set_flashdata('titulo', "Script deletado");
                    $this->session->set_flashdata('msg', "O script foi deletado com sucesso!");
                    $this->session->set_flashdata('tipo', 'success');
                    redirect(base_url('admin/scriptgolds'));
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    public function bulkdeletescriptgolds() {
        if (in_array("scriptgolds/gerenciar", $this->session->permissoes)) {
            $ids = $this->input->post('ids', TRUE);
            if (is_null($ids)) {
                redirect(base_url('admin/scriptgolds'));
            } else {
                $this->load->model('Competitivo_model');
                $sucesso = $this->Competitivo_model->bulkDeleteScriptGolds($ids);
                if (!$sucesso) {
                    $this->session->set_flashdata('titulo', "Falha ao deletar os scripts");
                    $this->session->set_flashdata('msg', "Não foi possível processar a solicitação");
                    $this->session->set_flashdata('tipo', 'error');
                    redirect(base_url('admin/scriptgolds'));
                } else {
                    $this->session->set_flashdata('titulo', "Scripts deletados");
                    $this->session->set_flashdata('msg', "Os scripts selecionados foram deletados com sucesso!");
                    $this->session->set_flashdata('tipo', 'success');
                    redirect(base_url('admin/scriptgolds'));
                }
            }
        } else {
            $this->session->set_flashdata('titulo', "Acesso negado");
            $this->session->set_flashdata('msg', "Você não tem permissão para acessar a página solicitada. Entre em contato com o administrador.");
            $this->session->set_flashdata('tipo', 'error');
            redirect(base_url('admin/dashboard'));
        }
    }

    
    
}
