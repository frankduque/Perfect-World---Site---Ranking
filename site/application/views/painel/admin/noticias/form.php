<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7">
  <div class="row">
    <div class="col-xl-12">
      <div class="card shadow">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-uppercase text-muted ls-1 mb-1">Notícias</h6>
              <h2 class="mb-0">
                <?php
                if ($editing) {
                  echo "Editar";
                } else {
                  echo "Nova";
                }
                ?>
                Notícia
              </h2>
            </div>
          </div>
        </div>
        <div class="card-body">
          <?php if (validation_errors() != false): ?>
            <div class="alert alert-danger" role="alert">
              <strong>Erro!</strong>
              <?= validation_errors() ?>
            </div>
          <?php endif; ?>
          <form id="Form" method="post" enctype="multipart/form-data"
            action="<?php echo base_url("admin/noticias/salvar/" . $noticia->id) ?>">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
              value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="row">
              <div class="col-lg-6">
                <h6 class="heading-small text-muted">Noticia em destaque?</h6>
              </div>
              <div class="col-lg-6 text-right">
                <label class="custom-toggle">
                  <input <?= ($noticia->destaque == 1 ? "checked" : null) ?> type="checkbox" name="destaque">
                  <span class="custom-toggle-slider rounded-circle"></span>
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="nome">Título da notícia</label>
                  <input value="<?= $noticia->titulo ?>" required type="text" name="titulo" id="titulo"
                    class="form-control">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="nome">Categoria</label>
                  <select name="categoria" required id="categoria" class="form-control py-0">
                    <option selected disabled="disabled">Selecione uma categoria</option>
                    <?php
                    foreach ($categorias as $id => $categoria):
                      ?>
                      <option <?= ($noticia->categoria_id == $id ? "selected" : "") ?> value="<?php echo $id ?>">
                        <?php echo $categoria ?></option>
                      <?php
                    endforeach;
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="conteudo">Resumo</label>
                  <textarea rows="11" class="form-control" maxlength="200" required
                    name="resumo"><?= $noticia->resumo ?></textarea>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="imagem">Imagem do Header</label>
                  <div class="previewimgcont">
                    <img class="configImage" id="imagem" src="<?= $noticia->arquivo_header ?>">
                  </div>
                  <input type="file" accept=".webp, .png, .jpeg, .jpg, .gif, .svg" onchange="imagempreview(this)"
                    accept="image/*" name="imagem" id="inputimagem" class="d-none">
                  <input type="hidden" id="imagematual" value="<?= $noticia->arquivo_header ?>">
                  <span style="text-align: center;font-size:0px;display: block;">
                    <button onclick="$('#inputimagem').trigger('click');" type="button"
                      class="btn btn-primary mr-0 ml-auto" style="border-radius: 5px 0px 0px 5px;">Selecionar
                      Arquivo</button>
                    <button onclick="limparinputimagem()" class="btn btn-icon btn-2 btn-danger mr-auto rounded-right"
                      style="border-radius: 0px 5px 5px 0px;" type="button">
                      <span class="btn-inner--icon"><i class="fas fa-trash"></i></span>
                    </button>
                  </span>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group focused">
                  <label class="form-control-label" for="conteudo">Conteúdo</label>
                  <textarea id="summernote" required class="form-control"
                    name="conteudo"> <?= html_entity_decode($noticia->conteudo) ?></textarea>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <button id="button" type="submit" class="btn btn-primary btn-lg float-right">Salvar</button>
            <a href="<?php echo base_url("admin/noticias") ?>"
              class="mr-3 btn btn-warning btn-lg float-right">Cancelar</a>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function imagempreview(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#imagem').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    function limparinputimagem() {
      $('#inputimagem').val("");
      $('#imagem').attr('src', document.getElementById("imagematual").value);
    }
  </script>
  <script>
    $(document).ready(function () {
      $('#summernote').summernote({
        popover: {
          image: [],
          link: [],
          air: []
        }
      });
    });
  </script>