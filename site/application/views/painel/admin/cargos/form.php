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
              <h6 class="text-uppercase text-muted ls-1 mb-1">Cargos</h6>
              <h2 class="mb-0"><?php
              if ($cargo->id) {
                echo "Editar Cargo";
              } else {
                echo "Novo Cargo";
              }
              ?> </h2>
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
          <form id="Form" method="post" action="<?php echo base_url("admin/cargos/salvar/" . $cargo->id) ?>">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
              value="<?php echo $this->security->get_csrf_hash(); ?>">

            <div class="row">
              <div class="col">
                <div class="form-group focused">
                  <label class="form-control-label" for="nomecargo">Nome do cargo</label>
                  <input value="<?= $cargo->cargo ?>" required type="text" name="nomecargo" id="nomecargo"
                    class="form-control">
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col">
                <div class="form-group focused">
                  <label class="h2" for="permissoes">Permissões</label>
                  <div class="row">

                    <?php
                    if ($cargo->id) {
                      $permcargo = json_decode($cargo->permissoes);
                    } else {
                      $permcargo = [];
                    }

                    foreach ($permissoes as $permissao):
                      ?>
                      <div class="col-md-3">
                        <div class="custom-control custom-checkbox mb-3">

                          <input class="custom-control-input" <?= (is_array($permcargo) && in_array($permissao, $permcargo) ? "checked" : null) ?> value="<?= $permissao ?>" name="permissoes[]"
                            id="checkbox<?= $permissao ?>" type="checkbox">
                          <label class="custom-control-label" for="checkbox<?= $permissao ?>"><?= $permissao ?></label>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>

                </div>
              </div>
            </div>
            <hr class="my-4">
            <button id="button" type="submit" class="btn btn-primary btn-lg float-right">Salvar</button>
            <a href="<?php echo base_url("admin/cargos") ?>"
              class="mr-3 btn btn-warning btn-lg float-right">Cancelar</a>

          </form>
        </div>
      </div>
    </div>
  </div>