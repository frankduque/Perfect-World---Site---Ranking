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

    function get_details($periodo = "geral", $classe = "todas", $limit = 0)
    {
        $this->db->select('IF(b.charid IS NOT NULL, 1, 0) AS bloqueado, c.matou_id, COALESCE(lc.kills,0) as kills, COALESCE(lc2.deaths,0) as deaths, COALESCE(lc.kills,0)* ' . $this->config->item("pontosmatarpvp") . ' - COALESCE(lc2.deaths,0)* ' . $this->config->item("pontosmorrerpvp") . ' as pontos, 
        p.nome, p.raca, p.classe, p.guild_id,
         g.*');
        $this->db->from('competitivo_pvp c');
        $this->db->join('(SELECT lc.matou_id, count(*) as kills FROM competitivo_pvp lc ' . ($periodo != "geral" ? ($periodo == "atual" ? "WHERE MONTH(`data`) = MONTH(CURDATE()) AND YEAR(`data`) = YEAR(CURDATE())" : "WHERE MONTH( data ) = MONTH( DATE_SUB(CURDATE(),INTERVAL " . $periodo . " MONTH )) AND YEAR( data ) = YEAR( DATE_SUB(CURDATE( ),INTERVAL " . $periodo . " MONTH ))") : "") . ' group by lc.matou_id) lc', 'c.matou_id = lc.matou_id', 'LEFT', NULL);
        $this->db->join('(SELECT lc2.morreu_id, count(*) as deaths FROM competitivo_pvp lc2 ' . ($periodo != "geral" ? ($periodo == "atual" ? "WHERE MONTH(`data`) = MONTH(CURDATE()) AND YEAR(`data`) = YEAR(CURDATE())" : "WHERE MONTH( data ) = MONTH( DATE_SUB(CURDATE(),INTERVAL " . $periodo . " MONTH )) AND YEAR( data ) = YEAR( DATE_SUB(CURDATE( ),INTERVAL " . $periodo . " MONTH ))") : "") . ' group by lc2.morreu_id) lc2', 'c.matou_id = lc2.morreu_id', 'LEFT', NULL);
        $this->db->join('competitivo_personagens p', 'p.charid = c.matou_id', 'left');
        $this->db->join('competitivo_guilds g', 'p.guild_id = g.guild_id', 'left');
        $this->db->join('competitivo_bloqueio b', 'b.charid = p.charid', 'left');

        ($classe != "todas" ? $this->db->where('p.classe', $this->config->item("classe2id")[$classe]) : "");

        $this->db->group_by('c.matou_id');
        $this->db->order_by("pontos", 'DESC');
        if ($limit) {
            $this->db->limit($limit, 0);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_ranking($query = array(), $periodo = 'geral')
    {

        $this->db->select('
       
        g.guild_id, g.guild_nome,
        COALESCE(deaths.deaths,0) as deaths,
        COALESCE(kills.kills,0) as kills,
        c.matou_guild_id, 
        p.charid, p.userid, p.nome, p.level, p.classe,
        IF(b.charid IS NOT NULL, 1, 0) AS bloqueado, 
        COALESCE(kills.kills,0)* ' . $this->config->item("pontosmatarpvp") . ' - COALESCE(deaths.deaths,0)* ' . $this->config->item("pontosmorrerpvp") . ' as pontos'
        );
        $this->db->from('competitivo_pvp c');
        $this->db->join('(
            SELECT kills.matou_id, count(*) as kills FROM competitivo_pvp kills ' . ($periodo != "geral" ? ($periodo == "atual" ? "WHERE MONTH(`data`) = MONTH(CURDATE()) AND YEAR(`data`) = YEAR(CURDATE())" : "WHERE MONTH( data ) = MONTH( DATE_SUB(CURDATE(),INTERVAL " . $periodo . " MONTH )) AND YEAR( data ) = YEAR( DATE_SUB(CURDATE( ),INTERVAL " . $periodo . " MONTH ))") : "") . ' group by matou_id) kills', 'c.matou_id = kills.matou_id', 'LEFT', NULL);
        $this->db->join('(SELECT deaths.morreu_id, count(*) as deaths FROM competitivo_pvp deaths ' . ($periodo != "geral" ? ($periodo == "atual" ? "WHERE MONTH(`data`) = MONTH(CURDATE()) AND YEAR(`data`) = YEAR(CURDATE())" : "WHERE MONTH( data ) = MONTH( DATE_SUB(CURDATE(),INTERVAL " . $periodo . " MONTH )) AND YEAR( data ) = YEAR( DATE_SUB(CURDATE( ),INTERVAL " . $periodo . " MONTH ))") : "") . ' group by deaths.morreu_id) deaths', 'c.matou_id = deaths.morreu_id', 'LEFT', NULL);
        $this->db->join('competitivo_guilds g', 'c.matou_guild_id = g.guild_id', 'left');
        $this->db->join('competitivo_personagens p', 'p.charid = c.matou_id', 'left');
        $this->db->join('competitivo_bloqueio b', 'b.charid = p.charid', 'left');

        $this->db->group_by('c.matou_id');


        if (isset($query['search'])) {
            $this->db->like('p.nome', $query['search']);
            $this->db->or_like('p.descricao', $query['search']);
            $this->db->or_like('p.itemid', $query['search']);
        }
        if (isset($query['order'])) {
            foreach ($query['order'] as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
        if (isset($query['limit'])) {
            $this->db->limit($query['limit']['length'], $query['limit']['start']);

        }
        if (isset($query['offset'])) {
            $this->db->offset($query['offset']);
        }


        if (isset($query['classe']) && $query['classe'] != "todas") {
            $this->db->where('p.classe', $query['classe']);
        }

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


    function get_territorios_clan($clanid)
    {
        $this->db->select('t.*, g.*');
        $this->db->from('competitivo_territorios t');
        $this->db->join('competitivo_guilds g', 't.owner = g.guild_id', 'left');
        $this->db->where('t.owner', $clanid);
        $query = $this->db->get("");
        return $query->result();
    }


    function personagem_bloqueado($charid)
    {
        $this->db->select('charid');
        $this->db->from('competitivo_bloqueio');
        $this->db->where('charid', $charid);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    function get_kills($charid)
    {
        $this->db->select('c.*,
        p.nome, p.classe, p.guild_id, p.raca,
        g.guild_nome, g.guild_id,
        IF(b.charid IS NOT NULL, 1, 0) AS bloqueado');
        $this->db->from('competitivo_pvp c');
        $this->db->join('competitivo_personagens p', 'p.charid = c.morreu_id', 'left');
        $this->db->join('competitivo_bloqueio b', 'b.charid = c.morreu_id', 'left');
        $this->db->join('competitivo_guilds g', 'p.guild_id = g.guild_id', 'left');
        $this->db->where('c.matou_id', $charid);
        $this->db->order_by("data", 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function get_grouped_kills($charid)
    {
        $this->db->select('c.*, count(*) as kills,
        p.nome, p.classe, p.guild_id, p.raca,
        g.guild_nome, g.guild_id,
        IF(b.charid IS NOT NULL, 1, 0) AS bloqueado');
        $this->db->from('competitivo_pvp c');
        $this->db->join('competitivo_personagens p', 'p.charid = c.morreu_id', 'left');
        $this->db->join('competitivo_bloqueio b', 'b.charid = c.morreu_id', 'left');
        $this->db->join('competitivo_guilds g', 'p.guild_id = g.guild_id', 'left');
        $this->db->where('c.matou_id', $charid);
        $this->db->group_by('c.morreu_id');
        $this->db->order_by("data", 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function get_grouped_deaths($charid)
    {
        $this->db->select('c.*, count(*) as deaths,
        p.nome, p.classe, p.guild_id, p.raca,
        g.guild_nome, g.guild_id,
        IF(b.charid IS NOT NULL, 1, 0) AS bloqueado');
        $this->db->from('competitivo_pvp c');
        $this->db->join('competitivo_personagens p', 'p.charid = c.matou_id', 'left');
        $this->db->join('competitivo_bloqueio b', 'b.charid = c.matou_id', 'left');
        $this->db->join('competitivo_guilds g', 'p.guild_id = g.guild_id', 'left');
        $this->db->where('c.morreu_id', $charid);
        $this->db->group_by('c.matou_id');
        $this->db->order_by("data", 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function get_deaths($charid)
    {
        $this->db->select('c.*, p.nome');
        $this->db->from('competitivo_pvp c');
        $this->db->join('competitivo_personagens p', 'p.charid = c.matou_id', 'left');
        $this->db->where('c.morreu_id', $charid);
        $this->db->order_by("data", 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function bloquear_personagem($charid)
    {
        $this->db->insert('competitivo_bloqueio', array('charid' => $charid));
        return $this->db->affected_rows();
    }

    function desbloquear_personagem($charid)
    {
        $this->db->delete('competitivo_bloqueio', array('charid' => $charid));
        return $this->db->affected_rows();
    }

}
