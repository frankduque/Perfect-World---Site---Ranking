<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GO\Scheduler;

/**
 * Cron
 *
 * @package     CodeIgniter
 * @subpackage  Controller
 * @category    Controller
 * @property Competitivo_model $Competitivo_model
 * @property Competitivopw_model $Competitivopw_model
 * @property Configuracoes_model $Configuracoes_model
 * @property Mensageiro_model $Mensageiro_model
 * @property Gamed_model $Gamed_model
 * @property CI_Input $input
 * @property CI_Output $output
 * @property CI_Benchmark $benchmark
 * @property CI_Config $config
 */

class Cron extends CI_Controller
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

  public function index()
  {

    if ($this->input->is_cli_request()) {
      $this->mensageiro();
      $this->atualizartw();
      $this->atualizarpve();
      $this->scriptgolds();
    } else {
      $this->output->set_status_header(403);
    }
  }

  public function mensageiro()
  {
    if ($this->input->is_cli_request()) {
      if ($this->config->item("usarmensageiro") == 1) {
        $mensagens = $this->Mensageiro_model->getMensagens();
        if (isset($mensagens) and !is_null($mensagens)) {
          $scheduler = new Scheduler();
          foreach ($mensagens as $mensagem) {
            $scheduler->call(function () use ($mensagem) {
              $this->Gamed_model->worldChat(0, $mensagem->mensagem, $mensagem->canal);
            })->at($mensagem->periodicidade);
          }
          $scheduler->run();
        }
      }
    } else {
      $this->output->set_status_header(403);
    }
  }

  public function atualizartw()
  {
    if ($this->input->is_cli_request()) {
      if ($this->config->item("usarupdatetw") == 1) {
        $updates = $this->Competitivo_model->getUpdateTW();

        if (isset($updates) and !is_null($updates)) {
          $scheduler = new Scheduler();
          foreach ($updates as $update) {
            $scheduler->call(function () use ($update) {

              $this->updatetw();
            })->at($update->periodicidade);
          }
          $scheduler->run();
        }
      }
    } else {
      $this->output->set_status_header(403);
    }
  }

  public function atualizarpve()
  {
    if ($this->input->is_cli_request()) {
      if ($this->config->item("usarupdatepve") == 1) {
        $updates = $this->Competitivo_model->getUpdatePVE();

        if (isset($updates) and !is_null($updates)) {
          $scheduler = new Scheduler();
          foreach ($updates as $update) {
            $scheduler->call(function () use ($update) {
              $this->updatepve();
            })->at($update->periodicidade);
          }
          $scheduler->run();
        }
      }
    } else {
      $this->output->set_status_header(403);
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

      $guilds_atualizar = array();
      //atualiza informações das guild
      foreach ($territorios as $territorio) {
        if ($territorio['owner'] > 0) {
          if (!in_array($territorio['owner'], $guilds_atualizar)) {
            array_push($guilds_atualizar, $territorio['owner']);
          }
        }

        if ($territorio['challenger'] > 0) {
          if (!in_array($territorio['challenger'], $guilds_atualizar)) {
            array_push($guilds_atualizar, $territorio['challenger']);
          }

        }
      }
      foreach ($guilds_atualizar as $guild_id) {
        $this->update_guild($guild_id);
      }

      //atualiza os territórios
      if (!$this->Competitivo_model->salvarTerritorios($territorios)) {

        //loga um erro caso não seja possivel salvar os territorios
        log_message('error', 'Falha ao atualizar os territorios no banco de dados');
      }

      $this->benchmark->mark('code_end');
      log_message('debug', 'Tempo de execução: ' . $this->benchmark->elapsed_time('code_start', 'code_end'));
      $dados = array(
        "UltUpdatetw" => date("d-m-Y H:i:s"),
        "TempoGastotw" => $this->benchmark->elapsed_time('code_start', 'code_end')
      );
      $this->Configuracoes_model->salvarConfigs($dados, "updatetw");
    } else {
      $this->output->set_status_header(403);
    }
  }

  public function update_guild($guild_id)
  {
    if ($this->input->is_cli_request() && $guild_id > 0) {
      $guild = $this->Gamed_model->getFactionDetail($guild_id);

      //atualiza as informações no banco de dados
      if (!$this->Competitivo_model->salvarGuild($guild)) {

        //loga um erro caso não seja possivel salvar a kill no banco de dados
        log_message('error', 'Falha ao salvar as informações da guild no banco de dados: guild_id - ' . $guild_id);
      }

      //atualiza informação dos membros da guild
      foreach ($guild['member'] as $membro) {
        //atualiza informação do personagem
        $this->update_personagem($membro['roleid'], $guild_id);
      }
    } else {
      $this->output->set_status_header(403);
    }
  }

  public function update_personagem($char_id, $clan_id = null)
  {
    if ($this->input->is_cli_request()) {
      //busca as informações do personagem
      $personagem = $this->Gamed_model->getRole($char_id);

      //Checa se existem informações do personagem
      if ($personagem['base']['id'] > 0) {
        if ($clan_id == null) {
          $personagem['faction'] = $this->Gamed_model->getUserFaction($char_id);
        } else {
          $personagem['faction']['fid'] = $clan_id;
        }
      }

      $equipamentos = array();
      foreach ($personagem['equipment']['eqp'] as $equipamento) {
        $equipamentos = array(
          'id' => $equipamento['id'],
          'pos' => $equipamento['pos']
        );
      }
      $personagem['equipment']['eqp'] = $equipamentos;



      if (!$this->Competitivo_model->salvarPersonagem($personagem)) {
        //loga um erro caso não seja possivel salvar o personagem que matou no banco de dados
        log_message('error', 'Falha ao salvar o personagem no banco de dados: char_id - ' . $char_id);
      }
    } else {
      $this->output->set_status_header(403);
    }
  }

  function updatepve()
  {
    //Logs em modo debug
    log_message('debug', 'Update PVE');
    log_message('debug', 'Este processo inclui buscar as informações de todas as contas, buscar e atualizar informações dos personagens.');
    $this->benchmark->mark('code_start');

    //busca as informações das contas
    $contas = $this->Competitivopw_model->getAccounts();

    //guardar as guilds que foram atualizadas para evitar atualizações duplicadas
    $guilds_atualizadas = array();

    //para coda conta 
    foreach ($contas as $conta) {

      //busca todos os personagens da conta
      $personagens = $this->Gamed_model->getRoles($conta->ID);

      //se a conta possuir personagens
      if (isset($personagens['roles'])) {

        //para cada personagem atualiza as informações
        foreach ($personagens['roles'] as $personagem) {

          //se o personagem for valido
          if (isset($personagem['id']) and $personagem['id'] > 100) {
            $charid = $personagem['id'];

            //busca a guild do personagem 
            $guild = $this->Gamed_model->getUserFaction($charid);

            //se o personagem possuir guild
            if (isset($guild['fid']) and $guild['fid'] > 0) {

              //se a guild ainda não foi atualizada
              if (!in_array($guild['fid'], $guilds_atualizadas)) {

                //atualiza as informações da guild e adiciona a guild na lista de guilds atualizadas
                array_push($guilds_atualizadas, $guild['fid']);
                $this->simple_update_guild($guild['fid']);
              }
            }

            //atualiza os personagens
            $this->update_personagem($personagem['id'], $guild['fid']);
          }
        }
      }
    }
    log_message('debug', 'Tempo de execução: ' . $this->benchmark->elapsed_time('code_start', 'code_end'));
    $dados = array(
      "UltUpdatepve" => date("d-m-Y H:i:s"),
      "TempoGastopve" => $this->benchmark->elapsed_time('code_start', 'code_end')
    );
    $this->Configuracoes_model->salvarConfigs($dados, "updatepve");
  }

  public function simple_update_guild($guild_id)
  {
    if ($this->input->is_cli_request() && $guild_id > 0) {
      $guild = $this->Gamed_model->getFactionDetail($guild_id);
      //atualiza as informações no banco de dados
      if (!$this->Competitivo_model->salvarGuild($guild)) {
        //loga um erro caso não seja possivel salvar a kill no banco de dados
        log_message('error', 'Falha ao salvar as informações da guild no banco de dados: guild_id - ' . $guild_id);
      }
    } else {
      $this->output->set_status_header(403);
    }
  }

  public function scriptgolds()
  {
    if ($this->input->is_cli_request()) {
      if ($this->config->item("usarscriptgolds") == 1) {
        $scripts = $this->Competitivo_model->getScriptsGold();
        if (isset($scripts) and !is_null($scripts)) {
          $scheduler = new Scheduler();
          foreach ($scripts as $script) {
            $scheduler->call(function () use ($script) {
              $this->processarScriptGolds($script->id, $script->levelminimo, $script->cultivominimo, $script->quantidade, ($script->unicoip == 1 ? true : false), ($script->estaronline == 1 ? true : false), ($script->unicoconta == 1 ? true : false), ($script->usarrankingpve == 1 ? true : false), ($script->entregarviaapi == 1 ? true : true), $script->mensagem, $script->canal);
            })->at($script->periodicidade);
          }
          $scheduler->run();
        }
      }
    } else {
      $this->output->set_status_header(403);
    }
  }
  public function getOnlineList()
  {
    $onlines = $this->Gamed_model->getOnlineList();
    var_dump($onlines);
  }
  public function processarScriptGolds($id, $levelminimo = 1, $cultivominimo = 0, $quantidade = 1, $unicoip = true, $estaronline = true, $unicoconta = true, $usarrankingpve = true, $entregarviaapi = true, $mensagem = false, $canal = 0)
  {

    if ($quantidade > 0) {
      $personagens = $this->Competitivo_model->getPersonagensScriptGold($levelminimo, $cultivominimo, $unicoconta);
      log_message('error', 'buscou personagens: ' . count($personagens));


      if ($estaronline) {
        $tmppersonagens = $personagens;
        $personagens = array();
        $onlines = $this->Gamed_model->getOnlineList();
        log_message('error', 'onlines: ' . json_encode($onlines));
        foreach ($onlines as $on) {
          foreach ($tmppersonagens as $tmp) {
            if ($on['userid'] == $tmp->userid) {
              $personagens[] = $tmp;
            }
          }
        }
      }

      if ($unicoip) {
        $tmppersonagens = $personagens;
        $personagens = array();
        $ips = array();
        foreach ($tmppersonagens as $tmp) {
          $extra = $this->Gamed_model->DBGetConsumeInfosArg($tmp->charid);
          if (!in_array($extra['login_ip'], $ips)) {
            $personagens[] = $tmp;
            array_push($ips, $extra['login_ip']);
            log_message('error', 'IP: ' . $extra['login_ip']);
          }
        }
      }
      foreach ($personagens as $each) {
        $gold = $quantidade * 100;
        log_message('error', 'Gold: ' . $gold);
        if ($entregarviaapi) {
          log_message('error', 'entregarviaapi: ' . $entregarviaapi);

          $this->Gamed_model->sendGold($each->userid, $gold);
        } else {
          log_message('error', 'entregar via bd: ' . $entregarviaapi);
          $this->Competitivopw_model->sendGold($each->userid, $gold);
        }
        log_message('error', 'charid: ' . $each->charid);

        $mensagemp = "Você acaba de receber " . $quantidade . " Golds através do nosso script de golds";
        $this->Gamed_model->chat2player($each->charid, $mensagemp);
      }

      if ($mensagem && !empty($mensagem)) {
        $mensagem = str_replace(
          array('{{quantidade}}', '{{levelminimo}}', '{{cultivominimo}}'),
          array($quantidade, $levelminimo, $cultivominimo),
          $mensagem
        );
        $this->Gamed_model->worldChat(0, $mensagem, $canal);
      }
      $this->Competitivo_model->updateExecucaoScriptGold($id);

    }
  }

}
