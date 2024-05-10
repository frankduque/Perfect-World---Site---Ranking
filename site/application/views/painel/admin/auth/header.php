<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $this->config->item("nomeservidor") ?></title>
    <!-- Fonts -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/upload/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <!-- CSS Files -->
    <link href="<?php echo base_url('assets/painel/css/argon-dashboard.min.css?v=1.1.0') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/painel/css/custom.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/fontawesome/css/all.css') ?>" rel="stylesheet" />
  </head> 
  <body class="bg-default">
    <div class="main-content">
      <!-- Navbar -->
      <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
        <div class="container p-5">
          <a class="navbar-brand" href="<?php echo base_url() ?>" target="_blank">
            <img style="height:170px;" src="<?php echo base_url() ?>assets/upload/logo.<?php echo $this->config->item("extlogo") . "?v=" . $this->config->item("vlogo") ?>" /> 
          </a>
        </div>
      </nav>