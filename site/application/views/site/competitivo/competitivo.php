<!-- PAGE NAME START -->
<section class="page-name page-competitivo parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Competitivo
      </h1> 
    </div>
  </div>
</section>
<!-- PAGE NAME END -->
<!-- TEAM START -->
<section class="team-bl ptb150">
  <div class="container">
    <div class="row"> 
        <?php if ($this->config->item("usarpvp") == 1): ?>
          <div class="item-content first col-lg-6 col-md-6 col-sm-6 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
            <a href="<?php echo base_url("competitivo/pvp") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
              <div class="border-img">
                <img src="<?php echo base_url() ?>assets/site/img/competitivo-pvp.jpg" alt="" class="img-responsive">
              </div>
              <div class="text-container background-4 text-center">
                Ranking PVP
              </div>
            </a>
          </div>
      <?php endif; ?>
        <?php if ($this->config->item("usarpve") == 1): ?>
          <div class="item-content first col-lg-6 col-md-6 col-sm-6 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
            <a href="<?php echo base_url("competitivo/pve") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
              <div class="border-img">
                <img src="<?php echo base_url() ?>assets/site/img/competitivo-pve.jpg" alt="" class="img-responsive">
              </div>
              <div class="text-container background-4 text-center">
                Ranking PVE
              </div>
            </a>
          </div>
      <?php endif; ?>
      <?php if ($this->config->item("usartw") == 1): ?>
          <div class="item-content first col-lg-6 col-md-6 col-sm-6 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
            <a href="<?php echo base_url("competitivo/tw") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
              <div class="border-img">
                <img style="max-height: 231px" src="<?php echo base_url() ?>assets/site/img/competitivo-tw.jpg" alt="" class="img-responsive">
              </div>
              <div class="text-container background-4 text-center">
                Guerras Territoriais
              </div>
            </a>
          </div>
      <?php endif; ?>
      <?php if ($this->config->item("usargvg") == 1): ?>
          <div class="item-content first col-lg-6 col-md-6 col-sm-6 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
            <a href="<?php echo base_url("competitivo/gvg") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
              <div class="border-img">
                <img style="max-height: 231px" src="<?php echo base_url() ?>assets/site/img/competitivo-gvg.jpg" alt="" class="img-responsive">
              </div>
              <div class="text-container background-4 text-center">
                Guild vs Guild
              </div>
            </a>
          </div>
      <?php endif; ?>
      <?php if ($this->config->item("usarlistaclans") == 1): ?>
          <div class="item-content first col-lg-6 col-md-6 col-sm-6 col-xs-12 mb30 equal-height wow fadeInUp" data-wow-duration="1s">
            <a href="<?php echo base_url("competitivo/clans") ?>" class="name font-agency fsize-32 fweight-700 lheight-32 color-white">
              <div class="border-img">
                <img style="max-height: 231px" src="<?php echo base_url() ?>assets/site/img/competitivo-cla.jpg" alt="" class="img-responsive">
              </div>
              <div class="text-container background-4 text-center">
                Ranking de Clans
              </div>
            </a>
          </div>
      <?php endif; ?>
    </div> 
  </div>
</section>
<!-- TEAM END -->