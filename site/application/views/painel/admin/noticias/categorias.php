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
              <h2 class="mb-0">Categorias</h2>
            </div>
            <div class="col text-right">
              <button class="btn btn-primary" id="botaoAdicionar" data-toggle="modal" data-target="#modalForm">Nova
                Categoria</button>
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
          <div class="row">
            <div class="col-md-12">
              <table id="dataTable" class="table table-striped table-bordered nowrap hover table-sm">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Data Criação</th>
                    <th scope="col">Opções</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($categorias as $categoria):
                    ?>
                    <tr class='clickable-row'>
                      <td><span class="font-weight-bold"><?php echo $categoria->id; ?></span></td>
                      <td><span class="font-weight-bold"><?php echo $categoria->nome; ?></span></td>
                      <td><span class="font-weight-bold"><?php echo $categoria->datacriacao; ?></span></td>
                      <td class="text-center">
                        <div class="dropdown">
                          <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item btneditar" href="#" data-id="<?php echo $categoria->id ?>"
                              data-nome="<?php echo $categoria->nome ?>">Editar</i></a>
                            <a class="dropdown-item btndeletar" href="#"
                              data-id="<?php echo $categoria->id ?>">Deletar</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <?php
                  endforeach;
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade bd-example-modal-lg" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalForm"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title h4" id="myLargeModalLabel">Editar categoria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="Form" method="post" action="<?php echo base_url("admin/noticias/salvar_categoria") ?>">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
              value="<?php echo $this->security->get_csrf_hash(); ?>">

            <input required type="hidden" id="ideditar" name="id">
            <div class="row">
              <div class="col">
                <div class="form-group focused">
                  <label class="form-control-label" for="nomecategoria">Nome da categoria</label>
                  <input required type="text" name="nome" id="nomeeditar" class="form-control">
                </div>
              </div>
            </div>
            <hr class="my-4">
            <button id="button" type="submit" class="btn btn-primary btn-lg float-right">Salvar</button>
            <button type="button" data-dismiss="modal" aria-label="Fechar"
              class="mr-3 btn btn-warning btn-lg float-right">Cancelar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      $(".btndeletar").click(function () {
        Swal.fire({
          title: 'Tem certeza?',
          text: "Deseja realmente deletar esta categoria?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Deletar'
        }).then((result) => {
          if (result.value) {
            window.location = "<?php echo base_url('admin/noticias/deletar_categoria/') ?>" + this.getAttribute('data-id');
          }
        });
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      $(".btneditar").click(function () {
        $("#ideditar").val(this.getAttribute('data-id'));
        $("#nomeeditar").val(this.getAttribute('data-nome'));
        $('#modalForm').modal('show');
      });

      $("#botaoAdicionar").click(function () {
        $("#ideditar").val("0");
        $("#nomeeditar").val("");
        $('#modalForm').modal('show');
      });


    });
  </script>