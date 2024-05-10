<!-- PAGE NAME START -->
<section class="page-name page-personagens parallax" data-paroller-factor="0.1" data-paroller-type="background"
  data-paroller-direction="vertical">
  <h1 class="page-title"><?php echo $personagem->nome ?> </h1>
</section>
<!-- PAGE NAME END -->
<section class="ptb150" style="padding: 70px;">
  <div class="tm-tabs">
    <div class="tab-content relative p-4" style="padding-bottom: 50px!important;">
      <span class="title mt-5">Informações</span>
      <div class="row">
        <div class="col-6">
          <span class="title"><?php echo $personagem->nome ?></span>
          <div class="row">
            <div class="col-3">
              <div class="pl-4 uppercase fsize-24 fweight-700 font-agency color-white lheight-normal">Nível:</div>
            </div>
            <div class="col-3">
              <div class="pr-4 text-right fsize-24 fweight-700 font-agency color-white lheight-normal">
                <?= $personagem->nivel ?>
              </div>
            </div>
            <div class="col-3">
              <div class="pl-4 uppercase fsize-24 fweight-700 font-agency color-white lheight-normal">Fama:</div>
            </div>
            <div class="col-3">
              <div class="pr-4 text-right fsize-24 fweight-700 font-agency color-white lheight-normal">
                <?= $personagem->reputacao ?>
              </div>
            </div>
            <div class="col-3">
              <div class="pl-4 uppercase fsize-24 fweight-700 font-agency color-white lheight-normal">Culvivo:</div>
            </div>
            <div class="col-3">
              <div class="pr-4 text-right fsize-24 fweight-700 font-agency color-white lheight-normal">
                <?= $this->config->item("id2cultivo")[$personagem->cultivo] ?>
              </div>
            </div>
            <div class="col-3">
              <div class="pl-4 uppercase fsize-24 fweight-700 font-agency color-white lheight-normal">Clã:</div>
            </div>
            <div class="col-3">
              <div class="pr-4 text-right fsize-24 fweight-700 font-agency color-white lheight-normal">
                <?php echo ($personagem->guild_id > 0 ? "<a style='font-size:24px;' href='" . base_url("competitivo/clan/" . $personagem->guild_id) . "'>" . $personagem->guild_nome . "</a>" : "Nenhum") ?>
              </div>
            </div>
            <div class="col-3">
              <div class="pl-4 uppercase fsize-24 fweight-700 font-agency color-white lheight-normal">Classe:</div>
            </div>
            <div class="col-3">
              <div class="pr-4 text-right fsize-24 fweight-700 font-agency color-white lheight-normal">
                <?= $this->config->item("id2classe")[$personagem->classe] ?>
              </div>
            </div>
            <div class="col-4">
              <div class="pl-4 uppercase fsize-24 fweight-700 font-agency color-white lheight-normal">Pontos PVP:</div>
            </div>
            <div class="col-2">
              <div class="pr-4 text-right fsize-24 fweight-700 font-agency color-white lheight-normal">
                <?= $personagem->pontos ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="cnt">
            <div class="bpanel" id="equip"
              style="background: url(<?php echo base_url("assets/site/img/personagem/od/items.png") ?>) 0px 0px no-repeat scroll transparent; height: 250px; margin-top: -5px; width: 350px;">
              <table border="0" class="btable" style="width: 335px;">
                <tbody>
                  <tr>
                    <td class="tdk" id="tdk" style="height: 273px;"></td>
                  </tr>
                  <tr>
                    <td id="btable" valign="top"></td>
                  </tr>
                </tbody>
              </table>
              <div class="blank" id="items_cimg_b" style="left: 5px; top: 30px; width: 324px; height: 222px;"><img
                  src="<?php echo base_url() ?>assets/site/img/personagem/od/items_cimg.png"></div>
              <div class="male" id="items_cimg" style="left: 129px; top: 72px;"></div>
              <div class="stardsk_od" id="stardsk" style="left: 129px; top: 214px;"></div>
              <div class="blank" id="itm_0"
                style="left: 242px; top: 66px; width: 38px; height: 38px;  background: url(<?php echo base_url("assets/site/img/personagem/od/bbpb/headbb.png") ?>) 0px 0px no-repeat transparent;">
                <?php if (isset($equipamentos[1])): ?>
                  <img src="<?php echo base_url("assets/site/img/personagem/icones/") . $equipamentos[1]->id ?>.png"
                    width="38" height="38"
                    title="<b><span style='color:#<?php echo (isset($itens[$equipamentos[1]->id]->cor) ? $itens[$equipamentos[1]->id]->cor : "FFFFFF") ?>'><?php echo (isset($itens[$equipamentos[1]->id]->nome) ? $itens[$equipamentos[1]->id]->nome : "") ?><br>"
                    data-toggle="tooltip" data-placement="left" data-html="true">
                <?php endif; ?>
              </div>
              <div class="blank" id="itm_1"
                style="left: 242px; top: 111px; width: 38px; height: 38px;  background: url(<?php echo base_url() ?>assets/site/img/personagem/od/bbpb/bodybb.png) 0px 0px no-repeat transparent;">
                <?php if (isset($equipamentos[4])): ?>
                  <img src="<?php echo base_url("assets/site/img/personagem/icones/") . $equipamentos[4]->id ?>.png"
                    width="38" height="38"
                    title="<b><span style='color:#<?php echo (isset($itens[$equipamentos[4]->id]->cor) ? $itens[$equipamentos[4]->id]->cor : "FFFFFF") ?>'><?php echo (isset($itens[$equipamentos[4]->id]->nome) ? "" : "") ?><br>"
                    data-toggle="tooltip" data-placement="left" data-html="true">
                <?php endif; ?>
              </div>
              <div class="blank" id="itm_2"
                style="left: 242px; top: 156px; width: 38px; height: 38px;  background: url(<?php echo base_url() ?>assets/site/img/personagem/od/bbpb/pantsbb.png) 0px 0px no-repeat transparent;">
                <?php if (isset($equipamentos[6])): ?>
                  <img src="<?php echo base_url("assets/site/img/personagem/icones/") . $equipamentos[6]->id ?>.png"
                    width="38" height="38"
                    title="<b><span style='color:#<?php echo (isset($itens[$equipamentos[6]->id]->cor) ? $itens[$equipamentos[6]->id]->cor : "FFFFFF") ?>'><?php echo (isset($itens[$equipamentos[6]->id]->nome) ? $itens[$equipamentos[6]->id]->nome : "") ?><br>"
                    data-toggle="tooltip" data-placement="left" data-html="true">
                <?php endif; ?>
              </div>
              <div class="blank" id="itm_3"
                style="left: 242px; top: 201px; width: 38px; height: 38px;  background: url(<?php echo base_url() ?>assets/site/img/personagem/od/bbpb/footbb.png) 0px 0px no-repeat transparent;">
                <?php if (isset($equipamentos[7])): ?>
                  <img src="<?php echo base_url("assets/site/img/personagem/icones/") . $equipamentos[7]->id ?>.png"
                    width="38" height="38"
                    title="<b><span style='color:#<?php echo (isset($itens[$equipamentos[7]->id]->cor) ? $itens[$equipamentos[7]->id]->cor : "FFFFFF") ?>'><?php echo (isset($itens[$equipamentos[7]->id]->nome) ? $itens[$equipamentos[7]->id]->nome : "") ?><br>"
                    data-toggle="tooltip" data-placement="left" data-html="true">
                <?php endif; ?>
              </div>
              <div class="blank" id="itm_4"
                style="left: 53px; top: 111px; width: 38px; height: 38px;  background: url(<?php echo base_url() ?>assets/site/img/personagem/od/bbpb/mantobb.png) 0px 0px no-repeat transparent;">
                <?php if (isset($equipamentos[3])): ?>
                  <img src="<?php echo base_url("assets/site/img/personagem/icones/") . $equipamentos[3]->id ?>.png"
                    width="38" height="38"
                    title="<b><span style='color:#<?php echo (isset($itens[$equipamentos[3]->id]->cor) ? $itens[$equipamentos[3]->id]->cor : "") ?>'><?php echo (isset($itens[$equipamentos[3]->id]->nome) ? $itens[$equipamentos[3]->id]->nome : "") ?><br> "
                    data-toggle="tooltip" data-placement="left" data-html="true">
                <?php endif; ?>
              </div>
              <div class="blank" id="itm_5"
                style="left: 15px; top: 111px; width: 38px; height: 38px;  background: url(<?php echo base_url() ?>assets/site/img/personagem/od/bbpb/necklacebb.png) 0px 0px no-repeat transparent;">
                <?php if (isset($equipamentos[2])): ?>
                  <img src="<?php echo base_url("assets/site/img/personagem/icones/") . $equipamentos[2]->id ?>.png"
                    width="38" height="38"
                    title="<b><span style='color:#<?php echo (isset($itens[$equipamentos[2]->id]->cor) ? $itens[$equipamentos[2]->id]->cor : "FFFFFF") ?>'><?php echo (isset($itens[$equipamentos[2]->id]->nome) ? $itens[$equipamentos[2]->id]->nome : "") ?><br> "
                    data-toggle="tooltip" data-placement="left" data-html="true">
                <?php endif; ?>
              </div>
              <div class="blank" id="itm_6"
                style="left: 15px; top: 156px; width: 38px; height: 38px;  background: url(<?php echo base_url() ?>assets/site/img/personagem/od/bbpb/brasletbb.png) 0px 0px no-repeat transparent;">
                <?php if (isset($equipamentos[8])): ?>
                  <img src="<?php echo base_url("assets/site/img/personagem/icones/") . $equipamentos[8]->id ?>.png"
                    width="38" height="38"
                    title="<b><span style='color:#<?php echo (isset($itens[$equipamentos[8]->id]->cor) ? $itens[$equipamentos[8]->id]->cor : "") ?>'><?php echo (isset($itens[$equipamentos[8]->id]->nome) ? $itens[$equipamentos[8]->id]->nome : "") ?><br> "
                    data-toggle="tooltip" data-placement="left" data-html="true">
                <?php endif; ?>
              </div>
              <div class="blank" id="itm_7"
                style="left: 53px; top: 156px; width: 38px; height: 38px;  background: url(<?php echo base_url() ?>assets/site/img/personagem/od/bbpb/beltbb.png) 0px 0px no-repeat transparent;">
                <?php if (isset($equipamentos[5])): ?>
                  <img src="<?php echo base_url("assets/site/img/personagem/icones/") . $equipamentos[5]->id ?>.png"
                    width="38" height="38"
                    title="<b><span style='color:#<?php echo (isset($itens[$equipamentos[5]->id]->cor) ? $itens[$equipamentos[5]->id]->cor : "FFFFFF") ?>'><?php echo (isset($itens[$equipamentos[5]->id]->nome) ? $itens[$equipamentos[5]->id]->nome : "") ?><br> "
                    data-toggle="tooltip" data-placement="left" data-html="true">
                <?php endif; ?>
              </div>
              <div class="blank" id="itm_8"
                style="left: 15px; top: 201px; width: 38px; height: 38px;  background: url(<?php echo base_url() ?>assets/site/img/personagem/od/bbpb/ring1bb.png) 0px 0px no-repeat transparent;">
                <?php if (isset($equipamentos[9])): ?>
                  <img src="<?php echo base_url("assets/site/img/personagem/icones/") . $equipamentos[9]->id ?>.png"
                    width="38" height="38"
                    title="<b><span style='color:#<?php echo (isset($itens[$equipamentos[9]->id]->cor) ? $itens[$equipamentos[9]->id]->cor : "FFFFFF") ?>'><?php echo (isset($itens[$equipamentos[9]->id]->nome) ? $itens[$equipamentos[9]->id]->nome : "") ?><br> "
                    data-toggle="tooltip" data-placement="left" data-html="true">
                <?php endif; ?>
              </div>
              <div class="blank" id="itm_9"
                style="left: 53px; top: 201px; width: 38px; height: 38px;  background: url(<?php echo base_url() ?>assets/site/img/personagem/od/bbpb/ring2bb.png) 0px 0px no-repeat transparent;">
                <?php if (isset($equipamentos[10])): ?>
                  <img src="<?php echo base_url("assets/site/img/personagem/icones/") . $equipamentos[10]->id ?>.png"
                    width="38" height="38"
                    title="<b><span style='color:#<?php echo (isset($itens[$equipamentos[10]->id]->cor) ? $itens[$equipamentos[10]->id]->cor : "FFFFFF") ?>'><?php echo (isset($itens[$equipamentos[10]->id]->nome) ? $itens[$equipamentos[10]->id]->nome : "") ?><br> "
                    data-toggle="tooltip" data-placement="left" data-html="true">
                <?php endif; ?>
              </div>
              <div class="blank" id="itm_10"
                style="left: 280px; top: 156px; width: 38px; height: 38px;  background: url(<?php echo base_url() ?>assets/site/img/personagem/od/bbpb/weaponbb.png) 0px 0px no-repeat transparent;">
                <?php if (isset($equipamentos[0])): ?>
                  <img src="<?php echo base_url("assets/site/img/personagem/icones/") . $equipamentos[0]->id ?>.png"
                    width="38" height="38"
                    title="<b><span style='color:#<?php echo (isset($itens[$equipamentos[0]->id]->cor) ? $itens[$equipamentos[0]->id]->cor : "FFFFFF") ?>'><?php echo (isset($itens[$equipamentos[0]->id]->nome) ? $itens[$equipamentos[0]->id]->nome : "") ?><br> "
                    data-toggle="tooltip" data-placement="left" data-html="true">
                <?php endif; ?>
              </div>
              <div class="blank" id="itm_11"
                style="left: 280px; top: 201px; width: 38px; height: 38px;  background: url(<?php echo base_url() ?>assets/site/img/personagem/od/bbpb/arrowbb.png) 0px 0px no-repeat transparent;">
                <?php if (isset($equipamentos[6])): ?>
                  <img src="<?php echo base_url("assets/site/img/personagem/icones/") . $equipamentos[7]->id ?>.png"
                    width="38" height="38"
                    title="<b><span style='color:#<?php echo (isset($itens[$equipamentos[7]->id]->cor) ? $itens[$equipamentos[7]->id]->cor : "FFFFFF") ?>'><?php echo (isset($itens[$equipamentos[7]->id]->nome) ? $itens[$equipamentos[7]->id]->nome : "") ?><br> "
                    data-toggle="tooltip" data-placement="left" data-html="true">
                <?php endif; ?>
              </div>
              <div class="blank" id="itm_12"
                style="left: 91px; top: 111px; width: 38px; height: 38px;  background: url(<?php echo base_url() ?>assets/site/img/personagem/od/bbpb/bookbb.png) 0px 0px no-repeat transparent;">
                <?php if (isset($equipamentos[18])): ?>
                  <img src="<?php echo base_url("assets/site/img/personagem/icones/") . $equipamentos[18]->id ?>.png"
                    width="38" height="38"
                    title="<b><span style='color:#<?php echo (isset($itens[$equipamentos[18]->id]->cor) ? $itens[$equipamentos[18]->id]->cor : "FFFFFF") ?>'><?php echo (isset($itens[$equipamentos[18]->id]->nome) ? $itens[$equipamentos[18]->id]->nome : "") ?><br> "
                    data-toggle="tooltip" data-placement="left" data-html="true">
                <?php endif; ?>
              </div>
              <div class="blank" id="itm_13"
                style="left: 91px; top: 156px; width: 38px; height: 38px;  background: url(<?php echo base_url() ?>assets/site/img/personagem/od/bbpb/slotsbb.png) 0px 0px no-repeat transparent;">
              </div>
              <div class="blank" id="itm_14"
                style="left: 91px; top: 201px; width: 38px; height: 38px;  background: url(<?php echo base_url() ?>assets/site/img/personagem/od/bbpb/geniebb.png) 0px 0px no-repeat transparent;">
              </div>
              <div class="blank" id="itm_15"
                style="left: 204px; top: 201px; width: 38px; height: 38px;  background: url(<?php echo base_url() ?>assets/site/img/personagem/od/bbpb/starbb.png) 0px 0px no-repeat transparent;">
              </div>
              <div id="items_name" class="caption_od" style="left: 90px; top: 9px; width: 138px; height: 20px;">
                Equipamentos</div>
              <div class="blank" id="mark"
                style="left: 91px; top: 201px; width: 38px; height: 38px;  background: none; display: none;"><img
                  src="img/marker.gif" width="38" height="38"></div>
              <div id="msgform"
                style="position: absolute; width: 225px; left: 44px; top: 161px; z-index: 10000; display: none;">
                <table class="ttool">
                  <tbody>
                    <tr>
                      <td style="width:7px;height:7px;background:url(img/t01.gif) no-repeat scroll 0 0;"></td>
                      <td style="height:7px;background:url(img/t02.gif) repeat-x scroll 0 0;"></td>
                      <td style="width:7px;height:7px;background:url(img/t03.gif) no-repeat scroll 0 0;"></td>
                    </tr>
                    <tr>
                      <td style="width:7px;background:url(img/t11.gif) repeat-y scroll 0 0;"></td>
                      <td id="msg_cont" valign="top" style="background:#1B1D26;"></td>
                      <td style="width:7px;background:url(img/t13.gif) repeat-y scroll 0 0;"></td>
                    </tr>
                    <tr>
                      <td style="width:7px; height:7px;background:url(img/t21.gif) no-repeat scroll 0 0;"></td>
                      <td style="height:7px;background:url(img/t22.gif) repeat-x scroll 0 0;"></td>
                      <td style="width:7px; height:7px;background:url(img/t23.gif) no-repeat scroll 0 0;"></td>
                    </tr>
                  </tbody>
                </table>
                <div style="position:absolute;left:0px;top:0px;width:100%;margin-top:7px;" id="close_msg">
                  <div id="close_msg" style="float:right;display:block;padding-right:7px;"></div>
                </div>
              </div>
              <div class="blank" id="block_msg"
                style="position: absolute; left: 107px; top: 170px; width: 100px; height: 100px; z-index: 101; display: none;">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <span class="title mt-5">Estatísticas do PVP</span>
  <div class="row">
    <div class="col-6">
      <div class="tm-tabs">
        <div class="tab-content relative p-4" style="padding-bottom: 50px!important;">
          <span class="title mt-2">Resumo de Kills</span>
          <table class="display dTables dTablesselector" style="width:100%" data-order='[[ 3, "desc" ]]'>
            <thead>
              <tr>
                <th>Nick</th>
                <th>Classe</th>
                <th>Clã</th>
                <th>kills</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($kills as $kill):
                ?>
                <tr>

                  <td>
                    <a
                      href="<?php echo base_url("competitivo/personagem/" . $kill->morreu_id) ?>"><?php echo $kill->nome ?></a>
                  </td>
                  <td><?php echo $this->config->item("id2classe")[$kill->classe] ?></td>
                  <td>
                    <?php if ($kill->guild_id > 0): ?>
                      <?php $icone = get_guild_icon($icones, $kill->guild_id); ?>
                      <?php if (!empty($icone)): ?>
                        <?php if ($icone['default']): ?>
                          <img class="iconmap" style="margin-right: 0px; position: static; display: inline" src="<?= base_url("assets/upload/guildicons/ico.png") ?>">
                        <?php else: ?>
                          <img class="iconmap"
                            style="margin-right: 0px; position: static; background-position-y: <?= ($icone['linha'] > 1 ? ($icone['linha'] - 1) * -19.5 : 0) ?>px; background-position-x: <?= ($icone['coluna'] > 1 ? ($icone['coluna'] - 1) * -19.5 : 0) ?>px; display: inline" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                        <?php endif; ?>
                      <?php endif; ?>

                      <a href="<?= base_url("competitivo/clan/" . $kill->guild_id) ?>"><?= $kill->guild_nome ?></a>
                    <?php else: ?>
                      Nenhum
                    <?php endif; ?>
                  </td>
                  <td><?php echo $kill->kills ?></td>
                </tr>
                <?php
              endforeach ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="tm-tabs">
        <div class="tab-content relative p-4" style="padding-bottom: 50px!important;">
          <span class="title mt-2">Resumo de mortes</span>
          <table class="display dTables dTablesselector" style="width:100%">
            <thead>
              <tr>
                <th>Nick</th>
                <th>Classe</th>
                <th>Clã</th>
                <th>Mortes</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($deaths as $death):
                ?>
                <tr>
                  <td>
                    <a
                      href="<?php echo base_url("competitivo/personagem/" . $death->matou_id) ?>"><?php echo $death->nome ?></a>
                  </td>
                  <td><?php echo $this->config->item("id2classe")[$death->classe] ?></td>
                  <td>
                    <?php
                    if ($death->guild_id > 0):
                      $icone = get_guild_icon($icones, $death->guild_id);
                      ?>
                      <?= (!empty($icone) ? ($icone['default'] ? '<img class="iconmap" style="margin-right: 0px;position:static; display:inline" src="' . base_url("assets/upload/guildicons/ico.png") . '">' : '<img class="iconmap" style="margin-right: 0px;position:static;background-position-y:' . ($icone['linha'] > 1 ? ($icone['linha'] - 1) * -19.5 : 0) . 'px; background-position-x:' . ($icone['coluna'] > 1 ? ($icone['coluna'] - 1) * -19.5 : 0) . 'px; display:inline" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">') : "") ?>
                      <a
                        href="<?php echo base_url("competitivo/clan/" . $death->guild_id) ?>"><?php echo $death->guild_nome ?></a>
                    <?php else: ?>
                      Nenhum
                      <?php
                    endif;
                    ?>
                  </td>
                  <td><?php echo $death->deaths ?></td>
                </tr>
                <?php
              endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>