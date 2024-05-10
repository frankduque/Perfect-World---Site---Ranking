
<!-- PAGE NAME START -->
<section class="page-name page-detalhes parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <h1 class="page-title">Clan <?= $clan->guild_nome ?>  </h1>
</section>
<!-- PAGE NAME END -->
<section class="ptb150">
  <span class="title">Clan <?= $clan->guild_nome ?> </span>
  <div class="container">
    <div class="row">
      <div class="col-4">
        <span class="title">Informações</span>
        <div class="tm-tabs">
          <div class="tab-content relative p-4">
            <div class="row">
              <div class="col-6">
                <div class="pl-4 uppercase fsize-24 fweight-700 font-agency color-white lheight-normal">
                  Marechal:
                </div> 
              </div> 
              <div class="col-6">
                <div class="pr-4 text-right fsize-24 fweight-700 font-agency color-white lheight-normal">
                    <?= $clan->nome ?>
                </div> 
              </div> 
              <div class="col-6">
                <div class="pl-4 uppercase fsize-24 fweight-700 font-agency color-white lheight-normal">
                  Quantidade de Membros:
                </div> 
              </div> 
              <div class="col-6">
                <div class="pr-4 text-right fsize-24 fweight-700 font-agency color-white lheight-normal">
                    <?= $clan->membros ?>
                </div> 
              </div> 
              <div class="col-6">
                <div class="pl-4 uppercase fsize-24 fweight-700 font-agency color-white lheight-normal">
                  Territórios:
                </div> 
              </div> 
              <div class="col-6">
                <div class="pr-4 text-right fsize-24 fweight-700 font-agency color-white lheight-normal">
                    <?= (!empty($territorios) ? count($territorios) : "0" ) ?>
                </div> 
              </div> 
            </div> 
          </div>
        </div>
      </div>
      <div class="col-8">
        <span class="title">Membros</span>
        <table id="cladetail" class="display dTables" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Nick</th>
              <th>Classe</th>
              <th>Pontos PVP</th>
            </tr>
          </thead>
          <tbody>
              <?php
              $i = 1;
              foreach ($membros as $membro) :
                  ?>
                <tr>
                  <td> <?= $i; ?> </td>
                  <td>
                    <a href="<?= base_url("competitivo/personagem/" . $membro->charid) ?>"><?= $membro->nome ?></a>
                  </td>
                  <td><?= $this->config->item("id2classe")[$membro->classe] ?></td>
                  <td><?= $membro->pontos ?></td>
                </tr>
                <?php
                $i++;
            endforeach
            ?>
          </tbody>						
        </table>
      </div>
      <div class="col-12">
        <span class="title">Territórios</span>
        <main class="ranking">
            <?php if (!empty($territorios)): ?>
              <section class="maps">
                <ul class="mx-auto" style="width: 450px;height:500px">
                    <?php
                    $icone = get_guild_icon($icones, $clan->guild_id);
                    foreach ($this->config->item("mapas") as $k => $v):
                        ?>
                      <li class="limapa map<?= ($k < 10 ? "0" . $k : $k ) ?>">
                          <?php if (isset($territorios[$k])): ?>
                              <?= (!empty($icone) ? ($icone['default'] ? '<img id="iconecla" data-id="' . $territorios[$k]->owner . '" title="<b>' . ($territorios[$k]->owner > 0 ? $clan->guild_nome : "") . ' </b>" data-toggle="tooltip" data-placement="left" data-html="true" class="iconmap iconmap' . $territorios[$k]->id . '" style="background-position-y:' . ($icone['linha'] > 1 ? ($icone['linha'] - 1) * -19.5 : 0) . 'px; background-position-x:' . ($icone['coluna'] > 1 ? ($icone['coluna'] - 1) * -19.5 : 0) . 'px" src="' . base_url("assets/upload/guildicons/ico.png") . '">' : '<img id="iconecla" data-id="' . $territorios[$k]->owner . '" title="<b>' . ($territorios[$k]->owner > 0 ? $territorios[$k]->guild_nome : "Nenhum") . '</b>" data-toggle="tooltip" data-placement="left" data-html="true" class="iconmap iconmap' . $territorios[$k]->id . '" style="background-position-y:' . ($icone['linha'] > 1 ? ($icone['linha'] - 1) * -19.5 : 0) . 'px; background-position-x:' . ($icone['coluna'] > 1 ? ($icone['coluna'] - 1) * -19.5 : 0) . 'px" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">') : "") ?>
                            <img data-id="<?= $k; ?>" data-toggle="tooltip" data-placement="left" data-html="true" title="<b>Nome: <?= $this->config->item('mapas')[$k] ?> <br> Nível: <?= $territorios[$k]->level ?> <br> Governante: <?= ($territorios[$k]->owner == $clan->guild_id ? $clan->guild_nome : ""); ?>" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="mapa<?= $k ?> <?= ($territorios[$k]->owner == $clan->guild_id ? "color_front_" . $territorios[$k]->color : "") ?>" data-was-processed="true">
                        <?php else: ?>
                            <img data-id="<?= $k; ?>" data-toggle="tooltip" data-placement="left" data-html="true"  src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="mapa<?= $k ?>" data-was-processed="true">
                        <?php endif; ?>
                      </li>
                  <?php endforeach; ?>
                  <li class="grid"><img src="<?= base_url() ?>assets/site/img/ranking/grid.png" style="filter: brightness(2);" class="loading" data-was-processed="true"></li><!-- Grid normal 0x0, grid grosso -1x-1 -->
                  <li style='width:0px;height:0px;'><img class="bigcastle01 loading" src="<?= base_url() ?>assets/site/img/ranking/castelo-grande.png" data-was-processed="true"></li>
                  <li style='width:0px;height:0px;'><img class="bigcastle02 loading" src="<?= base_url() ?>assets/site/img/ranking/castelo-grande.png" data-was-processed="true"></li>
                  <li style='width:0px;height:0px;'><img class="castle01 loading" src="<?= base_url() ?>assets/site/img/ranking/castelo-pequeno.png" data-was-processed="true"></li>
                  <li style='width:0px;height:0px;'><img class="castle02 easteregg loading" src="<?= base_url() ?>assets/site/img/ranking/castelo-pequeno.png" data-was-processed="true"></li>
                  <li style='width:0px;height:0px;'><img class="castle03 loading" src="<?= base_url() ?>assets/site/img/ranking/castelo-pequeno.png" data-was-processed="true"></li>
                  <li style='width:0px;height:0px;'><img class="castle04 loading" src="<?= base_url() ?>assets/site/img/ranking/castelo-pequeno.png" data-was-processed="true"></li>
                  <li style='width:0px;height:0px;'><img class="castle05 loading" src="<?= base_url() ?>assets/site/img/ranking/castelo-pequeno.png" data-was-processed="true"></li>
                  <li style='width:0px;height:0px;'><img class="castle06 loading" src="<?= base_url() ?>assets/site/img/ranking/castelo-pequeno.png" data-was-processed="true"></li>
                  <li style='width:0px;height:0px;'><img class="castle07 loading" src="<?= base_url() ?>assets/site/img/ranking/castelo-pequeno.png" data-was-processed="true"></li>
                </ul>
              </section>
          <?php else: ?>
              <h4>Nenhum Mapa conquistado</h4>
          <?php endif; ?>
        </main>
      </div>
    </div>
  </div>
