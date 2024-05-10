<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Competitivo extends CI_Controller
{

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
  public function __construct()
  {
    parent::__construct();
    $this->load->model("Competitivo_model");
    $this->load->model("Competitivopw_model");
    $this->load->model("Configuracoes_model");
    $this->load->model("Mensageiro_model");
    $this->load->model("Gamed_model");
  }

  public function salvar_kill($matou_id, $morreu_id)
  {
    if ($this->input->is_cli_request()) {
      if ($this->config->item("usarpvp") == 1) {
        //Logs em modo debug
        log_message('debug', 'Salvar Kill. Matou_id: ' . $matou_id . " Morreu_id: " . $morreu_id);
        log_message('debug', 'Este processo inclui buscar e atualizar informações dos personagens, buscar e atualizar informações das guilds dos personagens e atualizar os membros das guilds, buscar informações de pvp do usuário que matou e enviar mensagem ao jogo e salvar a kill no banco de dados.');
        $this->benchmark->mark('code_start');

        //buscar informações dos personagens
        $personagem_matou = $this->Gamed_model->getRole($matou_id);
        $personagem_morreu = $this->Gamed_model->getRole($morreu_id);

        //Checa se existem informações dos ids informados
        if ($personagem_matou['base']['id'] > 0 and $personagem_morreu['base']['id'] > 0) {

          //pegar informação da guild dos personagens
          $personagem_matou['faction'] = $this->Gamed_model->getUserFaction($matou_id);
          $personagem_morreu['faction'] = $this->Gamed_model->getUserFaction($morreu_id);

          //Salvar kill no banco de dados
          if (!$this->Competitivo_model->salvarKill($personagem_matou, $personagem_morreu)) {
            //loga um erro caso não seja possivel salvar a kill no banco de dados
            log_message('error', 'Falha ao salvar a kill no banco de dados: matou_id - ' . $matou_id . " morreu_id: " . $morreu_id);
          }

          //atualiza o personagens que matou
          if (!$this->Competitivo_model->salvarPersonagem($personagem_matou)) {
            //loga um erro caso não seja possivel salvar o personagem que matou no banco de dados
            log_message('error', 'Falha ao salvar o personagem no banco de dados: matou_id - ' . $matou_id);
          }

          //atualiza o personagem que morreu
          if (!$this->Competitivo_model->salvarPersonagem($personagem_morreu)) {
            //loga um erro caso não seja possivel salvar o personagem que morreu no banco de dados
            log_message('error', 'Falha ao salvar o personagem no banco de dados: morreu_id - ' . $morreu_id);
          }

          //enviar mensagem da kill
          $bloqueadomatou = $this->Competitivo_model->getPersonagemBloqueado($matou_id);
          $bloqueadomorreu = $this->Competitivo_model->getPersonagemBloqueado($morreu_id);
          if ($this->config->item("usarmensagempvp") == 1 and !$bloqueadomatou and !$bloqueadomorreu) {
            //buscar informações de kill e morte
            $dados_pvp = $this->Competitivo_model->getDadosPVP($matou_id);
            // buscar mensagens
            $mensagens = $this->Competitivo_model->getMensagens();
            $mensagem = $mensagens[array_rand($mensagens)]['mensagem'];

            //substituir dados nas mensagens
            $mensagem = str_replace("{{nick_matou}}", $personagem_matou['base']['name'], $mensagem);
            $mensagem = str_replace("{{nick_morreu}}", $personagem_morreu['base']['name'], $mensagem);
            $mensagem = str_replace("{{numero_kills}}", $dados_pvp->kills, $mensagem);
            $mensagem = str_replace("{{numero_mortes}}", $dados_pvp->deaths, $mensagem);
            $mensagem = str_replace("{{pontos_pvp}}", $dados_pvp->pontos, $mensagem);

            //enviar mensagem para o jogo
            $this->Gamed_model->worldChat(0, $mensagem, $this->config->item("canalmensagenspvp"));
          }

          // checa se é necessário atualizar as informações da guild do personagem que matou
          if ($personagem_matou['faction']['fid'] > 0) {
            //atualiza a guild
            $this->simple_update_guild($personagem_matou['faction']['fid']);
          }

          // checa se é necessário atualizar as informações da guild do personagem que morreu
          if ($personagem_morreu['faction']['fid'] > 0) {
            //atualiza a guild
            $this->simple_update_guild($personagem_morreu['faction']['fid']);
          }
        } else {
          // Se não existir informações de um dos personagens no gamedbd loga um erro
          log_message('error', 'Falha ao salvar a kill - Não foi possivel buscar infirmações dos personagens: matou_id - ' . $matou_id . " morreu_id: " . $morreu_id);
        }
        $this->benchmark->mark('code_end');
        log_message('debug', 'Tempo de execução: ' . $this->benchmark->elapsed_time('code_start', 'code_end'));
        echo "Tempo de execução: " . $this->benchmark->elapsed_time('code_start', 'code_end');
      } else {
        $this->output->set_status_header(403);
      }
    }
  }

  public function updatetw()
  {
    if ($this->input->is_cli_request()) {
      //Logs em modo debug
      log_message('debug', 'Update Tw');
      log_message('debug', 'Este processo inclui buscar e atualizar as informações dos territorios, buscar e atualizar informações das guilds e dos membros das guilds.');
      $this->benchmark->mark('code_start');
      //Busca as informações dos territórios
      $territorios = $this->Gamed_model->getTerritories()['Territory'];

      //atualiza os territórios
      if (!$this->Competitivo_model->salvarTerritorios($territorios)) {

        //loga um erro caso não seja possivel salvar os territorios
        log_message('error', 'Falha ao atualizar os territorios no banco de dados');
      }

      //atualiza informações das guild
      foreach ($territorios as $territorio) {
        if ($territorio['owner'] > 0) {
          $this->update_guild($territorio['owner']);
        }
      }

      $this->benchmark->mark('code_end');
      log_message('debug', 'Tempo de execução: ' . $this->benchmark->elapsed_time('code_start', 'code_end'));
    } else {
      $this->output->set_status_header(403);
    }
  }

  public function update_guild($guild_id)
  {
    if ($guild_id > 0) {
      if ($this->input->is_cli_request()) {
        $guild = $this->Gamed_model->getFactionDetail($guild_id);
        //atualiza as informações no banco de dados
        if (!$this->Competitivo_model->salvarGuild($guild)) {

          //loga um erro caso não seja possivel salvar a kill no banco de dados
          log_message('error', 'Falha ao salvar as informações da guild no banco de dados: matou_id - ' . $matou_id);
        }

        //atualiza informação dos membros da guild
        foreach ($guild['member'] as $membro) {
          //atualiza informação do personagem
          $this->update_personagem($membro['roleid']);
        }
      } else {
        $this->output->set_status_header(403);
      }
    }
  }

  public function simple_update_guild($guild_id)
  {
    if ($guild_id > 0) {
      if ($this->input->is_cli_request()) {
        $guild = $this->Gamed_model->getFactionDetail($guild_id);
        //atualiza as informações no banco de dados
        if (!$this->Competitivo_model->salvarGuild($guild)) {

          //loga um erro caso não seja possivel salvar a kill no banco de dados
          log_message('error', 'Falha ao salvar as informações da guild no banco de dados: matou_id - ' . $matou_id);
        }
      } else {
        $this->output->set_status_header(403);
      }
    }
  }

  public function update_personagem($char_id, $clan_id = null)
  {
    if ($this->input->is_cli_request()) {

      $personagem = $this->Gamed_model->getRole($char_id);

      //Checa se existem informações do personagem
      if ($personagem['base']['id'] > 0) {
        if ($clan_id == null) {
          $personagem['faction'] = $this->Gamed_model->getUserFaction($char_id);
        } else {
          $personagem['faction']['fid'] = $clan_id;
        }
      }

      if (!$this->Competitivo_model->salvarPersonagem($personagem)) {
        //loga um erro caso não seja possivel salvar o personagem que matou no banco de dados
        log_message('error', 'Falha ao salvar o personagem no banco de dados: char_id - ' . $char_id);
      }
    } else {
      $this->output->set_status_header(403);
    }
  }

}
