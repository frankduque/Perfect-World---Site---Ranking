<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?= $this->config->item("nomeservidor") ?></title>
  <!-- Favicon -->
  <link rel="shortcut icon"
    href="<?php echo base_url() ?>assets/upload/favicon.<?php echo $this->config->item("extfavicon") . "?v=" . $this->config->item("vfavicon") ?>"
    type="image/x-icon">
  <!-- Google Fonts -->
  <!-- Font Awesome CSS -->
  <!-- Bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- Style -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Cabin:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url("assets/fontawesome/css/all.css") ?>" />
  <!-- Add the slick-theme.css if you want default styling -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <!-- Add the slick-theme.css if you want default styling -->
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url("assets/plugins/DataTables/datatables.min.css") ?>" />
  <link rel="stylesheet" href="<?= base_url("assets/plugins/DataTables/responsive.dataTables.css") ?>" />
  <link rel="stylesheet" href="<?= base_url("assets/site/css/style.css") ?>" />
  <link href="<?= base_url() ?>assets/site/css/ranking.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/site/css/personagem.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <?php
  if ($this->config->item("usarmailchimp") == 1 and !is_null($this->config->item("mailchimpcode")) and !empty($this->config->item("mailchimpcode"))) {
    echo $this->config->item("mailchimpcode");
  }
  ?>
  <?php if ($this->config->item("usaranalytics") == 1 and !is_null($this->config->item("analyticsid")) and !empty($this->config->item("analyticsid"))): ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $this->config->item("analyticsid") ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());

      gtag('config', '<?= $this->config->item("analyticsid") ?>');
    </script>
  <?php endif; ?>

  </body>

</head>

<body>
  <?php if ($this->config->item("usarfacebook") == 1 and !is_null($this->config->item("linkpaginafacebook")) and !empty($this->config->item("linkpaginafacebook")) and $pagina == "noticias"): ?>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
      src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v5.0&appId=1698587130211381&autoLogAppEvents=1"></script>
  <?php endif; ?>
  <!-- PRELOADER START -->
  <div class="loader-wrapper">
    <img class="imgloader"
      src="<?= base_url("assets/upload/logo.") . $this->config->item("extlogo") . "?v=" . $this->config->item("vlogo") ?>"
      alt="<?= $this->config->item("nomeservidor"); ?>">
    <div class='cssload-loader'>
      <div class='cssload-inner cssload-one'></div>
      <div class='cssload-inner cssload-two'></div>
      <div class='cssload-inner cssload-three'></div>
    </div>
  </div>
  <!-- PRELOADER END -->
  <nav class="navbar navbar-expand-lg navbar-dark">

    <a class="navbar-brand" href="<?= base_url() ?>">
      <img
        src="<?= base_url() ?>assets/upload/logo.<?= $this->config->item("extlogo") . "?v=" . $this->config->item("vlogo") ?>"
        alt="<?= $this->config->item("nomeservidor") ?>">
    </a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item px-2 <?= ($pagina == "index" ? "active" : "") ?>">
          <a class="nav-link" href="<?= base_url() ?>">Início</a>
        </li>
        <li
          class="nav-item px-2 dropdown <?= (in_array($pagina, ['racas', 'humanos', 'Selvagens', 'Alados', 'Abissais', 'Guardiões', 'Sombrios']) ? "active" : "") ?>">
          <a class="nav-link dropdown-toggle" href="<?= base_url("racas") ?>" id="dropdownracas" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Raças
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownracas">
            <a class="dropdown-item py-3" href="<?= base_url("racas/humanos") ?>">Humanos</a>
            <a class="dropdown-item py-3" href="<?= base_url("racas/selvagens") ?>">Selvagens</a>
            <a class="dropdown-item py-3" href="<?= base_url("racas/alados") ?>">Alados</a>
            <?php if ($this->config->item("versaoservidor") >= 142): ?>
              <a class="dropdown-item py-3" href="<?= base_url("racas/abissais") ?>">Abissais</a>
            <?php endif; ?>
            <?php if ($this->config->item("versaoservidor") >= 144): ?>
              <a class="dropdown-item py-3" href="<?= base_url("racas/guardioes") ?>">Guardiões</a>
            <?php endif; ?>
            <?php if ($this->config->item("versaoservidor") >= 153): ?>
              <a class="dropdown-item py-3" href="<?= base_url("racas/sombrios") ?>">Sombrios</a>
            <?php endif; ?>

          </div>
        </li>
        <li class="nav-item px-2 dropdown <?= (in_array($pagina, ['competitivo', 'pvp', 'tw']) ? "active" : "") ?>">
          <a class="nav-link dropdown-toggle" href="<?= base_url("competitivo") ?>" id="dropdowncompetitivo"
            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Competitivo
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdowncompetitivo">
            <?php if ($this->config->item("usartw") == 1): ?>
              <a class="dropdown-item py-3" href="<?= base_url("competitivo/tw") ?>">Guerras Territoriais</a>
            <?php endif; ?>
            <?php if ($this->config->item("usarpvp") == 1): ?>
              <a class="dropdown-item py-3" href="<?= base_url("competitivo/pvp") ?>">Ranking PVP</a>
            <?php endif; ?>
            <?php if ($this->config->item("usarpve") == 1): ?>
              <a class="dropdown-item py-3" href="<?= base_url("competitivo/pve") ?>">Ranking PVE</a>
            <?php endif; ?>
            <?php if ($this->config->item("usargvg") == 1): ?>
              <a class="dropdown-item py-3" href="<?= base_url("competitivo/gvg") ?>">Ranking GVG</a>
            <?php endif; ?>
            <?php if ($this->config->item("usarlistaclans") == 1): ?>
              <a class="dropdown-item py-3" href="<?= base_url("competitivo/clans") ?>">Ranking de Clans</a>
            <?php endif; ?>

          </div>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link" href="<?= base_url("downloads") ?>">Downloads</a>
        </li>
        <li class="nav-item px-2 dropdown <?= (in_array($pagina, ['competitivo', 'pvp', 'tw']) ? "active" : "") ?>">
          <a class="nav-link dropdown-toggle" href="<?= base_url("informacoes") ?>" id="dropdowninfo" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Informações
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdowninfo">
            <a class="dropdown-item py-3" href="<?= base_url("noticias") ?>">Noticias</a>
            <a class="dropdown-item py-3" href="<?= base_url("informacoes/servidor") ?>">Sobre o Servidor</a>
            <a class="dropdown-item py-3" href="<?= base_url("informacoes/tutoriais") ?>">Tutoriais</a>
            <a class="dropdown-item py-3" href="<?= base_url("informacoes/eventos") ?>">Eventos</a>
          </div>
        </li>
        <!-- <li class="nav-item px-2 dropdown">
          <a class="nav-link dropdown-toggle" href="<?= base_url("noticias") ?>" id="dropdownsearch" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-search color-white fa-2x"></i>
          </a>
          <div class="dropdown-menu ">
            <form class="search-content" method="get" action="<?= base_url("noticias") ?>">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>">
              <input type="text" class="form-control" id="inputpesquisa" name="chavepesquisa" placeholder="Pesquisa">
              <button type="submit" class="btn btn-primary"><i class="fa fa-search color-white fa-2x"></i></button>
            </form>
          </div>
        </li> -->
      </ul>

    </div>
    <a href="<?= $this->config->item("linkpainel") ?>" class="btn header-btn ml25 color-white hidden-sm hidden-xs">
      Jogar Agora
    </a>
  </nav>