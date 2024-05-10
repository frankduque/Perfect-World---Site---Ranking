<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<?php if (!$tem_permissao) : ?>
    <div class="container-fluid mt--7">

      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Painel Administrativo</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive pb-5 pt-3">
              <h3 class="mb-0 d-block text-center my-5">Nenhum conteúdo disponível</h3>
            </div>
          </div>
        </div>
      </div>
  <?php endif; ?>

  <?php  if ($tem_permissao) : ?>
      <div class="container-fluid mt--7">

        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="row align-items-center">
                  <div class="col">
                    <h3 class="mb-0">Acessos às páginas</h3>
                  </div>
                  <div class="col text-right">
                    <a href="<?= base_url("admin/dashboard/acessos") ?>" class="btn btn-sm btn-primary">Ver todas</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
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
        </div>
        <?php if ($tem_permissao): ?>
          </div>
      <?php endif; ?>
  <?php endif; ?>

  <?php if ($tem_permissao) : ?>
      <div class="container-fluid <?php echo ($tem_permissao ? "mt-3" : "mt--7") ?> ">

        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="row align-items-center">
                  <div class="col">
                    <h3 class="mb-0">Downloads</h3>
                  </div>
                  <div class="col text-right">
                    <a href="<?= base_url("admin/dashboard/downloads") ?>" class="btn btn-sm btn-primary">Ver todos</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Tipo</th>
                      <th scope="col">Downloads</th>
                      <th scope="col">Percentual</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($downloads as $download): ?>
                        <tr>
                          <th scope="row"> <?= $download->nome ?></th>
                          <td><?= $download->tipo ?></td>
                          <td> <?= $download->downloads ?></td>
                          <td>
                            <div class="d-flex align-items-center">
                              <span class="mr-2"><?= floor(($download->downloads * 100) / ($total_downloads ? $total_downloads : 1)) ?>%</span>
                              <div>
                                <div class="progress">
                                  <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="<?= floor(($download->downloads * 100) / ($total_downloads ? $total_downloads : 1)) ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= floor(($download->downloads * 100) / ($total_downloads ? $total_downloads : 1)) ?>%;"></div>
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
        </div>
    <?php endif; ?>