<!-- PAGE NAME START -->
<section class="page-name page-pvp parallax" data-paroller-factor="0.1" data-paroller-type="background"
  data-paroller-direction="vertical">
  <h1 class="page-title"> Ranking PVE </h1>
</section>
<!-- PAGE NAME END -->
<section style="padding: 70px;">
  <span class="title">Ranking PVE
  </span>
  <div class="row ">
    <div class="col-md-10 col-xs-12 mt-5" style="
    padding: 3rem;
    border-radius: 10px;
    background-color: #335b87;
">
      <table id="ajaxTable" class="table dTables table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>#</th>
            <th>Nick</th>
            <th>Classe</th>
            <th>Level</th>
            <th>Cultivo</th>
            <th>Fama</th>
            <th>Clã</th>
            <th>Infos</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <div class="col-xs-12 col-md-2 mt-5">
      <ul class="nested-lists py-3 mt-4" style="background-color:var(--lapis-lazuli)">
        <h3 class="subheading text-center mb30 ">Classes</h3>
        <ul>
          <li class="<?php echo ($classes == "todas" ? "active fweight-700" : "") ?>">
            <a href="<?php echo base_url("competitivo/pvp?classes=todas") ?>">
              <?php echo ($classes == "todas" ? "<i class='fas fa-check'></i> " : "") ?>Todas
            </a>
          </li>

          <?php foreach ($this->config->item("id2classe") as $id => $classe): ?>
            <li class="<?php echo ($classes == $id ? "active fweight-700" : "") ?>">
              <a href="<?php echo base_url("competitivo/pvp?classes=" . $id) ?>">
                <?php echo ($classes == $id ? "<i class='fas fa-check'></i> " : "") ?>   <?php echo $classe ?>
              </a>
            </li>

          <?php endforeach; ?>
        </ul>
      </ul>
    </div>
  </div>
</section>
<script>

  $(document).ready(function () {


    let $table = $("#ajaxTable");
    $table.DataTable({
      "processing": true,
      "serverSide": true,
      "ordering": false,
      "ajax": {
        "url": "<?php echo base_url('competitivo/ajax_list_pve') . '?' . http_build_query(array('classes' => $classes)) ?>",
        "type": "POST",
        "data": function (d) {
          d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
        }
      },
      "columns": [

        {
          "data": "posicao"
        },
        {
          "data": "nome",
          render: function (data, type, row) {
            return '<a href="<?php echo base_url('competitivo/personagem/') ?>' + row.charid + '">' + data + '</a>';
          }
        },
        {
          "data": "classe",
          render: function (data, type, row) {
            return '<img style="display:inline" src="<?php echo base_url('assets/site/img/classes/') ?>' + data + '.webp" style="width: 30px; height: 30px;"> ' + data;
          }
        },
        {
          "data": "level"
        },
        {
          "data": "cultivo"
        },
        {
          "data": "reputacao"
        },
        {
          "data": "guild_nome",
          render: function (data, type, row) {
            let guild_icon = row.guild_icon;
            console.log(guild_icon);
            console.log(guild_icon.default);
            if (guild_icon.default) {
              return '<img class="iconmap" style="margin-right: 0px;position:static; display:inline" src="<?php echo base_url("assets/upload/guildicons/ico.png") ?>"> ' +
                '<a href="<?php echo base_url('competitivo/clan/') ?>' + row.guild_id + '">' + data + '</a>';
            } else {
              console.log(guild_icon.linha);
              return '<img class="iconmap" style="margin-right: 0px; position: static; background-position-y: ' + (guild_icon.linha - 1) * -19.5 + 'px; background-position-x:' + (guild_icon.coluna - 1) * -19.5 + 'px; display:inline"  src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">' +
                '<a href="<?php echo base_url('competitivo/clan/') ?>' + row.guild_id + '">' + data + '</a>';


            }
          }
        },
        {
          "data": "charid",
          "render": function (data, type, row) {
            return '<a href="<?php echo base_url('competitivo/personagem/') ?>' + data + '" class="btn btn-primary btn-sm">Detalhes</a>';
          }
        }


      ]

    });
  })

</script>