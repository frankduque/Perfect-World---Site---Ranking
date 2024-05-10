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
              <h6 class="text-uppercase text-muted ls-1 mb-1">Personagem</h6>
              <h2 class="mb-0">Detalhes</h2>
            </div>
            <div class="col text-right">
              <button type="button" id="bulkdelete" class="btn btn-danger">Bulk Delete</button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Nome</h5>
              <span class="h2 font-weight-bold mb-0"><?php echo $personagem->nome; ?></span>
            </div>
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Level</h5>
              <span class="h2 font-weight-bold mb-0"><?php echo $personagem->level; ?></span>
            </div>
          </div>
          <hr class="m-2">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Cultivo</h5>
              <span class="h2 font-weight-bold mb-0"><?php echo $personagem->cultivo; ?></span>
            </div>
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Fama</h5>
              <span class="h2 font-weight-bold mb-0"><?php echo $personagem->reputacao; ?></span>
            </div>
          </div>
          <hr class="m-2">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Clãn</h5>
              <span class="h2 font-weight-bold mb-0"><?php echo $personagem->guild_nome; ?></span>
            </div>
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Pontos PvP</h5>
              <span class="h2 font-weight-bold mb-0"><?php echo $personagem->pontos; ?></span>
            </div>
          </div>
          <hr class="m-2">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Saldo de Pontos PvP</h5>
              <span class="h2 font-weight-bold mb-0"><?php echo $personagem->pontos; ?></span>
            </div>
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Bloqueio</h5>
              <span class="h2 font-weight-bold mb-0">
                <?php if ($bloqueado): ?>
                  <div class="d-inline-block mb-3">
                    <span class="badge badge-pill badge-danger mr-2">Bloqueado</span>
                    <a href="<?php echo base_url('admin/personagens/desbloquear/' . $personagem->charid); ?>"
                      class="btn btn-success btn-sm">Desbloquear</a>
                  </div>
                <?php else: ?>
                  <div class="d-inline-block mb-3">
                    <span class="badge badge-pill badge-success mr-2">Não Bloqueado</span>
                    <a href="<?php echo base_url('admin/personagens/bloquear/' . $personagem->charid); ?>"
                      class="btn btn-danger btn-sm">Bloquear</a>
                  </div>
                <?php endif; ?>
              </span>
            </div>
          </div>




          <form id="Form" method="post"
            action="<?php echo base_url("admin/pvp/bulkdeletekills/" . $personagem->charid) ?>">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
              value="<?php echo $this->security->get_csrf_hash(); ?>">

            <h2 class="mt-4">Relatório de kills</h2>

            <table id="dataTable" class="table table-flush dInfoTable">
              <thead>
                <tr>
                  <th scope="coll" class="">
                    <div class="custom-control custom-checkbox mb-3">
                      <input class="custom-control-input" name="selectAll" id="selectAll" type="checkbox">
                      <label class="custom-control-label" for="selectAll"></label>
                    </div>
                  </th>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Status</th>
                  <th>Data da Kill</th>
                  <th>Opções</th>
                </tr>

              </thead>
              <tbody>
                <?php
                foreach ($kills as $kill):
                  ?>
                  <tr class='clickable-row'>
                    <td>
                      <div class="custom-control custom-checkbox mb-3">
                        <input name="ids[]" value="<?= $kill->id ?>" class="custom-control-input"
                          id="checkbox<?= $kill->id ?>" type="checkbox">
                        <label class="custom-control-label checkbox" for="checkbox<?= $kill->id ?>"></label>
                      </div>
                    </td>
                    <td><span class="font-weight-bold"><a
                          href="<?php echo base_url('admin/personagens/detalhes/' . $kill->morreu_id); ?>"><?php echo $kill->morreu_id; ?></a></span>
                    </td>
                    <td><span class="font-weight-bold"><a
                          href="<?php echo base_url('admin/personagens/detalhes/' . $kill->morreu_id); ?>"><?php echo $kill->nome; ?></span>
                    </td>
                    <td><?php if ($kill->bloqueado): ?>
                        <div class="d-inline-block mb-3">
                          <span class="badge badge-pill badge-danger mr-2">Bloqueado</span>
                          <a href="<?php echo base_url('admin/personagens/desbloquear/' . $kill->morreu_id . "/" . $personagem->charid); ?>"
                            class="btn btn-success btn-sm">Desbloquear</a>
                        </div>
                      <?php else: ?>
                        <div class="d-inline-block mb-3">
                          <span class="badge badge-pill badge-success mr-2">Não Bloqueado</span>
                          <a href="<?php echo base_url('admin/personagens/bloquear/' . $kill->morreu_id . "/" . $personagem->charid); ?>"
                            class="btn btn-danger btn-sm">Bloquear</a>
                        </div>
                      <?php endif; ?>
                    </td>

                    <td class=""><span class="font-weight-bold"><?php echo $kill->data; ?></span></td>
                    <td class="text-center">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item btndeletar" href="#" data-id="<?php echo $kill->id ?>">Deletar</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php
                endforeach;
                ?>
              </tbody>
            </table>

            <h2 class="mt-4">Relatório de Mortes</h2>

            <table id="dataTable1" class="table table-flush dInfoTable" data-order='[[ 4, "desc" ]]'>
              <thead>
                <tr>
                  <th scope="coll" class="">
                    <div class="custom-control custom-checkbox mb-3">
                      <input class="custom-control-input" name="selectAll" id="selectAll" type="checkbox">
                      <label class="custom-control-label" for="selectAll"></label>
                    </div>
                  </th>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Data da Kill</th>
                  <th class="text-center">Opções</th>
                </tr>

              </thead>
              <tbody>
                <?php
                foreach ($deaths as $death):
                  ?>
                  <tr class='clickable-row'>
                    <td>
                      <div class="custom-control custom-checkbox mb-3">
                        <input name="ids[]" value="<?= $death->id ?>" class="custom-control-input"
                          id="checkbox<?= $death->id ?>" type="checkbox">
                        <label class="custom-control-label checkbox" for="checkbox<?= $death->id ?>"></label>
                      </div>
                    </td>
                    <td><span class="font-weight-bold"><a
                          href="<?php echo base_url('admin/personagens/detalhes/' . $death->matou_id); ?>"><?php echo $death->matou_id; ?></a></span>
                    </td>
                    <td><span class="font-weight-bold"><a
                          href="<?php echo base_url('admin/personagens/detalhes/' . $death->matou_id); ?>"><?php echo $death->nome; ?></span>
                    </td>
                    <td><span class="font-weight-bold"><?php echo $death->data; ?></span></td>
                    <td class="text-center">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item btndeletar" href="#" data-id="<?php echo $death->id ?>">Deletar</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php
                endforeach;
                ?>
              </tbody>
            </table>
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
          text: "Deseja realmente deletar esta kill?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Deletar'
        }).then((result) => {
          if (result.value) {
            window.location = "<?php echo base_url('admin/pvp/deletar_kill/') ?>" + this.getAttribute('data-id') + "/<?php echo $personagem->charid ?>";
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
            text: "Deseja realmente deletar as kills selecionadas?",
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
            title: 'Nenhuma bloqueio selecionado',
            text: "É necessário marcar pelo menos um bloqueio.",
            type: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Deletar'
          });
        }
      });
    });
  </script>