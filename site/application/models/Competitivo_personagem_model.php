<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once (APPPATH . "models/Crud_model.php");

class Competitivo_personagem_model extends Crud_Model
{

    protected $table = "competitivo_personagens";

    public function __construct()
    {
        parent::__construct($this->table);

    }

    function get_details($charid)
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

    function get_ranking($query = array())
    {
        $this->db->select('
        p.charid, p.userid, p.nome, p.level, p.classe, p.cultivo, p.guild_id, p.reputacao,
        IF(b.charid IS NOT NULL, 1, 0) AS bloqueado, 
        g.guild_nome, g.guild_id,
        ');
        $this->db->from('competitivo_personagens p');
        $this->db->join('competitivo_guilds g', 'p.guild_id = g.guild_id', 'left');
        $this->db->join('competitivo_bloqueio b', 'b.charid = p.charid', 'left');
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
        $query = $this->db->get("");
   
        return $query->result();
    }


}
