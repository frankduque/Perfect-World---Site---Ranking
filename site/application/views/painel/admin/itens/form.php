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
              <h6 class="text-uppercase text-muted ls-1 mb-1">Itens</h6>
              <h2 class="mb-0">
                <?php if ($editing) {
                  echo "Editar Itens";
                } else {
                  echo "Novo Itens";
                }
                ?>
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
            action="<?php echo base_url("admin/itens/salvar/" . $item->id) ?>">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
              value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="row">
              <div class="col-2">
                <div class="form-group focused">
                  <input type="file" id="inputimagem" name="imagem" style="display: none;"
                    onchange="imagempreview(this)">
                  <label class="form-control-label" for="nome">Imagem</label><br>
                  <input type="hidden" id="imagematual"
                    value="<?php echo base_url("uploads/itens/" . $item->imagem); ?>">
                  <img id="imagem" src="<?php echo $item->imagem; ?>" class="img-fluid mt-2" style="max-height: 32px;">

                  <button type="button" onclick="$('#inputimagem').click()" class="btn btn-primary btn-sm mt-2">
                    <i class="fas fa-upload"></i> Upload
                  </button>
                  <button type="button" onclick="limparinputimagem()" class="btn btn-danger btn-sm mt-2">
                    <i class="fas fa-trash"></i> Limpar
                  </button>

                </div>
              </div>
              <div class="col-2">
                <div class="form-group">
                  <label class="form-control-label" for="nome">ID</label>
                  <input required type="number" value="<?php echo $item->itemid; ?>" name="itemid" class="form-control">
                </div>
              </div>

              <div class="col-4">
                <div class="form-group">
                  <label class="form-control-label" for="nome">Nome</label>
                  <input required type="text" value="<?php echo $item->nome; ?>" name="nome" class="form-control">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label class="form-control-label" for="nome">Cor</label>
                  <input type="text" value="<?php echo $item->cor; ?>" name="cor" class="form-control">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label class="form-control-label" for="nome">Descrição</label>
                  <textarea id="summernote" name="descricao" class="form-control"
                    rows="4"><?php echo $item->descricao; ?></textarea>
                </div>
              </div>
              <div class="col-12">
                <h2 class="mb-0 mt-4">Item Data</h2>
                <hr class="my-4">
              </div>

              <div class="col-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="pos">POS</label>
                  <input required type="number" value="<?php echo $item->pos; ?>" name="pos" id="pos"
                    class="form-control">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="count">Count</label>
                  <input required type="number" value="<?php echo $item->count; ?>" name="count" id="count"
                    class="form-control">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="max_count">Max_count</label>
                  <input required type="number" value="<?php echo $item->max_count; ?>" name="max_count" id="max_count"
                    class="form-control">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="data">Data</label>
                  <input required type="text" value="<?php echo $item->data; ?>" name="data" id="data"
                    class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group focused">
                  <label class="form-control-label" for="proctype">Proctype</label>
                  <input required type="number" value="<?php echo $item->proctype; ?>" name="proctype" id="proctype"
                    class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group focused">
                  <label class="form-control-label" for="expire_date">Expire_date</label>
                  <input required type="number" value="<?php echo $item->expire_date; ?>" name="expire_date"
                    id="exp_date" class="form-control">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="guid1">Guid1</label>
                  <input required type="number" value="<?php echo $item->guid1; ?>" name="guid1" id="guid1"
                    class="form-control">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="guid2">Guid2</label>
                  <input required type="number" value="<?php echo $item->guid2; ?>" name="guid2" id="guid2"
                    class="form-control">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="mask">Mask</label>
                  <input required type="number" value="<?php echo $item->mask; ?>" name="mask" id="mask"
                    class="form-control">
                </div>
              </div>
            </div>
            <hr class="my-4">
            <button id="button" type="submit" class="btn btn-primary btn-lg float-right">Salvar</button>
            <a href="<?php echo base_url("admin/itens") ?>" class="mr-3 btn btn-warning btn-lg float-right">Cancelar</a>
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