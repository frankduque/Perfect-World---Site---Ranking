<!-- PAGE NAME START -->
<section class="page-name page-eventos parallax" data-paroller-factor="0.1" data-paroller-type="background"
  data-paroller-direction="vertical">
  <h1 class="page-title"> Eventos </h1>
</section>
<!-- PAGE NAME END -->

<section class="ptb150">
  <span class="title">Eventos


  </span>
  <div class="container">
    <div class="row ">
      <div class="col-xs-12 col-md-3 mt70">
        <ul class="nested-lists py-3" style="background-color:var(--lapis-lazuli)">
          <h3 class="subheading text-center mb30 ">Eventos</h3>
          <ul>
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
                <li class="tutorial-item"><a class="<?= ($i == 1 ? "active show" : "") ?>" data-toggle="pill"
                    href="#tutorial<?= $item->id ?>"><?= $item->titulo ?></a></li>

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

          if (empty($eventos)) {
            echo "Nenhum evento cadastrado";
          }
          foreach ($eventos as $row3):
            ?>
            <div id="evento<?= $row3->id ?>"
              class="tab-pane fade in <?= ($tabactive == $row3->id ? "active show" : "") ?>">
              <h3><?= $row3->titulo ?></h3>
              <?= html_entity_decode($row3->conteudo) ?>
            </div>
          <?php endforeach;

          ?>
        </div>
      </div>

    </div>
  </div>
</section>