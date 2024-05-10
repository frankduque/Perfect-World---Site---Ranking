<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Noticias
 *
 * @property Noticias_model $Noticias
 * @property Categoria_noticias_model $Categorias
 * @property Visitas_model $Visitas
 * @property CI_Config $config
 * @property CI_Loader $load
 * @property CI_Input $input
 */
class Noticias extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Noticias_model', 'Noticias');
        $this->load->model('Categoria_noticias_model', 'Categorias');

        $this->load->model("Visitas_model", "Visitas");
    }


    public function index($paginaatual = 1)
    {
        $this->Visitas->insert_visita("noticias");
        $data['chavepesquisa'] = $this->input->get("chavepesquisa");
        $data['paginaatual'] = $paginaatual;
        $data['categoria_id'] = $this->input->get("categoria_id");
        if (!isset($data['paginaatual']) or empty($data['paginaatual']) or $data['paginaatual'] < 1) {
            $data['paginaatual'] = 1;
        }
        $query = array(
            'chavepesquisa' => $data['chavepesquisa'],
            'categoria_id' => $data['categoria_id'],
            'paginaatual' => $data['paginaatual'],

        );
        $data['categorias'] = $this->Categorias->get_details();

        $query_noticias = $this->Noticias->get_details($query);
        unset($query['paginaatual']);
        $query_total = $this->Noticias->get_details($query);

        $data['noticias'] = $query_noticias;
        $data['nnoticias'] = count($query_noticias);
        $data['totalnoticias'] = $this->Noticias->get_all()->num_rows();
        $data['npaginas'] = ceil(count($query_total) / $this->config->item('noticiasppagina'));
        $data['postsdestaque'] = $this->Noticias->get_details(array('destaque' => true));
        $this->_loadview('noticias', $data);
    }

    public function noticia($id = null)
    {
        $this->Visitas->insert_visita("noticia/" . $id);
        if (is_null($id)) {
            redirect(base_url("noticias"));
        } else {
            $data['noticia'] = $this->Noticias->get_details(array('id' => $id))[0];

            if (is_null($data['noticia'])) {
                redirect(base_url("noticias"));
            } else {
                $data['noticiaanterior'] = $this->Noticias->get_next($id);
                $data['proximanoticia'] = $this->Noticias->get_previous($id);
       
                $this->_loadview('noticia', $data);
            }
        }
    }

    private function _loadview($pagina, $data = null)
    {
        $data['pagina'] = $pagina;
        $this->load->view('site/header', $data);
        $this->load->view('site/noticias/' . $pagina, $data);
        $this->load->view('site/footer');
    }

}
