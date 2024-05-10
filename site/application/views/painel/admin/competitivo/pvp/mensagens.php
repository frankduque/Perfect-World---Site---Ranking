<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<form id="Form" method="post" action="<?php echo base_url("admin/mensagens_pvp/bulkdelete") ?>">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
  <div class="container-fluid mt--7">
    <div class="row">
      <div class="col-xl-12">
        <div class="card shadow">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">Competitivo</h6>
                <h2 class="mb-0">Mensagens pvp</h2>
              </div>
              <div class="col text-right">
                <button type="button" id="bulkdelete" class="btn btn-danger">Bulk Delete</button>
                <a class="btn btn-primary" href="<?php echo base_url("admin/mensagens_pvp/form") ?>">Nova Mensangem</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <table id="dataTable" class="table table-flush wrap responsive" style="width:100%">
                  <thead>
                    <tr>
                      <th scope="coll" class="">  
                        <div class="custom-control custom-checkbox mb-3">
                          <input class="custom-control-input" name="selectAll" id="selectAll" type="checkbox">
                          <label class="custom-control-label" for="selectAll"></label>
                        </div>
                      </th>
                      <th scope="coll" class="pr-0 pl-1 text-center">Texto</th>
                      <th scope="coll" class="pr-0 pl-1 text-center">Opções</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      foreach ($mensagens as $mensagem) :
                          ?>
                        <tr class='clickable-row'>
                          <td>
                            <div class="custom-control custom-checkbox mb-3">
                              <input name="ids[]" value="<?= $mensagem->id ?>" class="custom-control-input" id="checkbox<?= $mensagem->id ?>" type="checkbox">
                              <label class="custom-control-label checkbox" for="checkbox<?= $mensagem->id ?>"></label>
                            </div>
                          </td> 
                          <td><span class="font-weight-bold" style="word-wrap: break-word"><?php echo $mensagem->mensagem; ?></span></td> 
                          <td class="text-center">
                            <div class="dropdown">
                              <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item btndeletar" href="#" data-id="<?php echo $mensagem->id ?>">Deletar</a>
                                <a class="dropdown-item" href="<?php echo base_url("admin/mensagens_pvp/form/" . $mensagem->id) ?>">Editar</i></a>
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
</form>

<script>
    $(document).ready(function () {
        $(".btndeletar").click(function () {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Deseja realmente deletar esta mensagem?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Deletar'
            }).then((result) => {
                if (result.value) {
                    window.location = "<?php echo base_url('admin/mensagens_pvp/deletar/') ?>" + this.getAttribute('data-id');
                }
            });
        });
    });
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
                    text: "Deseja realmente deletar os mensagens selecionados?",
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
                    title: 'Nenhuma mensagem selecionada',
                    text: "É necessário marcar pelo menos um mensagem.",
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
