<!-- PAGE NAME START -->
<section class="page-name page-cla">
  <h1 class="page-title"> Ranking de Clans </h1>
</section>
<!-- PAGE NAME END -->
<section style="padding: 70px;">
  <span class="title">Ranking de Clans</span>
  <div class="row mt70">
    <div class="col-12">
      <table id="listacla" class="display dTables" style="width:100%">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Master</th>
            <th>Integrantes</th>
            <th>Territórios</th>
            <th>Pontos TW</th>
            <th>Pontos GVG</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($ranking as $posicao):
            $icone = get_guild_icon($icones, $posicao->guild_id);
            ?>
            <tr class="linkrow" data-id="<?php echo $posicao->guild_id ?>">
              <td>

                <?= (!empty($icone) ? ($icone['default'] ? '<img class="iconmap" style="margin-right: 0px;position:static;" src="' . base_url("assets/upload/guildicons/ico.png") . '">' : '<img class="iconmap" style="margin-right: 0px;position:static;background-position-y:' . ($icone['linha'] > 1 ? ($icone['linha'] - 1) * -19.5 : 0) . 'px; background-position-x:' . ($icone['coluna'] > 1 ? ($icone['coluna'] - 1) * -19.5 : 0) . 'px" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">') : "") ?>

                <?php echo $posicao->guild_nome ?>
              </td>
              <td><?php echo $posicao->nome ?></td>
              <td><?php echo $posicao->membros ?></td>
              <td><?php echo $posicao->territorios ?></td>
              <td><?php echo $posicao->pontos ?></td>
              <td><?php echo $posicao->pontosgvg ?></td>
            </tr>
            <?php
            $i++;
          endforeach;
          ?>

        </tbody>
      </table>
    </div>
  </div>
</section>

<script>
  $(".linkrow").click(function () {
    window.location = "<?php echo base_url("competitivo/clan/") ?>" + $(this).attr("data-id");
  });
</script>