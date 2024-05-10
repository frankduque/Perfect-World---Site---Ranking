<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Description of Competitivo
 *
 * @property Competitivo_pvp_model $Competitivo_pvp
 * @property Competitivo_personagem_model $Personagem
 * @property Visitas_model $Visitas_model
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Config $config

 */

class Competitivo extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Competitivo_pvp_model", "Competitivo_pvp");
        $this->load->model("Competitivo_personagem_model", "Personagem");
        $this->load->model("Itens_model", "Itens");
        $this->load->model("Visitas_model");
        $this->load->helper('guilds');

    }

    public function index()
    {
        $this->loadview('competitivo');
    }

    public function pvp()
    {

        $periodo = $this->input->get('periodo');
        $classes = $this->input->get('classes');
        if (empty($periodo)) {
            $periodo = "geral";
        }
        if (isset($classe) && $classe < 0) {
            $classes = "todas";
        }
        $dados['icones'] = get_guild_icons();
        $dados['periodo'] = $periodo;
        $dados['classes'] = $classes;

        $this->loadview('pvp', $dados);

    }



    public function ajax_list_pvp()
    {

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];
        $periodo = $this->input->get('periodo');
        $periodo = isset($periodo) ? $periodo : 'geral';
        $classes = $this->input->get('classes');
        $query = array();
        if ($search) {
            $query['search'] = array(
                'nome' => $search,
                'charid' => $search,
                'userid' => $search,
                'guild_nome' => $search
            );
        }

        $query['order'] = array(
            'pontos' => 'desc'
        );

        $query['limit'] = array(
            'length' => $length,
            'start' => $start
        );

        $query['classe'] = $classes;
        $icons = get_guild_icons();
        $resultado = $this->Competitivo_pvp->get_ranking($query, $periodo);
        foreach ($resultado as $key => $value) {
            $resultado[$key]->classe = $this->config->item('id2classe')[$value->classe];
            $resultado[$key]->posicao = $start + $key + 1;
            $resultado[$key]->guild_icon = get_guild_icon($icons, $value->guild_id);
        }

        if ($search) {
            $total = count($this->Competitivo_pvp->get_ranking(['search' => $query['search']]));
            $total_geral = count($this->Competitivo_pvp->get_ranking());
        } else {
            $total = count($this->Competitivo_pvp->get_ranking());
            $total_geral = count($this->Competitivo_pvp->get_ranking());
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $total_geral,
            "recordsFiltered" => $total,
            "data" => $resultado
        );

        echo json_encode($output);

    }

    public function pve()
    {
        if ($this->config->item("usarpve") == 1) {

            $classes = $this->input->get('classes');

            if (isset($classe) && $classe < 0) {
                $classes = "todas";
            }
            $dados['icones'] = get_guild_icons();
            $dados['classes'] = $classes;

            $this->loadview('pve', $dados);
        } else {
            redirect(base_url("competitivo"));
        }

    }

    public function ajax_list_pve()
    {

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];
        $query = array();
        if ($search) {
            $query['search'] = array(
                'nome' => $search,
                'charid' => $search,
                'userid' => $search,
                'guild_nome' => $search
            );
        }

        $query['order'] = array(
            'p.level' => 'desc',
            'reputacao' => 'desc',
            'exp' => 'desc'
        );

        $query['limit'] = array(
            'length' => $length,
            'start' => $start
        );
        $icons = get_guild_icons();

        $resultado = $this->Personagem->get_ranking($query);
        foreach ($resultado as $key => $value) {
            $resultado[$key]->classe = $this->config->item('id2classe')[$value->classe];
            $resultado[$key]->cultivo = $this->config->item('id2cultivo')[$value->cultivo];
            $resultado[$key]->posicao = $start + $key + 1;
            $resultado[$key]->guild_icon = get_guild_icon($icons, $value->guild_id);
        }

        if ($search) {
            $total = $this->Personagem->get_ranking(['search' => $query['search']]);

        } else {
            $total = $this->Personagem->count_all();

        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Personagem->count_all(),
            "recordsFiltered" => $total,
            "data" => $resultado
        );

        echo json_encode($output);

    }

    public function gvg($periodo = "geral")
    {
        if ($this->config->item("usargvg") == 1) {

            switch ($periodo) {
                case "geral":
                case "atual":
                case "1":
                case "2":
                case "3":
                    break;
                default:
                    $periodo = 'geral';
                    break;
            }
            $dados['ranking'] = $this->Competitivo_pvp->get_rank_gvg($periodo);
            $dados["periodo"] = $periodo;
            $this->loadview('gvg', $dados);
        } else {
            redirect(base_url("competitivo"));
        }
    }

    public function tw()
    {
        if ($this->config->item("usartw") == 1) {
            $dados['icones'] = get_guild_icons();
            $dados['ranking'] = $this->Competitivo_pvp->get_rank_tw();
            $dados['territorios'] = $this->Competitivo_pvp->get_territorios();
            $this->loadview('tw', $dados);
        } else {
            redirect(base_url("competitivo"));
        }
    }

    public function clans()
    {
        if ($this->config->item("usarlistaclans") == 1) {
            $dados['icones'] = get_guild_icons();
            $dados['ranking'] = $this->Competitivo_pvp->get_rank_clans();
            $this->loadview('clans', $dados);
        } else {
            redirect(base_url("competitivo"));
        }
    }

    public function personagem($charid = null)
    {
        if (is_null($charid)) {
            redirect(base_url("pvp"));
        } else {
            $dados['personagem'] = $this->Personagem->get_details($charid);
            if (empty($dados['personagem']) or is_null($dados['personagem'])) {
                redirect(base_url("pvp"));
            } else {
                $dados['icones'] = get_guild_icons();
                $dados['kills'] = $this->Competitivo_pvp->get_grouped_kills($charid);
                $dados['deaths'] = $this->Competitivo_pvp->get_grouped_deaths($charid);
                $equipamentos = json_decode($dados['personagem']->equipamentos);
                if (isset($equipamentos)) {
                    foreach ($equipamentos as $equipe) {
                        $dados['equipamentos'][$equipe->pos] = $equipe;
                        $array_itens[] = $equipe->id;
                    }
                    $itens = $this->Itens->get_itens($array_itens);
                    foreach ($itens as $item) {
                        $dados['itens'][$item->itemid] = $item;
                    }
                }
                $this->loadview('personagem', $dados);
            }
        }
    }

    public function clan($clanid = null)
    {
        if (is_null($clanid)) {
            redirect(base_url("competitivo/clans"));
        } else {
            $dados['clan'] = $this->Competitivo_pvp->get_clan($clanid);
            if (empty($dados['clan']) or is_null($dados['clan'])) {
                redirect(base_url("competitivo/clans"));
            } else {
                $dados['icones'] = get_guild_icons();
                $territorios = $this->Competitivo_pvp->get_territorios_clan($clanid);
                if (!empty($territorios)) {
                    foreach ($territorios as $territorio) {
                        $dados['territorios'][$territorio->id] = $territorio;
                    }
                } else {
                    $dados['territorios'] = array();
                }
                $dados['membros'] = $this->Competitivo_pvp->get_membros_clan($clanid);
                $this->loadview('clan', $dados);
            }
        }
    }

    public function loadview($pagina, $data = null)
    {
        $data['pagina'] = $pagina;
        $this->Visitas_model->insert_visita($pagina);
        $this->load->view('site/header', $data);
        $this->load->view('site/competitivo/' . $pagina, $data);
        $this->load->view('site/footer', $data);
    }

}
