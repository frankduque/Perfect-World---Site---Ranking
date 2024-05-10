<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<form id="Form" method="post" action="<?php echo base_url("admin/itens/bulkdelete") ?>">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
    value="<?php echo $this->security->get_csrf_hash(); ?>">
  <div class="container-fluid mt--7">
    <div class="row">
      <div class="col-xl-12">
        <div class="card shadow">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">Itens</h6>
                <h2 class="mb-0">Lista de Itens</h2>
              </div>
              <div class="col text-right">
                <button type="button" id="bulkdelete" class="btn btn-danger">Bulk Delete</button>
                <a class="btn btn-primary" href="<?php echo base_url("admin/itens/form") ?>">Novo Item</a>
                <button type="button" class="btn btn-secondary" id="botao_adicionar" data-toggle="modal"
                  data-target=".bd-example-modal-lg">Importar Itens</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <table id="ajaxTable" class="table table-flush">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="selectAll"></th>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Descrição</th>
                      <th>Imagem</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>
<div class="modal fade bd-example-modal-lg" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalForm"
  aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="myLargeModalLabel">Importar Itens</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="Form" method="post" action="<?php echo base_url("admin/itens/importar") ?>"
          enctype="multipart/form-data">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
            value="<?php echo $this->security->get_csrf_hash(); ?>">

          <div class="form-group focused">
            <label class="form-control-label" for="nomecategoria"> Importar RAE (.tab)</label>
            <input type="file" class="form-control" name="rae" id="rae">
          </div>
          <div class="form-group focused">
            <label class="form-control-label" for="nomecategoria"> Icones (.zip)</label>
            <input type="file" class="form-control" name="icones" id="icones">

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

    <?php if (null !== $this->session->flashdata('update_rae_data')): ?>
      $.ajax({
        url: "<?php echo base_url('admin/itens/processar_rae') ?>",
        type: "POST",
        data: {
          update_rae_data: true,
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'


        },
        success: function (data) {
          Swal.fire({
            type: 'success',
            title: 'Itens importados com sucesso',
            text: 'Os itens foram importados com sucesso.',
          })
        }
      });
    <?php endif; ?>
    <?php if (null !== $this->session->flashdata('update_icones')): ?>
      $.ajax({
        url: "<?php echo base_url('admin/itens/processar_icones') ?>",
        type: "POST",
        data: {
          update_icones: true,
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'


        },
        success: function (data) {
          Swal.fire({
            type: 'success',
            title: 'Itens importados com sucesso',
            text: 'Os itens foram importados com sucesso.',
          })
        }
      });
    <?php endif; ?>

    let $table = $("#ajaxTable");
    $table.DataTable({
      "processing": true,
      "serverSide": true,
      "ordering": false,
      "ajax": {
        "url": "<?php echo base_url('admin/itens/ajax_list') ?>",
        "type": "POST",
        "data": function (d) {
          d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
        }
      },
      "columns": [{
        "data": "id",
        "render": function (data, type, row) {
          return '<input type="checkbox" name="ids[]" value="' + data + '">';
        }
      },
      {
        "data": "itemid"
      },
      {
        "data": "nome"
      },
      {
        "data": "descricao"
      },
      {
        "data": "itemid",
        "render": function (data, type, row) {
          return '<img src="<?php echo base_url('/assets/site/img/personagem/icones/') ?>' + data + '.png" class="img-thumbnail'
            + ' style = "width: 50px; height: 50px;" '
            + ' onerror = "this.onerror=null;this.src=\'<?php echo base_url('assets/site/img/personagem/icones/0.png') ?>\'" > ';
        }
      },
      {
        "data": "id",
        "render": function (data, type, row) {
          return '<a href="<?php echo base_url('admin/itens/form/') ?>' + data + '" class="btn btn-primary">Editar</a>';
        }
      }
      ]

    });
  })

</script>

<script>
  $(document).ready(function () {
    $("#bulkdelete").click(function () {
      var atLeastOneIsChecked = false;
      $('input:checkbox').each(function () {
        if ($(this).is(':checked')) {
          atLeastOneIsChecked = true;
          // Stop .each from processing any more items
          return false;
        }
      });
      if (atLeastOneIsChecked) {
        Swal.fire({
          title: 'Tem certeza?',
          text: "Deseja realmente deletar os itens selecionados?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Deletar'
        }).then((result) => {
          if (result.value) {
            $("#Form").submit();
          }
        });
      } else {
        Swal.fire({
          title: 'Nenhuma item selecionado',
          text: "É necessário marcar pelo menos um item.",
          type: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Deletar'
        });
      }
    });
  });
</script>
<script>
  $('#selectAll').click(function () {
    var checkedStatus = this.checked;
    $("#dataTable").DataTable().rows().nodes().to$().find('input[type="checkbox"]').each(function () {
      $(this).prop('checked', checkedStatus);
    });
  });
</script>