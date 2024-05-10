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
              <h2 class="mb-0">Ranking PVE</h2>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table id="ajaxTable" class="table table-flush">
                <thead>
                  <tr>
                    <th>Char Id</th>
                    <th>User Id</th>
                    <th>Nick</th>
                    <th>Classe</th>
                    <th>Level</th>
                    <th>Kills</th>
                    <th>Deaths</th>
                    <th>Pontos</th>
                    <th>Clã</th>
                    <th>Bloqueado</th>
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

  <script>

    $(document).ready(function () {


      let $table = $("#ajaxTable");
      $table.DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": {
          "url": "<?php echo base_url('/competitivo/ajax_list_pvp') ?>",
          "type": "POST",
          "data": function (d) {
            d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
          }
        },
        "columns": [

          {
            "data": "charid"
          },
          {
            "data": "userid"
          },
          {
            "data": "nome"
          },
          {
            "data": "classe"
          },
          {
            "data": "level"
          },
          {
            "data": "kills"
          },
          {
            "data": "deaths"
          },
          {
            "data": "pontos"
          },
          {
            "data": "guild_nome"
          },
          {
            "data": "bloqueado",
            "render": function (data, type, row) {
              return data == 1 ? '<span class="badge badge-danger">Bloqueado</span><a href="<?php echo base_url('admin/personagens/desbloquear/') ?>' + row.charid + '" class="btn btn-primary btn-sm">Desbloquear</a>' : '<span class="badge badge-success">Liberado</span><a href="<?php echo base_url('admin/personagens/bloquear/') ?>' + row.charid + '" class="btn btn-danger btn-sm">Bloquear</a>';
            }
          },
          {
            "data": "charid",
            "render": function (data, type, row) {
              return '<a href="<?php echo base_url('admin/personagens/detalhes/') ?>' + data + '" class="btn btn-primary btn-sm">Detalhes</a>';
            }
          }

        ]

      });
    })

  </script>