</section>
<script>
    $("li.highlight").mouseover(function () {
        if (!$('img[class^="map"]').not('.color_front_' + $(this).attr("data-color")).hasClass("color_beta")) {
            $('img[class^="map"]').not('.color_front_' + $(this).attr("data-color")).addClass("color_beta");
        }
    }).mouseout(function () {
        if ($('img[class^="map"]').not('.color_front_' + $(this).attr("data-color")).hasClass("color_beta")) {
            $('img[class^="map"]').not('.color_front_' + $(this).attr("data-color")).removeClass("color_beta");
        }
    });
    $(".mapaconquistado").mouseover(function () {
        if (!$('img[class^="map"]').not('.mapa' + $(this).attr("data-id")).hasClass("color_beta")) {
            $('img[class^="map"]').not('.mapa' + $(this).attr("data-id")).addClass("color_beta");
        }
    }).mouseout(function () {
        if ($('img[class^="map"]').not('.mapa' + $(this).attr("data-id")).hasClass("color_beta")) {
            $('img[class^="map"]').not('.mapa' + $(this).attr("data-id")).removeClass("color_beta");
        }
    });
    $('img[class^="map"]').mouseover(function () {
        if (!$('img[class^="map"]').not('.mapa' + $(this).attr("data-id")).hasClass("color_beta")) {
            $('img[class^="map"]').not('.mapa' + $(this).attr("data-id")).addClass("color_beta");
        }
    }).mouseout(function () {
        if ($('img[class^="map"]').not('.mapa' + $(this).attr("data-id")).hasClass("color_beta")) {
            $('img[class^="map"]').not('.mapa' + $(this).attr("data-id")).removeClass("color_beta");
        }
    });
</script>
<div class="modal fade bd-example-modal-xl" id="modaldetalhes" tabindex="-1" role="dialog" aria-labelledby="modaldetalhes" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4 text-dark ml-0" id="myLargeModalLabel">Detalhes do Personagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body text-dark" id="modal-content">
        <div id='loader' style='display: none;'>
          <img src='<?php echo base_url("assets/site/img/loading.gif") ?>' width='32px' height='32px'>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function () {
        $(".btndetalhes").click(function () {
            $('#modaldetalhes').modal('show');
            $.ajax({
                beforeSend: function () {
                    var codeBlock = "<div style='width: 100%;height: 270px;'><img src='<?php echo base_url("assets/site/img/loading.gif") ?>' style='width: 100px;height: 100px;margin-left: auto;margin-right: auto;display: block;margin-top: 100px;'></div>";
                    $("#modal-content").html(codeBlock);

                },
                url: '<?php echo base_url("competitivo/personageminfo/") ?>' + this.getAttribute('data-id'),
                data: {<?php echo json_encode($this->security->get_csrf_token_name()) ?>:<?php echo json_encode($this->security->get_csrf_hash()) ?>},
                type: "POST",
                dataType: "json",
                success: function (data) {
                    $("#modal-content").html(data);
                    var dTables = $('.dInfoTable');
                    if (dTables.length)
                    {
                        dTables.DataTable({
                            responsive: true,
                            info: false,
                            language: {
                                search: '',
                                searchPlaceholder: 'Pesquise aqui...',
                                paginate: {
                                    previous: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
                                    next: '<i class="fa fa-chevron-right" aria-hidden="true"></i>'
                                },
                                "sEmptyTable": "Nenhum registro encontrado",
                                "sLengthMenu": "Mostrar _MENU_ resultados",

                            }
                        });
                    }
                },
            });
        });
    });
</script>