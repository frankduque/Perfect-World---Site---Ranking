<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- PAGE NAME START -->
<section class="page-name page-classes parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Classes
      </h1>
    </div>
  </div>
</section>
<!-- PAGE NAME END -->
<!-- TEAM START -->
<section class="team-bl ptb150">
  <div class="container">
    <div class="row">
      <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
        <a href="<?= base_url("classes/guerreiro") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
          <div class="border-img">
            <img src="<?= base_url() ?>assets/site/img/classe-guerreiro.png" alt="" class="img-responsive">
          </div>
          <div class="text-container background-4 text-center">
            Guerreiro
          </div>
        </a>
      </div>
      <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
        <a href="<?= base_url("classes/mago") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
          <div class="border-img">
            <img src="<?= base_url() ?>assets/site/img/classe-mago.png" alt="" class="img-responsive">
          </div>
          <div class="text-container background-4 text-center">
            Mago
          </div>
        </a>
      </div>
      <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
        <a href="<?= base_url("classes/barbaro") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
          <div class="border-img">
            <img src="<?= base_url() ?>assets/site/img/classe-barbaro.png" alt="" class="img-responsive">
          </div>
          <div class="text-container background-4 text-center">
            Barbaro
          </div>
        </a>
      </div>
      <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
        <a href="<?= base_url("classes/feiticeira") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
          <div class="border-img">
            <img src="<?= base_url() ?>assets/site/img/classe-feiticeira.png" alt="" class="img-responsive">
          </div>
          <div class="text-container background-4 text-center">
            Feiticeira
          </div>
        </a>
      </div>
      <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
        <a href="<?= base_url("classes/arqueiro") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
          <div class="border-img">
            <img src="<?= base_url() ?>assets/site/img/classe-arqueiro.png" alt="" class="img-responsive">
          </div>
          <div class="text-container background-4 text-center">
            Arqueiro
          </div>
        </a>
      </div>
      <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
        <a href="<?= base_url("classes/sacerdote") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
          <div class="border-img">
            <img src="<?= base_url() ?>assets/site/img/classe-sacerdote.png" alt="" class="img-responsive">
          </div>
          <div class="text-container background-4 text-center">
            Sacerdote
          </div>
        </a>
      </div>
      <?php if ($this->config->item("versaoservidor") >= 142): ?>

          <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
            <a href="<?= base_url("classes/mercenario") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
              <div class="border-img">
                <img src="<?= base_url() ?>assets/site/img/classe-mercenario.png" alt="" class="img-responsive">
              </div>
              <div class="text-container background-4 text-center">
                Mercenário
              </div>
            </a>
          </div>
      <?php endif; ?>
      <?php if ($this->config->item("versaoservidor") >= 142): ?>
          <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
            <a href="<?= base_url("classes/espiritualista") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
              <div class="border-img">
                <img src="<?= base_url() ?>assets/site/img/classe-espiritualista.png" alt="" class="img-responsive">
              </div>
              <div class="text-container background-4 text-center">
                Espiritualista
              </div>
            </a>
          </div>
      <?php endif; ?>
      <?php if ($this->config->item("versaoservidor") >= 144): ?>
          <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
            <a href="<?= base_url("classes/arcano") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
              <div class="border-img">
                <img src="<?= base_url() ?>assets/site/img/classe-arcano.png" alt="" class="img-responsive">
              </div>
              <div class="text-container background-4 text-center">
                Arcano
              </div>
            </a>
          </div>
      <?php endif; ?>
      <?php if ($this->config->item("versaoservidor") >= 144): ?>
          <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
            <a href="<?= base_url("classes/mistico") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
              <div class="border-img">
                <img src="<?= base_url() ?>assets/site/img/classe-mistico.png" alt="" class="img-responsive">
              </div>
              <div class="text-container background-4 text-center">
                Místico
              </div>
            </a>
          </div>
      <?php endif; ?>
      <?php if ($this->config->item("versaoservidor") >= 153): ?>
          <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
            <a href="<?= base_url("classes/retalhador") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
              <div class="border-img">
                <img src="<?= base_url() ?>assets/site/img/classe-retalhador.png" alt="" class="img-responsive">
              </div>
              <div class="text-container background-4 text-center">
                Retalhador
              </div>
            </a>
          </div>
      <?php endif; ?>
      <?php if ($this->config->item("versaoservidor") >= 153): ?>
          <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
            <a href="<?= base_url("classes/tormentador") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
              <div class="border-img">
                <img src="<?= base_url() ?>assets/site/img/classe-tormentador.png" alt="" class="img-responsive">
              </div>
              <div class="text-container background-4 text-center">
                Tormentador
              </div>
            </a>
          </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- TEAM END -->