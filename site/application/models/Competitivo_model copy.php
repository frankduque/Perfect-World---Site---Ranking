<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Competitivo_pvp_model extends Crud_Model
{

    protected $table = "competitivo_pvp";

    public function __construct()
    {
        parent::__construct($this->table);

    }

    function get_rank_pvp($periodo = "geral", $classe = "todas")
    {
        $this->db->select('c.matou_id, COALESCE(lc.kills,0) as kills, COALESCE(lc2.deaths,0) as deaths, COALESCE(lc.kills,0)* ' . $this->config->item("pontosmatarpvp") . ' - COALESCE(lc2.deaths,0)* ' . $this->config->item("pontosmorrerpvp") . ' as pontos, p.*, g.*');
        $this->db->from('competitivo_pvp c');
        $this->db->join('(SELECT lc.matou_id, count(*) as kills FROM competitivo_pvp lc ' . ($periodo != "geral" ? ($periodo == "atual" ? "WHERE MONTH(`data`) = MONTH(CURDATE()) AND YEAR(`data`) = YEAR(CURDATE())" : "WHERE MONTH( data ) = MONTH( DATE_SUB(CURDATE(),INTERVAL " . $periodo . " MONTH )) AND YEAR( data ) = YEAR( DATE_SUB(CURDATE( ),INTERVAL " . $periodo . " MONTH ))") : "") . ' group by lc.matou_id) lc', 'c.matou_id = lc.matou_id', 'LEFT', NULL);
        $this->db->join('(SELECT lc2.morreu_id, count(*) as deaths FROM competitivo_pvp lc2 ' . ($periodo != "geral" ? ($periodo == "atual" ? "WHERE MONTH(`data`) = MONTH(CURDATE()) AND YEAR(`data`) = YEAR(CURDATE())" : "WHERE MONTH( data ) = MONTH( DATE_SUB(CURDATE(),INTERVAL " . $periodo . " MONTH )) AND YEAR( data ) = YEAR( DATE_SUB(CURDATE( ),INTERVAL " . $periodo . " MONTH ))") : "") . ' group by lc2.morreu_id) lc2', 'c.matou_id = lc2.morreu_id', 'LEFT', NULL);
        $this->db->join('competitivo_personagens p', 'p.charid = c.matou_id', 'left');
        $this->db->join('competitivo_guilds g', 'p.guild_id = g.guild_id', 'left');
        ($classe != "todas" ? $this->db->where('p.classe', $this->config->item("classe2id")[$classe]) : "");
        $where = "c.matou_id NOT IN (SELECT charid FROM competitivo_bloqueio) and c.morreu_id NOT IN (SELECT charid FROM competitivo_bloqueio)";
        $this->db->where($where);
        $this->db->group_by('c.matou_id');
        $this->db->order_by("pontos", 'DESC');
        $this->db->limit($this->config->item("limiterankingpvp"), 0);
        $query = $this->db->get();
        return $query->result();
    }

    function get_rank_pve($classe = "todas")
    {
        $this->db->select('p.*, g.guild_id, g.guild_nome');
        $this->db->from('competitivo_personagens p');
        $this->db->join('competitivo_guilds g', 'p.guild_id = g.guild_id', 'left');
        ($classe != "todas" ? $this->db->where('p.classe', $this->config->item("classe2id")[$classe]) : "");
        $this->db->order_by("p.level", 'DESC');
        $this->db->order_by("p.cultivo", 'DESC');
        $this->db->order_by("p.reputacao", 'DESC');
        $this->db->limit($this->config->item("limiterankingpve"), 0);
        $query = $this->db->get();
        return $query->result();
    }

    function get_rank_gvg($periodo = "geral")
    {
        $this->db->select('p2.mestre, p2.charid, g.*, lc2.morreu_guild_id, c.matou_guild_id, COALESCE(lc.kills,0) as kills, COALESCE(lc2.deaths,0) as deaths, COALESCE(lc.kills,0)* ' . $this->config->item("pontosmatarpvp") . ' - COALESCE(lc2.deaths,0)* ' . $this->config->item("pontosmorrerpvp") . ' as pontos');
        $this->db->from('competitivo_pvp c');
        $this->db->join('(SELECT lc.matou_guild_id, count(*) as kills FROM competitivo_pvp lc ' . ($periodo != "geral" ? ($periodo == "atual" ? "WHERE matou_guild_id > 0 and matou_morto_id > 0 and MONTH(`data`) = MONTH(CURDATE()) AND YEAR(`data`) = YEAR(CURDATE())" : "WHERE matou_guild_id > 0 and matou_morto_id > 0 and MONTH( data ) = MONTH( DATE_SUB(CURDATE(),INTERVAL " . $periodo . " MONTH )) AND YEAR( data ) = YEAR( DATE_SUB(CURDATE( ),INTERVAL " . $periodo . " MONTH ))") : "where matou_guild_id > 0 and matou_guild_id > 0") . ' group by matou_guild_id) lc', 'c.matou_guild_id = lc.matou_guild_id', 'LEFT', NULL);
        $this->db->join('(SELECT lc2.morreu_guild_id, count(*) as deaths FROM competitivo_pvp lc2 ' . ($periodo != "geral" ? ($periodo == "atual" ? "WHERE matou_guild_id > 0 and matou_morto_id > 0 and MONTH(`data`) = MONTH(CURDATE()) AND YEAR(`data`) = YEAR(CURDATE())" : "WHERE matou_guild_id > 0 and matou_morto_id > 0 and MONTH( data ) = MONTH( DATE_SUB(CURDATE(),INTERVAL " . $periodo . " MONTH )) AND YEAR( data ) = YEAR( DATE_SUB(CURDATE( ),INTERVAL " . $periodo . " MONTH ))") : "where matou_guild_id > 0 and matou_guild_id > 0") . ' group by lc2.morreu_guild_id) lc2', 'c.matou_guild_id = lc2.morreu_guild_id', 'LEFT', NULL);
        $this->db->join('competitivo_guilds g', 'c.matou_guild_id = g.guild_id', 'left');
        $this->db->join('(SELECT nome as mestre, charid FROM competitivo_personagens p2) p2', 'p2.charid = g.master', 'LEFT', NULL);
        $this->db->where('c.matou_guild_id >', "0");
        $this->db->where('c.morreu_guild_id >', "0");
        $this->db->group_by('c.matou_guild_id');
        $this->db->order_by("pontos", 'DESC');
        $this->db->limit($this->config->item("limiterankinggvg"), 0);

        $query = $this->db->get();
        return $query->result();
    }

    function get_rank_tw()
    {
        $this->db->select('t.*, g.*, COALESCE(lt.pontos,0)*1 as pontos');
        $this->db->from('competitivo_territorios t');
        $this->db->join('(SELECT SUM(level) as pontos, owner FROM competitivo_territorios lt group by lt.owner) lt', 't.owner = lt.owner', 'LEFT', NULL);
        $this->db->join('competitivo_guilds g', 't.owner = g.guild_id', 'left');
        $this->db->where('t.owner >', "0");
        $this->db->group_by('t.owner');
        $this->db->group_by('t.color');
        $this->db->group_by('t.id');
        $this->db->order_by("pontos", 'DESC');
        $this->db->order_by("owner", 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function get_territorios()
    {
        $this->db->select('t.*, g.*');
        $this->db->from('competitivo_territorios t');
        $this->db->join('competitivo_guilds g', 't.owner = g.guild_id', 'left');
        $query = $this->db->get("");
        return $query->result();
    }

    function get_personagem($charid)
    {
        $this->db->select('p.*, p.level as nivel, g.*, COALESCE(lc.kills,0) as kills , COALESCE(lc2.deaths,0) as deaths, COALESCE(lc.kills,0)* ' . $this->config->item("pontosmatarpvp") . ' - COALESCE(lc2.deaths,0)* ' . $this->config->item("pontosmorrerpvp") . ' as pontos');
        $this->db->from('competitivo_personagens p');
        $this->db->join('competitivo_guilds g', 'p.guild_id = g.guild_id', 'left');
        $this->db->join('(SELECT lc.matou_id, count(*) as kills FROM competitivo_pvp lc group by lc.matou_id) lc', 'p.charid = lc.matou_id', 'LEFT', NULL);
        $this->db->join('(SELECT lc2.morreu_id, count(*) as deaths FROM competitivo_pvp lc2 group by lc2.morreu_id) lc2', 'p.charid = lc2.morreu_id', 'LEFT', NULL);
        $this->db->where('p.charid', $charid);
        $query = $this->db->get("");
        return $query->row();
    }

    function get_personagembynome($charnome)
    {
        $this->db->select('p.*, g.*, COALESCE(lc.kills,0) as kills , COALESCE(lc2.deaths,0) as deaths, COALESCE(lc.kills,0)* ' . $this->config->item("pontosmatarpvp") . ' - COALESCE(lc2.deaths,0)* ' . $this->config->item("pontosmorrerpvp") . ' as pontos');
        $this->db->from('competitivo_personagens p');
        $this->db->join('competitivo_guilds g', 'p.guild_id = g.guild_id', 'left');
        $this->db->join('(SELECT lc.matou_id, count(*) as kills FROM competitivo_pvp lc group by lc.matou_id) lc', 'p.charid = lc.matou_id', 'LEFT', NULL);
        $this->db->join('(SELECT lc2.morreu_id, count(*) as deaths FROM competitivo_pvp lc2 group by lc2.morreu_id) lc2', 'p.charid = lc2.morreu_id', 'LEFT', NULL);
        $this->db->where('p.nome', $charnome);
        $query = $this->db->get("");
        return $query->row();
    }

    function get_rank_clans($periodo = "geral")
    {
        $this->db->select('g.*, COALESCE(territorios,0) as territorios, p.nome, COALESCE(lt.pontos,0)*1 as pontos, COALESCE(lc.kills,0) as kills, COALESCE(lc2.deaths,0) as deaths, COALESCE(lc.kills,0)* ' . $this->config->item("pontosmatarpvp") . ' - COALESCE(lc2.deaths,0)* ' . $this->config->item("pontosmorrerpvp") . ' as pontosgvg');
        $this->db->from('competitivo_guilds g');
        $this->db->join('(SELECT t.owner, count(*) as territorios FROM competitivo_territorios t group by t.owner) t', 'g.guild_id = t.owner', 'LEFT', NULL);
        $this->db->join('competitivo_personagens p', 'p.charid = g.master', 'left');
        $this->db->join('(SELECT lc.matou_guild_id, count(*) as kills FROM competitivo_pvp lc where matou_guild_id > 0 and morreu_guild_id > 0 group by matou_guild_id) lc', 'g.guild_id = lc.matou_guild_id', 'LEFT', NULL);
        $this->db->join('(SELECT lc2.morreu_guild_id, count(*) as deaths FROM competitivo_pvp lc2 where matou_guild_id > 0 and morreu_guild_id > 0 group by lc2.morreu_guild_id) lc2', 'g.guild_id = lc2.morreu_guild_id', 'LEFT', NULL);
        $this->db->join('(SELECT SUM(level) as pontos, owner FROM competitivo_territorios lt group by lt.owner) lt', 'g.guild_id = lt.owner', 'LEFT', NULL);
        $this->db->where('g.guild_id >', "0");
        $this->db->group_by('g.guild_id');
        $this->db->order_by("pontos", 'DESC');
        $this->db->order_by("pontosgvg", 'DESC');
        $this->db->limit($this->config->item("limiterankinglistaclan"), 0);
        $query = $this->db->get();
        return $query->result();
    }

    function get_personagem_kills($charid)
    {
        $this->db->select('p.*, g.*, morreu_id, count(matou_id) as matou');
        $this->db->from('competitivo_pvp c');
        $this->db->join('competitivo_personagens p', 'p.charid = c.morreu_id', 'left');
        $this->db->join('competitivo_guilds g', 'g.guild_id = p.guild_id', 'left');
        $this->db->where('c.matou_id', $charid);
        $this->db->group_by('c.morreu_id');
        $query = $this->db->get("");
        return $query->result();
    }

    function get_personagem_killsng($charid)
    {
        $this->db->select('c.id, p.*, g.*, c.morreu_id, c.data');
        $this->db->from('competitivo_pvp c');
        $this->db->join('competitivo_personagens p', 'p.charid = c.morreu_id', 'left');
        $this->db->join('competitivo_guilds g', 'g.guild_id = p.guild_id', 'left');
        $this->db->where('c.matou_id', $charid);
        $query = $this->db->get("");
        return $query->result();
    }

    function get_personagem_deaths($charid)
    {
        $this->db->select('p.*, g.*, morreu_id, count(matou_id) as matou');
        $this->db->from('competitivo_pvp c');
        $this->db->join('competitivo_personagens p', 'p.charid = c.matou_id', 'left');
        $this->db->join('competitivo_guilds g', 'g.guild_id = p.guild_id', 'left');
        $this->db->where('c.morreu_id', $charid);
        $this->db->group_by('c.matou_id');
        $query = $this->db->get("");
        return $query->result();
    }

    function get_personagem_deathsng($charid)
    {
        $this->db->select('c.id, p.*, g.*, c.matou_id, c.data');
        $this->db->from('competitivo_pvp c');
        $this->db->join('competitivo_personagens p', 'p.charid = c.matou_id', 'left');
        $this->db->join('competitivo_guilds g', 'g.guild_id = p.guild_id', 'left');
        $this->db->where('c.morreu_id', $charid);
        $query = $this->db->get("");
        return $query->result();
    }

    function get_itens($array_itens)
    {
        $this->db->where_in('id', $array_itens);
        $query = $this->db->get('itens');
        $itens = $query->result();
        return $query->result();
    }

    function get_clan($clanid)
    {
        $this->db->select('g.*, p.*, t.territorios, COALESCE(Lt.pontos,0)*1 as pontos');
        $this->db->from('competitivo_guilds g');
        $this->db->join('competitivo_personagens p', 'g.master = p.charid', 'left');
        $this->db->join('(SELECT t.owner, t.color, count(*) as territorios FROM competitivo_territorios t group by owner, color) t', 't.owner = g.guild_id', 'LEFT', NULL);
        $this->db->join('(SELECT SUM(level) as pontos, owner FROM competitivo_territorios Lt group by Lt.owner) Lt', 't.owner = g.guild_id', 'LEFT', NULL);
        $this->db->where('g.guild_id', $clanid);
        $query = $this->db->get("");
        return $query->row();
    }

    function get_membros_clan($clanid)
    {
        $this->db->select('p.charid, p.guild_id, p.classe, p.nome, COALESCE(Lc.kills,0) as kills , COALESCE(Lc2.deaths,0) as deaths, COALESCE(Lc.kills,0)* ' . $this->config->item("pontosmatarpvp") . ' - COALESCE(Lc2.deaths,0)* ' . $this->config->item("pontosmorrerpvp") . ' as pontos');
        $this->db->from('competitivo_personagens p');
        $this->db->join('(SELECT Lc.matou_id, count(*) as kills FROM competitivo_pvp Lc group by Lc.matou_id) Lc', 'p.charid = Lc.matou_id', 'LEFT', NULL);
        $this->db->join('(SELECT Lc.morreu_id, count(*) as deaths FROM competitivo_pvp Lc group by Lc.morreu_id) Lc2', 'p.charid = Lc2.morreu_id', 'LEFT', NULL);
        $this->db->where('p.guild_id', $clanid);
        $this->db->group_by('p.charid');
        $this->db->order_by("pontos", 'DESC');
        $query = $this->db->get("");
        return $query->result();
    }

    function get_territorios_clan($clanid)
    {
        $this->db->select('t.*, g.*');
        $this->db->from('competitivo_territorios t');
        $this->db->join('competitivo_guilds g', 't.owner = g.guild_id', 'left');
        $this->db->where('t.owner', $clanid);
        $query = $this->db->get("");
        return $query->result();
    }

    function get_bloqueios()
    {
        $this->db->select('b.*, b.charid as bloqueioid, p.*');
        $this->db->from('competitivo_bloqueio b');
        $this->db->join('competitivo_personagens p', 'b.charid = p.charid', 'left');
        $query = $this->db->get("");
        return $query->result();
    }

    function salvarbloqueiocompetitivo()
    {
        $this->db->where('charid', $this->input->post('charid', TRUE));
        $query = $this->db->get("competitivo_bloqueio");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            $this->db->set('charid', $this->input->post('charid', TRUE));
            $this->db->set('databloqueio', 'NOW()', FALSE);
            $this->db->insert('competitivo_bloqueio');
            return ($this->db->affected_rows() != 1 ? false : $this->db->insert_id());
        }
    }

    function deletar_bloqueio($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('competitivo_bloqueio');
        return ($this->db->affected_rows() != 1 ? false : true);
    }

    function bulk_delete_bloqueio($ids)
    {
        $this->db->where_in('id', $ids);
        $this->db->delete('competitivo_bloqueio');
        return ($this->db->affected_rows() > 0 ? true : false);
    }

    function deletar_kill($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('competitivo_pvp');
        return ($this->db->affected_rows() != 1 ? false : true);
    }

    function bulk_delete_kills($ids)
    {
        $this->db->where_in('id', $ids);
        $this->db->delete('competitivo_pvp');
        return ($this->db->affected_rows() > 0 ? true : false);
    }

    function get_personagem_bloqueio($charid)
    {
        $this->db->where('charid', $charid);
        $query = $this->db->get('competitivo_bloqueio');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_mensagens()
    {
        $query = $this->db->get("competitivo_mensagens");
        return $query->result();
    }

    function get_mensagem($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get("competitivo_mensagens");
        return $query->row();
    }

    function salvarmensagem($id = null)
    {
        $this->db->set('mensagem', $this->input->post('texto', TRUE));
        if (!is_null($id)) {
            $this->db->where('id', $id);
            $this->db->update('competitivo_mensagens');
        } else {
            $this->db->insert('competitivo_mensagens');
        }
        return ($this->db->affected_rows() != 1 ? false : true);
    }

    function deletar_mensagem($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('competitivo_mensagens');
        return ($this->db->affected_rows() != 1 ? false : true);
    }

    function bulk_delete_mensagens($ids)
    {
        $this->db->where_in('id', $ids);
        $this->db->delete('competitivo_mensagens');
        return ($this->db->affected_rows() > 0 ? true : false);
    }

    function get_updatestw()
    {
        $query = $this->db->get("updatetw");
        return $query->result();
    }

    function get_updatetw($id)
    {
        $this->db->where('id', $id);

        $query = $this->db->get("updatetw");
        return $query->row();
    }

    function salvarupdatetw($id = null)
    {
        $periodicidade = $this->input->post('minutos', TRUE) . " " .
            $this->input->post('horas', TRUE) . " " .
            $this->input->post('dias', TRUE) . " " .
            $this->input->post('meses', TRUE) . " " .
            $this->input->post('diassemana', TRUE);
        $this->db->set('periodicidade', $periodicidade);
        if (!is_null($id)) {
            $this->db->where('id', $id);
            $this->db->update('updatetw');
        } else {
            $this->db->insert('updatetw');
        }
        return ($this->db->affected_rows() != 1 ? false : true);
    }

    function bulk_delete_updatetw($ids)
    {
        $this->db->where_in('id', $ids);
        $this->db->delete('updatetw');
        return ($this->db->affected_rows() > 0 ? true : false);
    }

    function deletar_updatetw($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('updatetw');
        return ($this->db->affected_rows() != 1 ? false : true);
    }

    function get_updatespve()
    {
        $query = $this->db->get("updatepve");
        return $query->result();
    }

    function get_updatepve($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get("updatepve");
        return $query->row();
    }

    function salvarupdatepve($id = null)
    {
        $periodicidade = $this->input->post('minutos', TRUE) . " " .
            $this->input->post('horas', TRUE) . " " .
            $this->input->post('dias', TRUE) . " " .
            $this->input->post('meses', TRUE) . " " .
            $this->input->post('diassemana', TRUE);
        $this->db->set('periodicidade', $periodicidade);
        if (!is_null($id)) {
            $this->db->where('id', $id);
            $this->db->update('updatepve');
        } else {
            $this->db->insert('updatepve');
        }
        return ($this->db->affected_rows() != 1 ? false : true);
    }

    function bulk_delete_updatepve($ids)
    {
        $this->db->where_in('id', $ids);
        $this->db->delete('updatepve');
        return ($this->db->affected_rows() > 0 ? true : false);
    }

    function deletar_updatepve($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('updatepve');
        return ($this->db->affected_rows() != 1 ? false : true);
    }

    function get_itens_pvp()
    {
        $query = $this->db->get("itenspvp");
        return $query->result();
    }

    function get_item($itemid)
    {
        $this->db->where('id', $itemid);
        $query = $this->db->get("itens");
        return $query->row();
    }

    function salvaritempvp($id = null)
    {
        $this->db->set('nome', $this->input->post('nome', TRUE));
        $this->db->set('itemid', $this->input->post('itemid', TRUE));
        $this->db->set('pontossaque', $this->input->post('pontossaque', TRUE));
        $this->db->set('pos', $this->input->post('pos', TRUE));
        $this->db->set('count', $this->input->post('count', TRUE));
        $this->db->set('max_count', $this->input->post('max_count', TRUE));
        $this->db->set('data', $this->input->post('data', TRUE));
        $this->db->set('proctype', $this->input->post('proctype', TRUE));
        $this->db->set('expire_date', $this->input->post('expire_date', TRUE));
        $this->db->set('guid1', $this->input->post('guid1', TRUE));
        $this->db->set('guid2', $this->input->post('guid2', TRUE));
        $this->db->set('mask', $this->input->post('mask', TRUE));
        if (!is_null($id)) {
            $this->db->where('id', $id);
            $this->db->update('itenspvp');
            return ($this->db->affected_rows() != 1 ? false : true);
        } else {
            $this->db->insert('itenspvp');
            return ($this->db->affected_rows() != 1 ? false : true);
        }
    }

    function deletar_itempvp($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('itenspvp');
        return ($this->db->affected_rows() != 1 ? false : true);
    }

    function bulk_delete_itenspvp($ids)
    {
        $this->db->where_in('id', $ids);
        $this->db->delete('itenspvp');
        return ($this->db->affected_rows() > 0 ? true : false);
    }

    function get_itempvp($itemid)
    {
        $this->db->where('id', $itemid);
        $query = $this->db->get("itenspvp");
        return $query->row();
    }

    function get_trocas_pvp($charid)
    {
        $this->db->where('charid', $charid);
        $query = $this->db->get("saque_itens_pvp");
        return $query->result();
    }

    function deletar_troca($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('saque_itens_pvp');
        return ($this->db->affected_rows() != 1 ? false : true);
    }

    function bulk_delete_trocas($ids)
    {
        $this->db->where_in('id', $ids);
        $this->db->delete('saque_itens_pvp');
        return ($this->db->affected_rows() > 0 ? true : false);
    }

    function get_scriptgolds()
    {
        $query = $this->db->get("scriptgolds");
        return $query->result();
    }

    function get_scriptgold($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get("scriptgolds");
        return $query->row();
    }

    function salvarscriptgold($id = null)
    {
        $periodicidade = $this->input->post('minutos', TRUE) . " " .
            $this->input->post('horas', TRUE) . " " .
            $this->input->post('dias', TRUE) . " " .
            $this->input->post('meses', TRUE) . " " .
            $this->input->post('diassemana', TRUE);
        $this->db->set('periodicidade', $periodicidade);
        $this->db->set('levelminimo', $this->input->post('levelminimo', TRUE));
        $this->db->set('cultivominimo', $this->input->post('cultivominimo', TRUE));
        $this->db->set('unicoip', ($this->input->post('unicoip', TRUE) == 'on' ? 1 : 0));
        $this->db->set('estaronline', ($this->input->post('estaronline', TRUE) == 'on' ? 1 : 0));
        $this->db->set('unicoconta', ($this->input->post('unicoconta', TRUE) == 'on' ? 1 : 0));
        $this->db->set('usarrankingpve', ($this->input->post('unicoconta', TRUE) == 'on' ? 1 : 0));
        $this->db->set('entregarviaapi', ($this->input->post('unicoconta', TRUE) == 'on' ? 1 : 0));
        $this->db->set('quantidade', $this->input->post('quantidade', TRUE));
        if (!is_null($id)) {
            $this->db->where('id', $id);
            $this->db->update('scriptgolds');
        } else {
            $this->db->insert('scriptgolds');
        }
        return ($this->db->affected_rows() != 1 ? false : true);
    }

    function deletarScriptGold($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('scriptgolds');
        return ($this->db->affected_rows() != 1 ? false : true);
    }

    function bulkDeleteScriptGolds($ids)
    {
        $this->db->where_in('id', $ids);
        $this->db->delete('scriptgolds');
        return ($this->db->affected_rows() > 0 ? true : false);
    }

}
