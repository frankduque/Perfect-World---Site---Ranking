<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Competitivo_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  function salvarKill($personagem_matou, $personagem_morreu)
  {
    $this->db->set('matou_id', $personagem_matou['base']['id']);
    $this->db->set('matou_guild_id', $personagem_matou['faction']['fid']);
    $this->db->set('morreu_id', $personagem_morreu['base']['id']);
    $this->db->set('morreu_guild_id', $personagem_morreu['faction']['fid']);
    $this->db->set('data', 'NOW()', FALSE);
    $this->db->insert('competitivo_pvp');
    return ($this->db->affected_rows() != 1 ? false : $this->db->insert_id());
  }

  function salvarPersonagem($personagem)
{
    $data = array(
        'charid' => $personagem['base']['id'],
        'userid' => $personagem['base']['userid'],
        'nome' => $personagem['base']['name'],
        'raca' => $personagem['base']['race'],
        'classe' => $personagem['base']['cls'],
        'genero' => $personagem['base']['gender'],
        'level' => $personagem['status']['level'],
        'cultivo' => $personagem['status']['level2'],
        'exp' => $personagem['status']['exp'],
        'reputacao' => $personagem['status']['reputation'],
        'guild_id' => ($personagem['faction']['fid'] == 0 ? null : $personagem['faction']['fid']),
        'equipamentos' => json_encode($personagem['equipment']['eqp']),
        'spouse' => $personagem['base']['spouse'],
        'dataupdate' => 'NOW()'
    );

    $sql = "INSERT INTO competitivo_personagens (charid, userid, nome, raca, classe, genero, level, cultivo, exp, reputacao, guild_id, equipamentos, spouse, dataupdate)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
            userid = VALUES(userid),
            nome = VALUES(nome),
            raca = VALUES(raca),
            classe = VALUES(classe),
            genero = VALUES(genero),
            level = VALUES(level),
            cultivo = VALUES(cultivo),
            exp = VALUES(exp),
            reputacao = VALUES(reputacao),
            guild_id = VALUES(guild_id),
            equipamentos = VALUES(equipamentos),
            spouse = VALUES(spouse),
            dataupdate = VALUES(dataupdate)";

    $values = array_values($data);

    return $this->db->query($sql, $values);
}
  function salvarGuild($guild)
  {
    return $this->db->query('INSERT INTO competitivo_guilds (guild_id, guild_nome, level, master, announce, sysinfo, last_op_time, membros, dataupdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW()) ON DUPLICATE KEY UPDATE guild_nome = VALUES(guild_nome), level = VALUES(level), master = VALUES(master), announce = VALUES(announce), sysinfo = VALUES(sysinfo), last_op_time = VALUES(last_op_time), membros = VALUES(membros), dataupdate = VALUES(dataupdate)', array($guild['fid'], $guild['name'], $guild['level'], $guild['master'], $guild['announce'], $guild['sysinfo'], $guild['last_op_time'], count($guild['member'])));

  }

  function getDadosPVP($charid)
  {
    $this->db->select('sq.*, p.*, COALESCE(lc.kills,0) as kills , COALESCE(lc2.deaths,0) as deaths, COALESCE(lc.kills,0)* ' . $this->config->item("pontosmatarpvp") . ' - COALESCE(lc2.deaths,0)* ' . $this->config->item("pontosmorrerpvp") . ' as pontos');
    $this->db->from('competitivo_personagens p');
    $this->db->join('(SELECT lc.matou_id, count(*) as kills FROM competitivo_pvp lc group by lc.matou_id) lc', 'p.charid = lc.matou_id', 'LEFT', NULL);
    $this->db->join('(SELECT lc2.morreu_id, count(*) as deaths FROM competitivo_pvp lc2 group by lc2.morreu_id) lc2', 'p.charid = lc2.morreu_id', 'LEFT', NULL);
    $this->db->join('(SELECT charid, sum(pontos) as saques FROM saque_itens_pvp sq group by sq.charid) sq', 'p.charid = sq.charid', 'LEFT', NULL);
    $this->db->where('p.charid', $charid);
    $query = $this->db->get("");
    return $query->row();
  }

  function getUpdateTW()
  {
    $query = $this->db->get("updatetw");
    return $query->result();
  }

  function salvarTerritorios($territorios)
  {
    foreach ($territorios as $territorio) {
      $territorio['owner'] = $territorio['owner'] == 0 ? null : $territorio['owner'];
      $territorio['challenger'] = $territorio['challenger'] == 0 ? null : $territorio['challenger'];
      $this->db->replace('competitivo_territorios', $territorio);
      if ($this->db->affected_rows() == 0) {
        return false;
      }
    }
    return true;
  }

  function getUpdatePVE()
  {
    $query = $this->db->get("updatepve");
    return $query->result();
  }

  function getGuildsIds()
  {
    $this->db->select("guild_id");
    $this->db->distinct();
    $this->db->where('guild_id >', "0");

    $query = $this->db->get("competitivo_personagens");
    return $query->result();
  }

  function getItensPVPOffSet($offset = 0)
  {
    if ($offset <= 0 or !is_numeric($offset)) {
      $offset = 0;
    } else {
      $offset = $offset * 5;
    }
    $this->db->limit(5, $offset);
    $this->db->order_by("nome", "asc");
    $query = $this->db->get("itenspvp");
    return $query->result();
  }

  function getItensPVP()
  {
    $this->db->order_by("nome", "asc");
    $query = $this->db->get("itenspvp");
    return $query->result();
  }

  function getNumeroItensPVP()
  {
    $this->db->order_by("nome", "asc");
    $query = $this->db->get("itenspvp");
    return $query->num_rows();
  }

  function salvarSaque($charid, $item)
  {
    $this->db->set('itemid', $item->itemid);
    $this->db->set('itemnome', $item->nome);
    $this->db->set('pontos', $item->pontossaque);
    $this->db->set('charid', $charid);
    $this->db->set('datasaque', 'NOW()', FALSE);
    $this->db->insert('saque_itens_pvp');
    return ($this->db->affected_rows() != 1 ? false : true);
  }

  function getPersonagemBloqueado($charid)
  {
    $this->db->where('charid', "$charid");
    $query = $this->db->get("competitivo_bloqueio");
    return ($query->num_rows() > 0 ? true : false);
  }

  function getScriptsGold()
  {
    $query = $this->db->get("scriptgolds");
    return $query->result();
  }

  function getPersonagensScriptGold($levelminimo, $cultivominimo, $unicoconta)
  {
    $this->db->where('level >=', $levelminimo);
    $this->db->where('cultivo >=', $cultivominimo);
    if ($unicoconta) {
      $this->db->group_by("userid");
      $this->db->select("userid");
      $this->db->select("ANY_VALUE(`charid`) as charid", false);
    } else {
      $this->db->select("userid");
      $this->db->select("charid");
    }
    $query = $this->db->get("competitivo_personagens");
    return $query->result();
  }

  function updateExecucaoScriptGold($id)
  {
    $this->db->set('ultimaexecucao', 'NOW()', FALSE);
    $this->db->where('id', $id);
    $this->db->update('scriptgolds');
  }

  function getMensagens()
  {
    $query = $this->db->get("competitivo_mensagens");
    return $query->result_array();
  }

}
