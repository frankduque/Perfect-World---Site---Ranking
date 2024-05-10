<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7">
  <div class="card">
    <!-- Card header -->
    <div class="card-header">
      <h3 class="mb-0">Relatório de downloads</h3>
    </div>
    <div class="table-responsive py-4">
      <table class="table table-flush" id="dataTable">
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
              <td><?= ucfirst($download->tipo) ?></td>
              <td> <?= $download->downloads ?></td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2"><?= floor(($download->downloads * 100) / $total_downloads) ?>%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-success" role="progressbar"
                        aria-valuenow="<?= floor(($download->downloads * 100) / $total_downloads) ?>" aria-valuemin="0"
                        aria-valuemax="100"
                        style="width: <?= floor(($download->downloads * 100) / $total_downloads) ?>%;"></div>
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