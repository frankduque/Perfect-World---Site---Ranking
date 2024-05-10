<!-- PAGE NAME START -->
<section class="page-name page-downloads parallax" data-paroller-factor="0.1" data-paroller-type="background"
  data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Downloads
      </h1>
    </div>
  </div>
</section>
<!-- PAGE NAME END -->
<div class="container">
  <div class="tm-tabs">
    <div class="tab-content relative mt90 mb110">
      <div class="row">
        <div class="col-12 ptb90 pl100 pr100 equal-height">
          <div class="uppercase text-center fsize-32 fweight-700 font-agency color-white lheight-normal">
            Download <?php echo $this->config->item("nomeservidor") ?>
          </div>
          <div class="mt50 lheight-26 fweight-300">
            <?php if (count($clients) == 0 and count($patchers) == 0): ?>
              <div class="mt-5 pt-5 uppercase text-center fsize-32 fweight-700 font-agency color-white lheight-normal">
                Nenhum download está disponível
              </div>
            <?php else: ?>
              <p class="text-center">Não perca mais tempo e venha conhecer nosso servidor. Use uma das opções abaixo para
                ter acesso ao nosso servidor</p>
            <?php endif; ?>
            <?php if (count($clients) > 0): ?>
              <div class="uppercase mt-5 text-center fsize-32 fweight-700 font-agency color-white lheight-normal">
                Client Completo
              </div>
              <br>
              <p class="text-center">Esta é a forma mais segura e indicada de jogar o
                <?php echo $this->config->item("nomeservidor") ?>
              </p>
              <div class="row mt-5">
                <?php foreach ($clients as $client): ?>
                  <div class="col-md-3 col-xs-6 item-download" data-id="<?php echo $client->id; ?>">
                    <img class="downloadimg" src="<?php echo $client->caminho_imagem ?>">
                    <span class="downloadtext"><?php echo $client->nome ?></span>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
            <?php if (count($patchers) > 0): ?>
              <div class="uppercase mt-5 text-center fsize-32 fweight-700 font-agency color-white lheight-normal">
                Patchers
              </div>
              <br>
              <p class="text-center">Pra quem já possui um client compatível basta aplicar este patcher.</p>

              <div class="row mt-5">
                <?php foreach ($patchers as $patcher): ?>
                  <div class="col-md-3 col-xs-6 item-download" data-id="<?php echo $patcher->id; ?>">
                    <img class="downloadimg" src="<?php echo $patcher->caminho_imagem ?>">
                    <span class="downloadtext"><?php echo $patcher->nome ?></span>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    $(".item-download").click(function () {
      $.ajax({
        url: '<?php echo base_url("downloads/download/") ?>' + this.getAttribute('data-id'),
        data: { <?php echo json_encode($this->security->get_csrf_token_name()) ?>: <?php echo json_encode($this->security->get_csrf_hash()) ?> },
        type: "POST",
        dataType: "json",
        success: function (data) {
          var win = window.open(data, '_blank');
          if (win) {
            win.focus();
          } else {
            window.location.href = data;
          }
        }
      });
    });
  });
</script>