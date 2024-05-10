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
              <h6 class="text-uppercase text-muted ls-1 mb-1">Usuários</h6>
              <h2 class="mb-0">Cargos</h2>
            </div>
            <div class="col text-right">
                  <a class="btn btn-primary" href="<?php echo base_url("admin/cargos/form") ?>">Novo Cargo</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table id="dataTable" class="table table-flush">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Usuários</th>
                    <th scope="col"># Permissões</th>
                    <th scope="col">Opções</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($cargos as $cargo) : ?>
                      <tr class='clickable-row'>
                        <td><span class="font-weight-bold"><?php echo $cargo->id; ?></span></td> 
                        <td><span class="font-weight-bold"><?php echo $cargo->cargo; ?></span></td> 
                        <td><span class="font-weight-bold"><?php echo $cargo->usuarios; ?></span></td> 
                        <td><span class="font-weight-bold"><?php echo (is_array(json_decode($cargo->permissoes)) ? count(json_decode($cargo->permissoes)) : 0); ?></span></td> 
                        <td>
                              <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                      <a class="dropdown-item" href="<?php echo base_url("admin/cargos/form/" . $cargo->id) ?>">Editar</i></a>
                                      <a class="dropdown-item btndeletar" href="#" data-id="<?php echo $cargo->id ?>">Deletar</a>
                                </div>
                              </div>
                        </td> 
                      </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
      <script>
          $(document).ready(function () {
              $(".btndeletar").click(function () {
                  Swal.fire({
                      title: 'Tem certeza?',
                      text: "Deseja realmente deletar este cargo?",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Deletar'
                  }).then((result) => {
                      if (result.value) {
                          window.location = "<?php echo base_url('admin/cargos/deletar/') ?>" + this.getAttribute('data-id');
                      }
                  });
              });
          });
      </script>
