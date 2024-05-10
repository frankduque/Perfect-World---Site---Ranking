<section class="video-container">
	<video autoplay muted loop id="myVideo">
		<source src="./assets/site/videos/home_video2.mp4" type="video/mp4">
	</video>
	<div class="video-overlay">
		<h1 class=" text-white">Bem vindo ao <br><?= $this->config->item("nomeservidor") ?></h1>
		<p class=" text-white mt-3">Um servidor privado de Perfect World, o seu MMORPG favorito. <br>
			Junte-se a nós e embarque em aventuras incríveis!</p>
		<div class="button-container mt-4">
			<a href="<?= $this->config->item("linkpainel") ?>" class="btn header-btn ml25 color-white">
				Jogar Agora
			</a>
			<a href="./informacoes/servidor" class="btn header-btn2 ml25 color-white">
				Saiba Mais
			</a>
		</div>
	</div>
</section>

<?php
if (count($noticias) >= 1):
	?>

	<section class="blog-section ptb90">



		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="title">ULTIMAS NOTICIAS</span>
				</div>
			</div>
		</div>
		<div class="bg-wrapper each-element clearfix">
			<div class="container">
				<div class="row">
					<?php
					foreach ($noticias as $noticia):
						?>
						<div class="mt-4 item col-lg-4 col-md-4 col-sm-12 col-sx-12 first">
							<a href="<?= base_url("noticias/noticia/" . $noticia->id) ?>" class="item-wrap">
								<div class="image"
									style="background-image: url(<?= (is_null($noticia->arquivo_header) || empty($noticia->arquivo_header) ? base_url("assets/site/img/blog-img-1.jpg") : $noticia->arquivo_header) ?>)">
								</div>
								<div class="item-info equal-height" style="height: 250px;">
									<div class="item-header table fsize-14 fweight-700 uppercase">
										<div class="table-cell platform"><?= $noticia->categoria ?></div>
										<div class="table-cell color-2 text-right">
											<?= date_format(date_create($noticia->datacriacao), "d/m/Y") ?>
										</div>
									</div>
									<div class="item-title mt20"><?= $noticia->titulo ?></div>
									<div class="item-text mt25">
										<?= $noticia->resumo ?>...
									</div>
								</div>
								<div class="author-comment table">
									<div class="table-cell valign-middle">
										<i class="fa fa-user color-1 fsize-14" aria-hidden="true"></i>
										<span class="color-2 ml5">by <?= $noticia->autor ?></span>
									</div>
									<div class="table-cell valign-middle text-right">
										<i class="fa fa-comment color-1 fsize-14" aria-hidden="true"></i>
										<span class="color-2 ml5"><span class="disqus-comment-count"
												data-disqus-url="<?= base_url("noticias/noticia/" . $noticia->id) ?>"></span></span>
									</div>
								</div>
							</a>
						</div>
						<?php
					endforeach;
					?>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;
