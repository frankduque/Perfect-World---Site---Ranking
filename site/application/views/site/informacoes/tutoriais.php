<!-- PAGE NAME START -->
<section class="page-name page-tutoriais parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <h1 class="page-title">Tutoriais</h1>
</section>
<!-- PAGE NAME END -->

<section class="ptb150">
  <span class="title">Tutoriais</span>
  <div class="container">
    <div class="row ">
      <div class="col-xs-12 col-md-3 mt70">
        <ul class="nested-lists py-3" style="background-color:var(--lapis-lazuli)">
          <h3 class="subheading text-center mb30 ">Tutoriais</h3>
          <ul class="nav nav-pills">
              <?php
              $i = 1;
              foreach ($categorias as $k => $categoria):
                  ?>
                <li class="tutoriais"> <?= $k ?>
                    <?php
                    foreach ($categoria as $item):
                        if ($i == 1) {
                            $tabactive = $item->id;
                        }
                        ?>
                    <li class="tutorial-item"><a class="<?= ($i == 1 ? "active show" : "") ?>" data-toggle="pill" href="#tutorial<?= $item->id ?>"><?= $item->titulo ?></a></li>

                    <?php
                    $i++;
                endforeach;
                ?>
                </li>
            <?php endforeach;
            ?>
          </ul>
        </ul>
      </div>
      <div class="col-md-9 col-xs-12 mt70">
        <div class="tab-content" style="background-color:var(--lapis-lazuli);padding: 30px;">
            <?php
            foreach ($tutoriais as $tutorial):
                ?>
              <div id="tutorial<?= $tutorial->id ?>" class="tab-pane fade in <?= ($tabactive == $tutorial->id ? "active show" : "") ?>">
                <h3><?= $tutorial->titulo ?></h3>
                <?= html_entity_decode($tutorial->conteudo) ?>
              </div>
              <?php
          endforeach;
          ?>
        </div>
      </div>

    </div>
  </div>
</section>