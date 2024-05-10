<!-- PAGE NAME START -->
<section class="page-name page-noticia parallax"
  style="background-image: url(<?= (is_null($noticia->arquivo_header) || empty($noticia->arquivo_header) ? base_url("assets/site/img/blog-img-1.jpg") : $noticia->arquivo_header) ?>)"
  data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        <?= $noticia->titulo ?>
      </h1>
    </div>
  </div>
</section>
<section class="ptb150">
  <div class="container">
    <div class="row">
      <div class="full-col col-lg-10 col-md-10 col-md-push-1">
        <div class="posts-nav">
          <div class="row">
            <?php if (!is_null($noticiaanterior) and !empty($noticiaanterior)): ?>
              <div class="col-md-6">
                <a href="<?= base_url("noticias/noticia/" . $noticiaanterior->id) ?>" class="nav_prev nav-btn td-none"
                  style="background-image: url('<?= (is_null($noticiaanterior->arquivo_header) || empty($noticiaanterior->arquivo_header) ? base_url("assets/site/img/blog-img-1.jpg") : $noticiaanterior->arquivo_header); ?>');">
                  <div class="nav_content">
                    <div class="fsize-14 fweight-700 uppercase color-1">Notícia anterior</div>
                    <div class="nav-title font-agency fsize-24 fweight-700 color-white uppercase">
                      <?= $noticiaanterior->titulo ?></div>
                  </div>
                </a>
              </div>
            <?php else: ?>
              <div class="col-md-6">
              </div>
              <?php
            endif;
            if (!is_null($proximanoticia) and !empty($proximanoticia)):
              ?>
              <div class="col-md-6 text-right">
                <a href="<?= base_url("noticias/noticia/" . $proximanoticia->id) ?>" class="nav_prev nav-btn td-none"
                  style="background-image: url('<?= (is_null($proximanoticia->arquivo_header) || empty($proximanoticia->arquivo_header) ? base_url("assets/site/img/blog-img-1.jpg") : $proximanoticia->arquivo_header); ?>');">
                  <div class="nav_content">
                    <div class="fsize-14 fweight-700 uppercase color-1">Próxima notícia</div>
                    <div class="nav-title font-agency fsize-24 fweight-700 color-white uppercase">
                      <?= $proximanoticia->titulo ?></div>
                  </div>
                </a>
              </div>
            <?php else: ?>
              <div class="col-md-6 text-right">
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="post-content mt60">
          <div class="post-bottom background-4">
            <div class="p60">
              <div class="table ">
                <div class="table-row">
                  <div class="table-cell valign-top">
                    <div class="fsize-14 fweight-700 uppercase color-1">
                      <a href="<?= base_url("noticias?categoria_id=" . $noticia->categoria_id) ?>"
                        class="color-1"><?= $noticia->categoria ?></a>
                    </div>
                  </div>
                  <div class="table-cell valign-top text-right">
                    <div class="fsize-14 fweight-700 uppercase">
                      <?= date_format(date_create($noticia->datacriacao), "d/m/Y"); ?>
                    </div>
                  </div>
                </div>

              </div>
              <h1 class="page-title text-center mb" style="margin-bottom: 50px;">
                <?= $noticia->titulo ?>
              </h1>
              <?= html_entity_decode($noticia->conteudo) ?>
            </div>
            <div class="bottom-info-bl">
              <div class="table">
                <div class="table-cell valign-middle">
                  <i class="fa fa-user color-6 fsize-14" aria-hidden="true"></i>
                  <span class="color-2 fsize-14 ml5">by <?= $noticia->autor ?></span>
                </div>
                <div class="table-cell valign-middle text-right">
                  <i class="fa fa-comment color-6 fsize-14" aria-hidden="true"></i>
                  <span class="color-2 fsize-14 ml5"><span class="disqus-comment-count"
                      data-disqus-identifier="noticia<?= $noticia->id ?>"></span></span>
                </div>
              </div>
            </div>
          </div>
          <?php if ($this->config->item("usardisqus") == 1 and !is_null($this->config->item("disqusshortname"))): ?>
            <div id="disqus_thread"></div>
            <script>
              var disqus_config = function () {
                this.page.url = "<?= base_url("noticias/noticia/" . $noticia->id) ?>";  // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = "noticia<?= $noticia->id ?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
              };
              (function () { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');
                s.src = 'https://<?= $this->config->item("disqusshortname") ?>.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
              })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
                Disqus.</a></noscript>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
</section>