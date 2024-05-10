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
                            <h2 class="mb-0">Adicionar Item PVP</h2>
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
                    <form id="Form" method="post" action="<?php echo base_url("admin/itens_pvp/salvar/" . $item->id) ?>">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                            value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="row">
                            <div class="col-1">
                                <div class="form-group focused">
                                    <label class="form-control-label d-block" for="nome">Icone</label>
                                    <img id="icone"
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                        width="38" height="38">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="itemid">Item ID</label>
                                    <input required type="number" value="<?php echo $item->itemid ?>"
                                        name="itemid" id="itemid" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="nome">Nome</label>
                                    <input type="text" value="<?php echo $item->nome ?>" name="nome" id="nome"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="pontossaque">Pontos Saque</label>
                                    <input required type="number" value="<?php echo $item->pontossaque ?>"
                                        name="pontossaque" id="pontossaque" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="pos">POS</label>
                                    <input required type="number" value="<?php echo $item->pos ?>" name="pos"
                                        id="pos" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="count">Count</label>
                                    <input required type="number" value="<?php echo $item->count ?>" name="count"
                                        id="count" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="max_count">Max_count</label>
                                    <input required type="number" value="<?php echo $item->max_count ?>"
                                        name="max_count" id="max_count" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="data">Data</label>
                                    <input required type="text" value="<?php echo $item->data ?>" name="data"
                                        id="data" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="proctype">Proctype</label>
                                    <input required type="number" value="<?php echo $item->proctype ?>"
                                        name="proctype" id="proctype" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="expire_date">Expire_date</label>
                                    <input required type="number" value="<?php echo $item->expire_date ?>"
                                        name="expire_date" id="expire_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="guid1">Guid1</label>
                                    <input required type="number" value="<?php echo $item->guid1 ?>" name="guid1"
                                        id="guid1" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="guid2">Guid2</label>
                                    <input required type="number" value="<?php echo $item->guid2 ?>" name="guid2"
                                        id="guid2" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="mask">Mask</label>
                                    <input required type="number" value="<?php echo $item->mask ?>" name="mask"
                                        id="mask" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <button id="button" type="submit" class="btn btn-primary btn-lg float-right">Salvar</button>
                        <a href="<?php echo base_url("admin/itens_pvp") ?>"
                            class="mr-3 btn btn-warning btn-lg float-right">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#itemid').keyup(function () {
            $.ajax({
                url: '<?php echo base_url("admin/itens_pvp/item/") ?>',
                data: {
                    <?php echo json_encode($this->security->get_csrf_token_name()) ?>: <?php echo json_encode($this->security->get_csrf_hash()) ?>,
                    itemid: this.value
                },

                type: "POST",
                dataType: "json",
                success: function (data) {
                    $('#nome').val(data.nome);
                    $('#pos').val(data.pos);
                    $('#count').val(data.count);
                    $('#max_count').val(data.max_count);
                    $('#data').val(data.data);
                    $('#proctype').val(data.proctype);
                    $('#expire_date').val(data.expire_date);
                    $('#guid1').val(data.guid1);
                    $('#guid2').val(data.guid2);
                    $('#mask').val(data.mask);
                    
                    if (typeof (data.itemid) != "undefined" && data.itemid !== null) {
                        $("#icone").attr("src", "<?php echo base_url("assets/site/img/personagem/icones/") ?>" + data.itemid + ".png");
                    } else {
                        $("#icone").attr("src", "<?php echo base_url("assets/site/img/personagem/icones/") ?>" + "0.png");

                    }
                },
            });
        });
    </script>