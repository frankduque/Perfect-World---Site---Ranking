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
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Competitivo</h6>
                            <h2 class="mb-0">Adicionar Mensagem</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (validation_errors() != false): ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Erro!</strong>
                            <?= validation_errors() ?>
                        </div>
                    <?php endif; ?>
                    <form id="Form" method="post" action="<?php echo base_url("admin/mensagens_pvp/salvar/" . $mensagem->id) ?>">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="mensagem">Texto</label>
                                    <input type="text" value="<?php echo $mensagem->mensagem?>" name="mensagem" id="mensagem" class="form-control">
                                </div>
                            </div>
                        </div>
                        <h6 class="text-uppercase text-muted ls-1 mb-1">Placeholders disponíveis</h6>
                        <?php 
                            foreach ($placeholders as $key => $value) {
                                echo "<h4 class='mb-0'>{{$key}}  -  $value</h4>";
                            }
                        ?>
  
                        <hr class="my-4">
                        <button id="button" type="submit" class="btn btn-primary btn-lg float-right">Salvar</button> 
                        <a href="<?php echo base_url("admin/mensagens_pvp") ?>" class="mr-3 btn btn-warning btn-lg float-right">Cancelar</a> 
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#charid').keyup(function () {
            $.ajax({
                url: '<?php echo base_url("admin/getcharname/") ?>' + this.value,
                data: {<?php echo json_encode($this->security->get_csrf_token_name()) ?>:<?php echo json_encode($this->security->get_csrf_hash()) ?>},
                type: "POST",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $('#nome').val(data.nome);
                },
            });
        });
    </script>

    <script>
        $('#nome').keyup(function () {
            $.ajax({
                url: '<?php echo base_url("admin/getcharid/") ?>' + this.value,
                data: {<?php echo json_encode($this->security->get_csrf_token_name()) ?>:<?php echo json_encode($this->security->get_csrf_hash()) ?>},
                type: "POST",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $('#charid').val(data.id);
                },
            });
        });
    </script>