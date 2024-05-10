<!-- PAGE NAME START -->
<section class="page-name page-gvg parallax" data-paroller-factor="0.1" data-paroller-type="background"
  data-paroller-direction="vertical">
  <h1 class="page-title"> Ranking GVG </h1>
</section>
<!-- PAGE NAME END -->
<section style="padding: 70px;">
  <span class="title">Ranking GVG
    <?php echo ($periodo == "geral" ? "Geral" : ($periodo == "atual" ? "Atual" : ucwords(strftime('%B', strtotime("-" . $periodo . " month"))))); ?></span>
  <div class="row ">
    <div class="col-md-9 col-xs-12 mt70">
      <table class="display dTables dTablesselector" style="width:100%">
        <thead>
          <tr>
            <th>#</th>
            <th>Clan</th>
            <th>Marechal</th>
            <th>Matou</th>
            <th>Morreu</th>
            <th>Pontos</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;

          foreach ($ranking as $posicao):
            if ($this->config->item("mostrarzeradosenegativosgvg") == 0 and $posicao->pontos <= 0) {
              continue;
            }
            ?>
            <tr class="linkrow" data-id="<?php echo $posicao->guild_id ?>">
              <td> <?php echo $i; ?> </td>
              <td>
                <a
                  href="<?php echo base_url("competitivo/clan/" . $posicao->guild_id) ?>"><?php echo $posicao->guild_nome ?></a>
              </td>
              <td>
                <a
                  href="<?php echo base_url("competitivo/personagem/" . $posicao->charid) ?>"><?php echo $posicao->mestre ?></a>
              </td>
              <td><?php echo $posicao->kills ?></td>
              <td><?php echo $posicao->deaths ?></td>
              <td><?php echo $posicao->pontos ?></td>
            </tr>
            <?php
            $i++;
          endforeach;
          ?>

        </tbody>
      </table>
    </div>
    <div class="col-xs-12 col-md-3 mt70">
      <ul class="nested-lists py-3" style="background-color:var(--lapis-lazuli)">
        <h3 class="subheading text-center mb30 ">Ranking</h3>
        <ul>
          <li class="<?php echo ($periodo == "geral" ? "active fweight-700" : "") ?>"><a
              href="<?php echo base_url("competitivo/gvg/geral") ?>"><?php echo ($periodo == "geral" ? "<i class='fas fa-check'></i> " : "") ?>
              Geral</a></li>
          <li class="<?php echo ($periodo == "atual" ? "active fweight-700" : "") ?>"><a
              href="<?php echo base_url("competitivo/gvg/atual") ?>"><?php echo ($periodo == "atual" ? "<i class='fas fa-check'></i> " : "") ?>
              Este mês</a></li>
          <li class="<?php echo ($periodo == "1" ? "active fweight-700" : "") ?>"><a
              href="<?php echo base_url("competitivo/gvg/1") ?>"><?php echo ($periodo == "1" ? "<i class='fas fa-check'></i> " : "") ?>
              <?php echo $this->config->item("meses")[date("m", strtotime("-1 month"))] ?></a></li>
          <li class="<?php echo ($periodo == "2" ? "active fweight-700" : "") ?>"><a
              href="<?php echo base_url("competitivo/gvg/2") ?>"><?php echo ($periodo == "2" ? "<i class='fas fa-check'></i> " : "") ?>
              <?php echo $this->config->item("meses")[date("m", strtotime("-2 month"))] ?></a></li>
          <li class="<?php echo ($periodo == "3" ? "active fweight-700" : "") ?>"><a
              href="<?php echo base_url("competitivo/gvg/3") ?>"><?php echo ($periodo == "3" ? "<i class='fas fa-check'></i> " : "") ?>
              <?php echo $this->config->item("meses")[date("m", strtotime("-3 month"))] ?></a></li>
        </ul>
      </ul>
    </div>
  </div>
</section>

<script>
  $(".linkrow").click(function () {
    window.location = "<?php echo base_url("competitivo/clan/") ?>" + $(this).attr("data-id");
  });
</script>