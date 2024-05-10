<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
              <h6 class="text-uppercase text-muted ls-1 mb-1">Tutoriais</h6>
              <h2 class="mb-0">Editar Tutorial</h2>
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
          <form id="Form" method="post" action="<?php echo base_url("admin/tutoriais/salvar/" . $tutorial->id) ?>">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="row">
              <div class="col-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="nome">Título do tutorial</label>
                  <input value="<?= $tutorial->titulo ?>" required type="text" name="titulo" id="titulo" class="form-control">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="nome">Categoria</label>
                  <select name="categoria" required id="categoria" class="form-control py-0">
                    <option selected disabled="disabled">Selecione uma categoria</option> 
                    <?php foreach ($categorias as $id => $categoria) : ?>
                        <option <?= ($tutorial->categoria_id == $id ? "selected" : "") ?> value="<?php echo $id ?>"><?php echo $categoria ?></option>
                    <?php endforeach; ?>
                  </select> 
                </div>
              </div>
              <div class="col-12">
                <div class="form-group focused">
                  <label class="form-control-label" for="conteudo">Conteúdo</label>
                  <textarea id="summernote" required class="form-control" name="conteudo"><?= html_entity_decode($tutorial->conteudo) ?></textarea>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <button id="button" type="submit" class="btn btn-primary btn-lg float-right">Salvar</button> 
            <a href="<?php echo base_url("admin/tutoriais") ?>" class="mr-3 btn btn-warning btn-lg float-right">Cancelar</a> 
          </form>
        </div>
      </div>
    </div>
  </div>
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