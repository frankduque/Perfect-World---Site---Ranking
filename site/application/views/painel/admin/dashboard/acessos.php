<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<?php if (in_array("Gerenciar Dashboard", $this->session->permissoes)) : ?>
    <div class="container-fluid mt--7">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <h3 class="mb-0">Acessos às páginas</h3>
        </div>
        <div class="table-responsive py-4">
          <table class="table table-flush" id="dataTable">
            <thead class="thead-light">
              <tr>
                <th scope="col">Página</th>
                <th scope="col">Visitantes</th>
                <th scope="col">Visitantes únicos</th>
                <th scope="col">Percentual</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($acessos as $acesso): ?>
                  <tr>
                    <th scope="row"> <?= $acesso->pagina ?></th>
                    <td><?= $acesso->acessos ?></td>
                    <td> <?= $acesso->unicos ?></td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="mr-2"><?= floor(($acesso->acessos * 100) / $total_acessos) ?>%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="<?= floor(($acesso->acessos * 100) / $total_acessos) ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= floor(($acesso->acessos * 100) / $total_acessos) ?>%;"></div>
                          </div>
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
<?php endif; ?>