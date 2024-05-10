<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use GO\Scheduler;

class Chat extends CI_Controller {

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   * 		http://example.com/index.php/welcome
   * 	- or -
   * 		http://example.com/index.php/welcome/index
   * 	- or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see https://codeigniter.com/user_guide/general/urls.html
   */
  public function __construct() {
    parent::__construct();
    $this->load->model("Competitivo_model");
    $this->load->model("Competitivopw_model");
    $this->load->model("Configuracoes_model");
    $this->load->model("Mensageiro_model");
    $this->load->model("Gamed_model");
  }

  public function chat_controll($charid, $canal, $texto_base64) {
    $mensagem = str_replace("\0", "", base64_decode(str_replace('"', "", $texto_base64)));

    if ($this->input->is_cli_request()) {
      if ($this->config->item("usartrocaitenspvp")) {
        if ($mensagem == $this->config->item("comandoconsultapontos")) {
          $this->consultapontospvp($charid, $canal);
        }

        if ($this->config->item("comandoconsultaitens") == substr($mensagem, 0, strlen($this->config->item("comandoconsultaitens")))) {
          $offset = substr($mensagem, strlen($this->config->item("comandoconsultaitens")));
          $this->consultaitens($charid, $canal, $offset);
        }

        if ($this->config->item("comandosacaritens") == substr($mensagem, 0, strlen($this->config->item("comandosacaritens")))) {
          $itemindex = substr($mensagem, strlen($this->config->item("comandosacaritens")));
          $this->sacaritens($charid, $canal, $itemindex);
        }
      }
    } else {
      $this->output->set_status_header(403);
    }
  }

  public function consultapontospvp($charid, $canal) {
    $dadospvp = $this->Competitivo_model->getDadosPVP($charid);
    $mensagem = "Relatório de pontos:\r\n\r\n";
    $mensagem .= "Kills: " . $dadospvp->kills . "\r\n";
    $mensagem .= "Deaths: " . $dadospvp->deaths . "\r\n";
    $mensagem .= "Pontuação Geral: " . $dadospvp->pontos . "\r\n";
    $mensagem .= "Pontuação Utilizada: " . (is_null($dadospvp->saques) ? "0" : $dadospvp->saques) . "\r\n";
    $mensagem .= "Pontuação Disponível: " . (($dadospvp->pontos - $dadospvp->saques) < 0 ? "0" : ($dadospvp->pontos - $dadospvp->saques)) . "\r\n";
    $mensagem .= "\r\nUse o comando " . $this->config->item("comandoconsultaitens") . " para consultar os itens disponíveis\r\n";

    $this->Gamed_model->chat2player($charid, $mensagem);
  }

  public function consultaitens($charid, $canal, $offset = 0) {
    $dadospvp = $this->Competitivo_model->getDadosPVP($charid);

    if ($offset <= 0 or!is_numeric($offset)) {
      $offset = 0;
    }

    $totalitens = $this->Competitivo_model->getNumeroItensPVP();
    $itens = $this->Competitivo_model->getItensPVPOffSet($offset);
    if (empty($itens)) {
      $this->Gamed_model->chat2player($charid, "Nenhum item disponível para troca");
    } else {
      $i = ($offset * 5) + 1;
      $mensagem = "Itens Disponíveis:\r\n\r\n";
      foreach ($itens as $item) {

        $mensagem .= "[$i] $item->nome  -  $item->pontossaque pontos\r\n";
        $i++;
      }
      $mensagem .= '';
      if ($totalitens > ($offset + 1) * 5) {
        $mensagem .= "\r\nUse o comando " . $this->config->item("comandoconsultaitens") . ($offset + 1) . " para ver mais itens\r\n";
      }
      $mensagem .= "Use o comando " . $this->config->item("comandosacaritens") . "+número para sacar. Ex. " . $this->config->item("comandosacaritens") . "1\r\n";

      $mensagem .= "Pontuação Disponível: " . (($dadospvp->pontos - $dadospvp->saques) < 0 ? "0" : ($dadospvp->pontos - $dadospvp->saques)) . "\r\n";
      $this->Gamed_model->chat2player($charid, $mensagem);
    }
  }

  public function sacaritens($charid, $canal, $itemindex) {
    if (empty($itemindex) or is_null($itemindex)) {
      $this->consultaitens($charid, $canal);
    } else {
      $bloqueado = $this->Competitivo_model->getPersonagemBloqueado($charid);
      if ($bloqueado) {
        $mensagem = "O saque de itens está bloqueado para este personagem";
      } else {
        $dadospvp = $this->Competitivo_model->getDadosPVP($charid);
        $saldopontos = $dadospvp->pontos - $dadospvp->saques;
        $itens = $this->Competitivo_model->getItensPVP();
        $item_escolhido = array();
        $i = 1;
        foreach ($itens as $item) {
          if ($i == $itemindex) {
            $item_escolhido = $item;
            break;
          }
          $i++;
        }
        if (empty($item_escolhido)) {
          $mensagem = "Item não encontrado \r\n";
          $mensagem .= "\r\nUse o comando " . $this->config->item("comandoconsultaitens") . " para consultar os itens disponíveis\r\n";
        } else {
          if ($saldopontos > $item_escolhido->pontossaque) {
            $this->Competitivo_model->salvarSaque($charid, $item_escolhido);
            $this->enviaritem($charid, $item_escolhido);
            $mensagem = "Saque do item " . $item_escolhido->nome . " realizado com sucesso. O item foi enviado via correio.";
          } else {
            $mensagem = "Saldo insuficiente para realizar esse saque!";
          }
        }
        $this->Gamed_model->chat2player($charid, $mensagem);
      }
    }
  }

  public function enviaritem($charid, $item_escolhido) {
    $item = array(
        'id' => $item_escolhido->itemid,
        'pos' => $item_escolhido->pos,
        'count' => $item_escolhido->count,
        'max_count' => $item_escolhido->max_count,
        'data' => $item_escolhido->data,
        'proctype' => $item_escolhido->proctype,
        'expire_date' => $item_escolhido->expire_date,
        'guid1' => $item_escolhido->guid1,
        'guid2' => $item_escolhido->guid2,
        'mask' => $item_escolhido->mask
    );
    $this->Gamed_model->sendMail($charid, "Saque PVP", "Você está recebendo o item escolhido. Obrigado.", $item, 0);
  }

}
