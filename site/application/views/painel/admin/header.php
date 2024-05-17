<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="pt">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $this->config->item("nomeservidor") ?></title>
  <!-- Favicon -->
  <link rel="shortcut icon"
    href="<?php echo base_url() ?>assets/upload/favicon.<?php echo $this->config->item("extfavicon") . "?v=" . $this->config->item("vfavicon") ?>"
    type="image/x-icon">
  <!-- Fonts -->
  <!-- Icons -->
  <!-- CSS Files -->
  <link href="<?php echo base_url('assets/painel/css/argon-dashboard.min.css?v=1.1.0' . rand()) ?>" rel="stylesheet" />
  <link href="<?php echo base_url('assets/painel/css/custom.css') ?>" rel="stylesheet" />
  <link href="<?php echo base_url('assets/fontawesome/css/all.css') ?>" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="<?php echo base_url('assets/painel/css/font/font-fileuploader.css') ?>" rel="stylesheet">
  <!-- css -->
  <link href="<?php echo base_url('assets/painel/css/jquery.fileuploader.min.css') ?>" rel="stylesheet">
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/sl-1.3.1/datatables.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
        aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="<?php echo base_url('admin') ?>">
        <img
          src="<?php echo base_url() ?>assets/upload/logo.<?php echo $this->config->item("extlogo") . "?v=" . $this->config->item("vlogo") ?>"
          style="max-height: 5rem;" class="navbar-brand-img" alt="<?php echo $this->config->item("nomeservidor") ?>">
      </a>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a class="navbar-brand pt-0" href="<?php echo base_url('admin') ?>">
                <img
                  src="<?php echo base_url() ?>assets/upload/logo.<?php echo $this->config->item("extlogo") . "?v=" . $this->config->item("vlogo") ?>">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Navigation -->
        <ul class="navbar-nav" id="sidebar">
          <?php
          $paginasDashboard = ['dashboard/index', 'dashboard/acessos', 'dashboard/downloads'];
          ?>
          <li class="nav-item <?php echo (in_array($pagina, $paginasDashboard) ? 'active' : '') ?>">
            <a class="nav-link <?php echo (in_array($pagina, $paginasDashboard) ? 'active' : '') ?> "
              href="<?php echo base_url("admin/dashboard") ?>">
              <i class="fas fa-tachometer-alt text-info"></i> Dashboard
            </a>
          </li>
          <?php if (in_array("Gerenciar Usuários", $this->session->permissoes) or in_array("Gerenciar Cargos", $this->session->permissoes)): ?>

            <?php
            $paginausuario = ['usuarios/index', 'usuarios/form'];
            $paginacargos = ['cargos/index', 'cargos/form'];
            $paginausuarios = array_merge($paginausuario, $paginacargos);
            ?>
            <li class="nav-item <?php echo (in_array($pagina, $paginausuarios) ? 'active' : '') ?>">
              <a class="nav-link <?php echo (in_array($pagina, $paginausuarios) ? 'active' : 'collapsed') ?>" href="#"
                data-toggle="collapse" data-target="#usuarios"
                aria-expanded="<?php echo (in_array($pagina, $paginausuarios) ? 'true' : 'false') ?>"
                aria-controls="configuracoes">
                <i class="fas fa-users text-info" aria-hidden="true"></i> Usuários
              </a>
            </li>
            <div id="usuarios" class="collapse <?php echo (in_array($pagina, $paginausuarios) ? 'show' : '') ?>"
              aria-labelledby="usuarios" data-parent="#sidebar" style="">
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo (in_array($pagina, $paginausuario) ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/usuarios') ?>">Usuários</a>
              </li>
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo (in_array($pagina, $paginacargos) ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/cargos') ?>">Cargos</a>
              </li>
            </div>
          <?php endif; ?>
          <?php if (in_array("Gerenciar Downloads", $this->session->permissoes)): ?>
            <?php
            $paginasDownloads = ['downloads/index', 'downloads/form'];
            ?>
            <li class="nav-item <?php echo (in_array($pagina, $paginasDownloads) ? 'active' : '') ?>">
              <a class="nav-link <?php echo (in_array($pagina, $paginasDownloads) ? 'active' : '') ?> "
                href="<?php echo base_url("admin/downloads") ?>">
                <i class="fas fa-download text-info"></i> Downloads
              </a>
            </li>
          <?php endif; ?>
          <?php if (in_array("Gerenciar Notícias", $this->session->permissoes)): ?>
            <?php
            $paginanoticia = ['noticias/index', 'noticias/form'];
            $paginacatnoticias = ['noticias/categorias'];
            $paginanoticias = array_merge($paginanoticia, $paginacatnoticias);
            ?>
            <li class="nav-item <?php echo (in_array($pagina, $paginanoticias) ? 'active' : '') ?>">
              <a class="nav-link <?php echo (in_array($pagina, $paginanoticias) ? 'active' : 'collapsed') ?>" href="#"
                data-toggle="collapse" data-target="#noticias"
                aria-expanded="<?php echo (in_array($pagina, $paginanoticias) ? 'true' : 'false') ?>"
                aria-controls="configuracoes">
                <i class="fas fa-newspaper text-info" aria-hidden="true"></i> Notícias
              </a>
            </li>
            <div id="noticias" class="collapse <?php echo (in_array($pagina, $paginanoticias) ? 'show' : '') ?>"
              aria-labelledby="noticias" data-parent="#sidebar" style="">
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo (in_array($pagina, $paginanoticia) ? 'text-info active' : '') ?> "
                  href="<?php echo base_url('admin/noticias') ?>">Notícias</a>
              </li>
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo (in_array($pagina, $paginacatnoticias) ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/noticias/categorias') ?>">Categorias</a>
              </li>
            </div>
          <?php endif; ?>
          <?php if (in_array("Gerenciar Tutoriais", $this->session->permissoes)): ?>
            <?php
            $paginatutorial = ['tutoriais/index', 'tutoriais/form'];
            $paginacattutoriais = ['tutoriais/categorias'];
            $paginatutoriais = array_merge($paginatutorial, $paginacattutoriais);
            ?>
            <li class="nav-item <?php echo (in_array($pagina, $paginatutoriais) ? 'active' : '') ?>">
              <a class="nav-link <?php echo (in_array($pagina, $paginatutoriais) ? 'active' : 'collapsed') ?>" href="#"
                data-toggle="collapse" data-target="#tutoriais"
                aria-expanded="<?php echo (in_array($pagina, $paginatutoriais) ? 'true' : 'false') ?>"
                aria-controls="configuracoes">
                <i class="fas fa-graduation-cap text-info" aria-hidden="true"></i> Tutoriais
              </a>
            </li>
            <div id="tutoriais" class="collapse <?php echo (in_array($pagina, $paginatutoriais) ? 'show' : '') ?>"
              aria-labelledby="tutoriais" data-parent="#sidebar" style="">
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo (in_array($pagina, $paginatutorial) ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/tutoriais') ?>">Tutoriais</a>
              </li>
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo (in_array($pagina, $paginacattutoriais) ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/tutoriais/categorias') ?>">Categorias</a>
              </li>
            </div>
          <?php endif; ?>
          <?php if (in_array("Gerenciar Eventos", $this->session->permissoes)): ?>
            <?php
            $paginaevento = ['eventos/index', 'eventos/form'];
            $paginacateventos = ['eventos/categorias'];
            $paginaeventos = array_merge($paginaevento, $paginacateventos);
            ?>
            <li class="nav-item <?php echo (in_array($pagina, $paginaeventos) ? 'active' : '') ?>">
              <a class="nav-link <?php echo (in_array($pagina, $paginaeventos) ? 'active' : 'collapsed') ?>" href="#"
                data-toggle="collapse" data-target="#eventos"
                aria-expanded="<?php echo (in_array($pagina, $paginaeventos) ? 'true' : 'false') ?>"
                aria-controls="configuracoes">
                <i class="fas fa-gifts text-info" aria-hidden="true"></i> Eventos
              </a>
            </li>
            <div id="eventos" class="collapse <?php echo (in_array($pagina, $paginaeventos) ? 'show' : '') ?>"
              aria-labelledby="eventos" data-parent="#sidebar" style="">
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo (in_array($pagina, $paginaevento) ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/eventos') ?>">Eventos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo (in_array($pagina, $paginacateventos) ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/eventos/categorias') ?>">Categorias</a>
              </li>
            </div>
          <?php endif; ?>
          <?php if (in_array("Gerenciar Itens", $this->session->permissoes)): ?>
            <?php
            $paginasItens = ['itens/index', 'itens/form'];
            ?>
            <li class="nav-item <?php echo (in_array($pagina, $paginasItens) ? 'active' : '') ?>">
              <a class="nav-link <?php echo (in_array($pagina, $paginasItens) ? 'active' : '') ?> "
                href="<?php echo base_url("admin/itens") ?>">
                <i class="fas fa-flask text-info"></i> Itens
              </a>
            </li>
          <?php endif; ?>

          <?php if (in_array("Gerenciar Ranking PVP", $this->session->permissoes)): ?>
            <?php
            $paginasPvp = ['competitivo/pvp/index', 'competitivo/pvp/detalhes'];
            $paginasMensagens = ['competitivo/pvp/mensagens', 'competitivo/pvp/form_mensagem'];
            $paginasTrocaItensPvp = ['competitivo/pvp/itens', 'competitivo/pvp/form_item'];
            $paginaRelatorioTrocas = ['competitivo/pvp/trocas'];
            $paginasCompetitivo = array_merge($paginasPvp, $paginasMensagens, $paginasTrocaItensPvp, $paginaRelatorioTrocas);
            ?>
            <li class="nav-item <?php echo (in_array($pagina, $paginasCompetitivo) ? 'active' : '') ?>">
              <a class="nav-link <?php echo (in_array($pagina, $paginasCompetitivo) ? 'active' : 'collapsed') ?>" href="#"
                data-toggle="collapse" data-target="#competitivo"
                aria-expanded="<?php echo (in_array($pagina, $paginasCompetitivo) ? 'true' : 'false') ?>"
                aria-controls="competitivo">
                <i class="fas fa-sitemap text-info"></i> Ranking PVP
              </a>
            </li>
            <div id="competitivo" class="collapse <?php echo (in_array($pagina, $paginasCompetitivo) ? 'show' : '') ?>"
              aria-labelledby="competitivo" data-parent="#sidebar" style="">
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo (in_array($pagina, $paginasPvp) ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/pvp') ?>">Ranking</a>
              </li>
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo (in_array($pagina, $paginasMensagens) ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/mensagens_pvp') ?>">Mensagens PVP</a>
              </li>
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo (in_array($pagina, $paginasTrocaItensPvp) ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/itens_pvp') ?>">Itens troca pvp</a>
              </li>
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo (in_array($pagina, $paginaRelatorioTrocas) ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/itens_pvp/trocas') ?>">Relatório de saques</a>
              </li>
            </div>
          <?php endif; ?>

          <?php if (in_array("Gerenciar Ranking PVE", $this->session->permissoes)): ?>
            <?php
            $paginaPve = ['competitivo/pve/index'];
            $paginasAtualizacaoPve = ['competitivo/pve/atualizacao', 'competitivo/pve/form'];
            $paginasPve = array_merge($paginaPve, $paginasAtualizacaoPve);
            ?>
            <li class="nav-item <?php echo (in_array($pagina, $paginasPve) ? 'active' : '') ?>">
              <a class="nav-link <?php echo (in_array($pagina, $paginasPve) ? 'active' : 'collapsed') ?>" href="#"
                data-toggle="collapse" data-target="#pve"
                aria-expanded="<?php echo (in_array($pagina, $paginasPve) ? 'true' : 'false') ?>" aria-controls="pve">
                <i class="fas fa-sitemap text-info"></i> Ranking PVE
              </a>
            </li>
            <div id="pve" class="collapse <?php echo (in_array($pagina, $paginasPve) ? 'show' : '') ?>"
              aria-labelledby="pve" data-parent="#sidebar" style="">
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo (in_array($pagina, $paginaPve) ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/pve') ?>">Ranking</a>
              </li>
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo (in_array($pagina, $paginasAtualizacaoPve) ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/pve/atualizacao') ?>">Atualização do Ranking</a>
              </li>

            </div>
          <?php endif; ?>
          <?php if (in_array("Gerenciar Ranking TW", $this->session->permissoes)):
            $paginasTw = ['competitivo/tw/index', 'competitivo/tw/form'];

            ?>
            <li class="nav-item <?php echo (in_array($pagina, $paginasTw) ? 'active' : '') ?>">
              <a class="nav-link <?php echo (in_array($pagina, $paginasTw) ? 'active' : '') ?> "
                href="<?php echo base_url("admin/tw") ?>">
                <i class="fas fa-landmark text-info"></i> TW
              </a>
            </li>
          <?php endif; ?>

          <?php if (in_array("Gerenciar Mensageiro", $this->session->permissoes)):
            $paginasMensageiro = ['mensageiro/index', 'mensageiro/form'];

            ?>
            <li class="nav-item <?php echo (in_array($pagina, $paginasMensageiro) ? 'active' : '') ?>">
              <a class="nav-link <?php echo (in_array($pagina, $paginasMensageiro) ? 'active' : '') ?> "
                href="<?php echo base_url("admin/mensageiro") ?>">
                <i class="fas fa-comment text-info"></i> Mensageiro
              </a>
            </li>
          <?php endif; ?>
          <?php if (in_array("Gerenciar Script Golds", $this->session->permissoes)):
            $paginasScriptGolds = ['scriptgolds/index', 'scriptgolds/form'];
            ?>
            <li class="nav-item <?php echo (in_array($pagina, $paginasScriptGolds) ? 'active' : '') ?>">
              <a class="nav-link <?php echo (in_array($pagina, $paginasScriptGolds) ? 'active' : '') ?>"
                href="<?php echo base_url("admin/scriptgolds") ?>">
                <i class="fas fa-coins text-info"></i> Script Golds
              </a>
            </li>
          <?php endif; ?>
          <?php if (in_array("Gerenciar Configurações", $this->session->permissoes)): ?>
            <?php $paginaconfiguracoes = ['configuracoes/gerais', 'configuracoes/integracoes', 'configuracoes/competitivo']; ?>
            <li class="nav-item <?php echo (in_array($pagina, $paginaconfiguracoes) ? 'active' : '') ?>">
              <a class="nav-link <?php echo (in_array($pagina, $paginaconfiguracoes) ? 'active' : 'collapsed') ?>"
                href="#" data-toggle="collapse" data-target="#configuracoes"
                aria-expanded="<?php echo (in_array($pagina, $paginaconfiguracoes) ? 'true' : 'false') ?>"
                aria-controls="configuracoes">
                <i class="fas fa-sliders-h text-info"></i> Configurações
              </a>
            </li>
            <div id="configuracoes" class="collapse <?php echo (in_array($pagina, $paginaconfiguracoes) ? 'show' : '') ?>"
              aria-labelledby="configuracoes" data-parent="#sidebar">
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo ($pagina == "configuracoes/gerais" ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/configuracoes/gerais') ?>">Gerais</a>
              </li>
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo ($pagina == "configuracoes/integracoes" ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/configuracoes/integracoes') ?>">Integrações</a>
              </li>
              <li class="nav-item">
                <a class="nav-link ml-4 <?php echo ($pagina == "configuracoes/competitivo" ? 'text-info active' : '') ?>"
                  href="<?php echo base_url('admin/configuracoes/competitivo') ?>">Competitivo</a>
              </li>
            </div>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/logout') ?>">
              <i class="text-danger fas fa-power-off"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <span
          class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block"><?php echo $this->config->item("nomeservidor") ?></span>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <div class="media align-items-center">
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $this->session->nome ?></span>
                </div>
              </div>
            </a>

            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <a href="<?php echo base_url('admin/logout') ?>" class="dropdown-item">
                <i class="fas fa-power-off"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->