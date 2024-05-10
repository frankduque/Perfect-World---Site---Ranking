<!-- PAGE NAME START -->
<section class="page-name page-racas parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Raças
      </h1>
    </div>
  </div>
</section>
<!-- PAGE NAME END -->
<!-- TEAM START -->
<section class="team-bl ptb150">
  <div class="container">
    <div class="title-description mt30 mb40 fweight-300 text-center">
      O mundo de Perfect World é lar de diversas raças diferentes que lutam juntas para não<br> serem extintas pelas forças das trevas, e é uma dessas que você deverá escolher.<br> Decidir sua raça será o primeiro passo rumo a sua nova aventura, já que cada uma é dividida em duas classes diferentes.<br> Conheça um pouco mais sobre as raças presentes no jogo:
    </div>
    <div class="row">
      <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
        <a href="<?= base_url("racas/humanos") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
          <div class="border-img">
            <img src="<?= base_url() ?>assets/site/img/raca-humanos.png" alt="" class="img-responsive">
          </div>
          <div class="text-container background-4 text-center">
            Humanos
          </div>
        </a>
      </div>
      <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
        <a href="<?= base_url("racas/selvagens") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
          <div class="border-img">
            <img src="<?= base_url() ?>assets/site/img/raca-selvagens.png" alt="" class="img-responsive">
          </div>
          <div class="text-container background-4 text-center">
            Selvagens
          </div>
        </a>
      </div>
      <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
        <a href="<?= base_url("racas/alados") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
          <div class="border-img">
            <img src="<?= base_url() ?>assets/site/img/raca-alados.png" alt="" class="img-responsive">
          </div>
          <div class="text-container background-4 text-center">
            Alados
          </div>
        </a>
      </div>
      <?php if ($this->config->item("versaoservidor") >= 142): ?>
          <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
            <a href="<?= base_url("racas/abissais") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
              <div class="border-img">
                <img src="<?= base_url() ?>assets/site/img/raca-abissais.png" alt="" class="img-responsive">
              </div>
              <div class="text-container background-4 text-center">
                Abissais
              </div>
            </a>
          </div>
      <?php endif; ?>
      <?php if ($this->config->item("versaoservidor") >= 144): ?>
          <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
            <a href="<?= base_url("racas/guardioes") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
              <div class="border-img">
                <img src="<?= base_url() ?>assets/site/img/raca-guardioes.png" alt="" class="img-responsive">
              </div>
              <div class="text-container background-4 text-center">
                Guardiões
              </div>
            </a>
          </div>
      <?php endif; ?>
      <?php if ($this->config->item("versaoservidor") >= 153): ?>
          <div class="item-content first col-lg-3 col-md-3 col-sm-4 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
            <a href="<?= base_url("racas/sombrios") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
              <div class="border-img">
                <img src="<?= base_url() ?>assets/site/img/raca-sombrios.png" alt="" class="img-responsive">
              </div>
              <div class="text-container background-4 text-center">
                Sombrios
              </div>
            </a>
          </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- TEAM END -->