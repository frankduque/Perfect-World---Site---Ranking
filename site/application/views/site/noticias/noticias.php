<section class="page-name page-noticias parallax" data-paroller-factor="0.1" data-paroller-type="background"
  data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Notícias
      </h1>
    </div>
  </div>
</section>
<!-- PAGE NAME END -->
<!-- SECTION START -->
<section class="blog-content ptb150 each-element">
  <span class="title">Noticias</span>
  <div class="container">
    <div class="row">
      <!--Main Content-->
      <div class=" col-lg-4">
        <div class="widget-bl subscribe-widget sidebar">
          <h5 class="fsize-20 text-center">Pesquisar noticia</h5>
          <div class="widget-wrapper">
            <form class="subscribe-form" method="get" action="<?= base_url("noticias") ?>">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>">
              <input type="text" name="chavepesquisa" value="<?= set_value('chavepesquisa', $chavepesquisa) ?>" required
                placeholder="Chave da pesquisa">
              <button class="color-white">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </form>
          </div>
        </div>

        <div class="widget-bl categories-widget sidebar">
          <h5 class="fsize-20 text-center">Categorias</h5>
          <div class="widget-wrapper">
            <ul class="list-1">
              <li class="color1">
                <a href="<?= base_url("noticias") ?>">
                  <span><i class="fas fa-check"></i>Todas Categorias</span>
                  <span class="float-right"><?= $totalnoticias ?></span>
                </a>
              </li>
              <?php foreach ($categorias as $categoria): ?>
                <li class="color1">
                  <a href="<?= base_url("noticias/index?categoria_id=" . $categoria->id) ?>">
                    <span><i class="fas fa-check"></i><?= $categoria->nome ?></span>
                    <span class="float-right"><?= $categoria->noticias ?></span>
                  </a>
                </li>
              <?php endforeach; ?>

            </ul>
          </div>
        </div>
        <?php if (count($postsdestaque) >= 1): ?>
          <div class="widget-bl latest-widget sidebar">
            <h5 class="fsize-20 text-center">Posts em Destaque</h5>
            <div class="widget-wrapper">
              <?php
              foreach ($postsdestaque as $postdestaque):
                ?>
                <a href="<?= base_url("noticias/noticia/" . $postdestaque->id) ?>" class="latest-item">
                  <div class="table">
                    <div class="table-row">
                      <div class="latest-img table-cell valign-middle"
                        style="background-image: url(<?= (is_null($postdestaque->arquivo_header) || empty($postdestaque->arquivo_header) ? base_url("assets/site/img/blog-img-1.jpg") : base_url("assets/upload/noticias/" . $postdestaque->arquivo_header)); ?>)">
                      </div>
                      <div class="latest-title table-cell valign-middle pl20">
                        <div class="title-top font-agency fweight-700 uppercase color-white">
                          <?= $postdestaque->titulo ?>
                        </div>
                        <div class="color-2 uppercase fsize-12 fweight-700">
                          <?php
                          $date = date_create($postdestaque->datacriacao);
                          echo date_format($date, "d/m/Y");
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
                <?php
              endforeach;
              ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
      <div class="col-lg-8 flex-first flex-md-unordered">
        <?php
        if (count($noticias) >= 1):
          foreach ($noticias as $noticia):
            ?>
            <article class="vertical-item format-thumb fsize-0 clearfix">
              <div class="item-left-img col-lg-4 col-md-4 col-sm-12 col-xs-12 equal-height"
                style="background-image: url(<?= (is_null($noticia->arquivo_header) || empty($noticia->arquivo_header) ? base_url("assets/site/img/blog-img-1.jpg") : $noticia->arquivo_header) ?>)">
                <?php if ($noticia->destaque == 1): ?>
                  <div class="thumb-icon">
                    <i class="fas fa-star  color-white fsize-14"></i>
                  </div>
                <?php endif; ?>
              </div>
              <div class="post-content col-lg-8 col-md-8 col-sm-12 col-xs-12 equal-height">
                <div class="post-wrapper">
                  <div class="table">
                    <div class="table-row">
                      <div class="table-cell valign-top">
                        <div class="platform fsize-14 fweight-700 uppercase">
                          <?= $noticia->categoria ?>
                        </div>
                      </div>
                      <div class="table-cell valign-top text-right">
                        <div class="fsize-14 fweight-700 uppercase">
                          <?= date_format(date_create($noticia->datacriacao), "d/m/Y"); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mt15">
                    <a href="<?= base_url("noticias/noticia/" . $noticia->id) ?>" class="post-title">
                      <h5><?= $noticia->titulo ?></h5>
                    </a>
                    <div class="fsize-16 lheight-26 mt15" data-trim="140">
                      <?= $noticia->resumo ?>
                    </div>
                  </div>
                </div>
                <div class="post-bottom table">
                  <div class="table-cell valign-middle">
                    <i class="fa fa-user mr-1 color-1 fsize-14" aria-hidden="true"></i>
                    <span class="color-2 fsize-14 ml5">by <?= $noticia->autor; ?></span>
                  </div>
                  <div class="table-cell valign-middle text-right">
                    <i class="fa fa-comment color-1 fsize-14" aria-hidden="true"></i>
                    <span class="color-2 fsize-14 ml5"><span class="disqus-comment-count"
                        data-disqus-url="<?= base_url("noticias/noticia/" . $noticia->id) ?>"></span></span>
                  </div>
                </div>
              </div>
            </article>
            <?php
          endforeach;
        else:
          ?>
          <h5 class="fsize-20 text-center">Nenhuma notícia encontrada</h5>
        <?php endif; ?>


        <div class="col-lg-12 text-center mt60">
          <div class="pagination-page">
            <a href="<?= ($paginaatual == 1 ? "#" : base_url("noticias/index/" . ((int) $paginaatual - 1))) . (isset($chavepesquisa) && !is_null($chavepesquisa) ? "?chavepesquisa=" . set_value("chavepesquisa", $chavepesquisa) : "") . (isset($categoria_id) && !is_null($categoria_id) ? "?categoria_id=" . $categoria_id : ""); ?>"
              class="page-numbers next <?= ($paginaatual == 1 ? "disabled" : ""); ?>">
              <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
            <span class="page-numbers dots">
              Mostrando página <?= $paginaatual ?> de <?= $npaginas ?>
            </span>

            <a href="<?= ($paginaatual == $npaginas ? "#" : base_url("noticias/index/" . ((int) $paginaatual + 1))) . (isset($chavepesquisa) && !is_null($chavepesquisa) ? "?chavepesquisa=" . set_value("chavepesquisa", $chavepesquisa) : "") . (isset($categoria_id) && !is_null($categoria_id) ? "?categoria_id=" . $categoria_id : ""); ?>"
              class="page-numbers next <?= ($paginaatual == $npaginas ? "disabled" : ""); ?>">
              <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- SECTION END -->