?>
<section class="index-classes">
	<span class="title">Classes</span>
	<div class="container">
		<div class="slider-classes">
			<div class="slider-classe-container">
				<a href="<?= base_url("classes/guerreiro") ?>">
					<div class="img-wrap">
						<img src="<?= base_url() ?>assets/site/img/classe-guerreiro.png" alt="">
					</div>
					<span class="pt-4 classe">
						Guerreiro
					</span>
				</a>
			</div>
			<div>
				<div class="slider-classe-container">
					<a href="<?= base_url("classes/mago") ?>">
						<div class="img-wrap">
							<img src="<?= base_url() ?>assets/site/img/classe-mago.png" alt="">
						</div>
						<span class="pt-4 classe">
							Mago
						</span>
					</a>
				</div>
			</div>
			<div>
				<div class="slider-classe-container">
					<a href="<?= base_url("classes/barbaro") ?>">
						<div class="img-wrap">
							<img src="<?= base_url() ?>assets/site/img/classe-barbaro.png" alt="">
						</div>
						<span class="pt-4 classe">
							Bárbaro
						</span>
					</a>
				</div>
			</div>
			<div>
				<div class="slider-classe-container">
					<a href="<?= base_url("classes/feiticeira") ?>">
						<div class="img-wrap">
							<img src="<?= base_url() ?>assets/site/img/classe-feiticeira.png" alt="">
						</div>
						<span class="pt-4 classe">
							Feiticeira
						</span>
					</a>
				</div>
			</div>
			<div>
				<div class="slider-classe-container">
					<a href="<?= base_url("classes/arqueiro") ?>">
						<div class="img-wrap">
							<img src="<?= base_url() ?>assets/site/img/classe-arqueiro.png" alt="">
						</div>
						<span class="pt-4 classe">
							Arqueiro
						</span>
					</a>
				</div>
			</div>
			<div>
				<div class="slider-classe-container">
					<a href="<?= base_url("classes/sacerdote") ?>">
						<div class="img-wrap">
							<img src="<?= base_url() ?>assets/site/img/classe-sacerdote.png" alt="">
						</div>
						<span class="pt-4 classe">
							Sacerdote
						</span>
					</a>
				</div>
			</div>
			<div>
				<div class="slider-classe-container">
					<a href="<?= base_url("classes/mercenario") ?>">
						<div class="img-wrap">
							<img src="<?= base_url() ?>assets/site/img/classe-mercenario.png" alt="">
						</div>
						<span class="pt-4 classe">
							Mercenário
						</span>
					</a>
				</div>
			</div>
			<div>
				<div class="slider-classe-container">
					<a href="<?= base_url("classes/espiritualista") ?>">
						<div class="img-wrap">
							<img src="<?= base_url() ?>assets/site/img/classe-espiritualista.png" alt="">
						</div>
						<span class="pt-4 classe">
							Espiritualista
						</span>
					</a>
				</div>
			</div>
			<div>
				<div class="slider-classe-container">
					<a href="<?= base_url("classes/arcano") ?>">
						<div class="img-wrap">
							<img src="<?= base_url() ?>assets/site/img/classe-arcano.png" alt="">
						</div>
						<span class="pt-4 classe">
							Arcano
						</span>
					</a>
				</div>
			</div>
			<div>
				<div class="slider-classe-container">
					<a href="<?= base_url("classes/mistico") ?>">
						<div class="img-wrap">
							<img src="<?= base_url() ?>assets/site/img/classe-mistico.png" alt="">
						</div>
						<span class="pt-4 classe">
							Místico
						</span>
					</a>
				</div>
			</div>
			<div>
				<div class="slider-classe-container">
					<a href="<?= base_url("classes/retalhador") ?>">
						<div class="img-wrap">
							<img src="<?= base_url() ?>assets/site/img/classe-retalhador.png" alt="">
						</div>
						<span class="pt-4 classe">
							Retalhador
						</span>
					</a>
				</div>
			</div>
			<div>
				<div class="slider-classe-container">
					<a href="<?= base_url("classes/tormentador") ?>">
						<div class="img-wrap">
							<img src="<?= base_url() ?>assets/site/img/classe-tormentador.png" alt="">
						</div>
						<span class="pt-4 classe">
							Tormentador
						</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="pb60 pt60">
	<div class="container">
		<div class="title-bl text-center wow fadeIn" data-wow-duration="2s">
			<div class="title color-white text-center">
				Sobre o Servidor
			</div>
		</div>
		<div class="text-center">
			Conheça um pouco sobre o servidor
		</div>
		<div class="tm-tabs">
			<div class="tab-content relative mt90">
				<div class="row">
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ptb90 p60 equal-height">
						<div class="tab-head table uppercase fsize-14 fweight-700">
							<div class="table-cell valign-middle color-1">
								Rate ALTA 1.5.5
							</div>
						</div>
						<div class="uppercase fsize-32 fweight-700 font-agency color-white lheight-normal">
							<?= $this->config->item("nomeservidor") ?>
						</div>
						<div class="mt50 lheight-26 fweight-300">
							<br>
							<p>O <?= $this->config->item("nomeservidor") ?> foi desenvolvido para estimular a competição
								entre os
								players. Nossa equipe desenvolveu diversos scripts para tornar o PVP, GVG e TW
								ainda mais atrativos.</p>
							<p>Nosso servidor possui um sistema de Farm facilitado, estão disponíveis diversos
								locais onde você poderá farmar seu set endgame. </p>
							<div class="table-cell valign-middle color-1">
								Informações Gerais
							</div>
							<p class="mb-0">Servidor rate ALTA</p>
							<p class="mb-0">Versão 1.5.5</p>
							<p class="mb-0">Foco PVP competitivo</p>
							<p>Início level 105 God/Evil3</p>

						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ptb90 p60 equal-height">
						<div class="tab-head table uppercase fsize-14 fweight-700">
							<div class="table-cell valign-middle color-1">
								&nbsp;
							</div>
						</div>
						<div class="uppercase fsize-32 fweight-700 font-agency color-white lheight-normal">
							Mais Informações
						</div>
						<br>
						<div class="table-cell valign-middle color-1">
							Set Early Game
						</div>
						<p>SET R8 UP2 + 12, Ornamento do Brado Up3 , Colar do Cubo Up3, Anéis Marca do gelo
							eterno e Simbolo da Preservacao Natural.</p>
						<div class="table-cell valign-middle color-1">
							Set End Game
						</div>
						<p>R8UP3, Combo Kestra e Acessórios G16 e G17 </p>
						<div class="table-cell valign-middle color-1">
							Extras
						</div>
						<p class="mb-0">Astrolábio</p>
						<p class="mb-0">Cartas A Combo Soberano</p>
						<p class="mb-0">Passivas New Horizonte</p>
						<p class="mb-0">Skills Ultimate</p>
						<p>Ceu Mirage~Oscilante</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="pb150 pt60">
	<div class="container">
		<div class="title-bl text-center wow fadeIn" data-wow-duration="2s">
			<div class="title color-white text-center">
				Começe a jogar
			</div>
		</div>
		<div class="text-center">
			Tire todas as suas dúvidas aqui nesta seção e venha jogar conosco.
		</div>
		<div class="faq-container mt90 row">
			<div class="left-column-1 column col-lg-6 col-md-6 col-sm-12 col-xs-12" style="float: left;">
				<div class="table">
					<div class="table-row">
						<div class="counter-round table-cell valign-top">
							<div class="counter-bl">
								01
							</div>
						</div>
						<div class="counter-content table-cell valign-top" style="vertical-align: middle;">
							<div class="counter-title">Crie sua conta</div>
							<div class="counter-text mt25">
								O primeiro passo para começar a jogar o <?= $this->config->item("nomeservidor") ?> é
								criar sua conta. O
								processo é bem simples, acesse a área de registro no nosso painel <a
									href="<?= $this->config->item("linkpainel") ?>">clicando aqui</a>.
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="right-column-2 column col-lg-6 col-md-6 col-sm-12 col-xs-12" style="float: right;">
				<div class="table">
					<div class="table-row">
						<div class="counter-content table-cell valign-top  text-right" style="vertical-align: middle;">
							<div class="counter-title">Faça o download do jogo</div>
							<div class="counter-text mt25">
								Pronto, agora é só baixar o client do jogo. Você pode escolher entre várias
								opções para realizar o download. Acesse a página de downloads <a
									href="./downloads">clicando aqui</a>.
							</div>
						</div>
						<div class="counter-round table-cell valign-top">
							<div class="counter-bl">
								02
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="left-column-3 column col-lg-6 col-md-6 col-sm-12 col-xs-12" style="float: left;">
				<div class="table">
					<div class="table-row">
						<div class="counter-round table-cell valign-top">
							<div class="counter-bl">
								03
							</div>
						</div>
						<div class="counter-content table-cell valign-top" style="vertical-align: middle;">
							<div class="counter-title">Saiba mais</div>
							<div class="counter-text mt25">
								Fique por dentro de tudo o que está acontecendo no nosso servidor, <a href="#">Guia para
									iniciantes</a>, <a href="#">Nossos eventos</a>, <a href="#">Competitivo</a>, <a
									href="#">Tutoriais diversos</a>, <a href="#">Notícias</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="right-column-4 column col-lg-6 col-md-6 col-sm-12 col-xs-12" style="float: right;">
				<div class="table">
					<div class="table-row">
						<div class="counter-content table-cell valign-top text-right" style="vertical-align: middle;">
							<div class="counter-title">Nos ajude a crescer</div>
							<div class="counter-text mt25">
								Com doações a partir de R$4,99 você pode nos ajudar a manter nosso servidor
								crescendo e nos motiva a continuar trazendo novidades ao servidor. <a href="">Doar
									agora</a>
							</div>
						</div>
						<div class="counter-round table-cell valign-top">
							<div class="counter-bl">
								04
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>