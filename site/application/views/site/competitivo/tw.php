<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-name page-tw parallax" data-paroller-factor="0.1" data-paroller-type="background"
	data-paroller-direction="vertical">
	<div class="container">
		<div class="row">
			<h1 class="page-title"> Guerras Territoriais </h1>
		</div>
	</div>
</section>
<section class="team-bl ptb150">
	<div class="container">
		<div class="tm-tabs">
			<div class="tab-content relative">
				<span class="title pt-5">Guerras Territoriais</span>
				<div class="row" id="tab-item-1">
					<div class="tab-info col-lg-6 col-md-12 col-sm-12 col-xs-12 equal-height">
						<section class="clan">
							<ul class="px-4">
								<?php
								$i = 1;
								if (empty($ranking)):
									?>
									<li class="button highlight color_0">
										<p class="text-dark py-3 font-weight-bold">Nenhum território conquistado</p>
									</li>
									<?php
								endif;
								foreach ($ranking as $guild):
									$icone = get_guild_icon($icones, $guild->owner);
									?>
									<li data-color="<?= $guild->color ?>"
										class="button highlight color_<?= $guild->color ?> ">
										<?= ($i == 1 || $i == 2 || $i == 3 ? "<img src='" . base_url("assets/site/img/ranking/medalha" . $i . ".png") . "' class='loading' data-was-processed='true'>" : "") ?>
										<div>
											<a href="<?= base_url("competitivo/clan/" . $guild->owner) ?>">
												<h2>
													<?= (!empty($icone) ? ($icone['default'] ? '<img class="iconmap" style="margin-right: 0px;position:static;" src="' . base_url("assets/upload/guildicons/ico.png") . '">' : '<img class="iconmap" style="margin-right: 0px;position:static;background-position-y:' . ($icone['linha'] > 1 ? ($icone['linha'] - 1) * -19.5 : 0) . 'px; background-position-x:' . ($icone['coluna'] > 1 ? ($icone['coluna'] - 1) * -19.5 : 0) . 'px" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">') : "") ?>
													<?= $guild->guild_nome ?>
												</h2>
											</a>
											<span>Territórios Conquistados: </span>
											<?php
											foreach ($territorios as $territorio) {
												echo ($territorio->owner == $guild->guild_id ? '<h3 class="mapaconquistado" data-id="' . $territorio->id . '">' . $this->config->item('mapas')[$territorio->id] . ',</h3>' : "");
											}
											?>
										</div>
									</li>
									<?php
									$i++;
								endforeach;
								?>
							</ul>
						</section>
					</div>
					<div class="tab-img col-lg-6 col-md-12 col-sm-12 col-xs-12 pr0 equal-height ">
						<main class="ranking">
							<section class="maps">
								<ul>
									<?php

									foreach ($territorios as $territorio):
										$icone = get_guild_icon($icones, $territorio->owner);
										?>
										<li
											class="limapa map<?= ($territorio->id < 10 ? "0" . $territorio->id : $territorio->id) ?>">
											<?= (!empty($icone) ? ($icone['default'] ? '<img id="iconecla" data-id="' . $territorio->owner . '" title="<b>' . ($territorio->owner > 0 ? $territorio->guild_nome : "Nenhum") . ' </b>" data-toggle="tooltip" data-placement="left" data-html="true" class="iconmap iconmap' . $territorio->id . '" style="background-position-y:' . ($icone['linha'] > 1 ? ($icone['linha'] - 1) * -19.5 : 0) . 'px; background-position-x:' . ($icone['coluna'] > 1 ? ($icone['coluna'] - 1) * -19.5 : 0) . 'px" src="' . base_url("assets/upload/guildicons/ico.png") . '">' : '<img id="iconecla" data-id="' . $territorio->owner . '" title="<b>' . ($territorio->owner > 0 ? $territorio->guild_nome : "Nenhum") . '</b>" data-toggle="tooltip" data-placement="left" data-html="true" class="iconmap iconmap' . $territorio->id . '" style="background-position-y:' . ($icone['linha'] > 1 ? ($icone['linha'] - 1) * -19.5 : 0) . 'px; background-position-x:' . ($icone['coluna'] > 1 ? ($icone['coluna'] - 1) * -19.5 : 0) . 'px" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">') : "") ?>
											<img data-id="<?= $territorio->id; ?>" data-toggle="tooltip"
												data-placement="left" data-html="true"
												title="<b>Nome: <?= $this->config->item('mapas')[$territorio->id] ?> <br> Nível: <?= $territorio->level ?> <br> Governante: <?= ($territorio->owner > 0 ? $territorio->guild_nome : "Nenhum"); ?> <br> Invasor: <?= ($territorio->challenger > 0 ? $guilds[$territorio->challenger]->guild_nome : "Nenhum"); ?></b>"
												src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
												class="mapa<?= $territorio->id ?> <?= "color_front_" . $territorio->color ?>"
												data-was-processed="true">
										</li>
									<?php endforeach; ?>
									<li class="grid"><img src="<?= base_url() ?>assets/site/img/ranking/grid.png"
											style="filter: brightness(2);" class="loading" data-was-processed="true">
									</li><!-- Grid normal 0x0, grid grosso -1x-1 -->
									<li style='width:0px;height:0px;'><img class="bigcastle01 loading"
											src="<?= base_url() ?>assets/site/img/ranking/castelo-grande.png"
											data-was-processed="true"></li>
									<li style='width:0px;height:0px;'><img class="bigcastle02 loading"
											src="<?= base_url() ?>assets/site/img/ranking/castelo-grande.png"
											data-was-processed="true"></li>
									<li style='width:0px;height:0px;'><img class="castle01 loading"
											src="<?= base_url() ?>assets/site/img/ranking/castelo-pequeno.png"
											data-was-processed="true"></li>
									<li style='width:0px;height:0px;'><img class="castle02 easteregg loading"
											src="<?= base_url() ?>assets/site/img/ranking/castelo-pequeno.png"
											data-was-processed="true"></li>
									<li style='width:0px;height:0px;'><img class="castle03 loading"
											src="<?= base_url() ?>assets/site/img/ranking/castelo-pequeno.png"
											data-was-processed="true"></li>
									<li style='width:0px;height:0px;'><img class="castle04 loading"
											src="<?= base_url() ?>assets/site/img/ranking/castelo-pequeno.png"
											data-was-processed="true"></li>
									<li style='width:0px;height:0px;'><img class="castle05 loading"
											src="<?= base_url() ?>assets/site/img/ranking/castelo-pequeno.png"
											data-was-processed="true"></li>
									<li style='width:0px;height:0px;'><img class="castle06 loading"
											src="<?= base_url() ?>assets/site/img/ranking/castelo-pequeno.png"
											data-was-processed="true"></li>
									<li style='width:0px;height:0px;'><img class="castle07 loading"
											src="<?= base_url() ?>assets/site/img/ranking/castelo-pequeno.png"
											data-was-processed="true"></li>
								</ul>
							</section>
						</main>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- TEAM END -->
<script>
</script>