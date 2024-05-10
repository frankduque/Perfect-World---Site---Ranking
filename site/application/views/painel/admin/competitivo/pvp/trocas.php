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
              <h6 class="text-uppercase text-muted ls-1 mb-1">Competitivo</h6>
              <h2 class="mb-0">Trocas PVP</h2>
            </div>

          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table id="dataTable" class="table table-flush dInfoTable">
                <thead>
                  <tr>

                    <th>Item ID</th>
                    <th>Nome</th>
                    <th>Pontos</th>
                    <th>Data</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($trocas as $troca):
                    ?>
                    <tr class='clickable-row'>

                      <td><span class="font-weight-bold"><?php echo $troca->itemid; ?></span></td>
                      <td><span class="font-weight-bold">
                          <img id="icone"
                            src="<?php echo base_url("assets/site/img/personagem/icones/") . $troca->itemid . ".png" ?>"
                            width="38" height="38">
                          <?php echo $troca->itemnome; ?></span></td>
                      <td class="text-center"><span class="font-weight-bold"><?php echo $troca->pontos; ?></span></td>
                      <td class="text-center"><span class="font-weight-bold"><?php echo $troca->datasaque; ?></span></td>

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