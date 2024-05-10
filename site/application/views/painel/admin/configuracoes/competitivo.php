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
              <h6 class="text-uppercase text-muted ls-1 mb-1">Configurações</h6>
              <h2 class="mb-0">Competitivo</h2>
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
          <form id="Form" enctype="multipart/form-data" method="post" action="<?php echo base_url("admin/configuracoes/salvar_competitivo") ?>">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active px-4 py-3" id="pvp-tab" data-toggle="tab" href="#pvp" role="tab" aria-controls="pvp" aria-selected="true">PVP</a>
              </li>
              <li class="nav-item">
                <a class="nav-link px-4 py-3" id="pve-tab" data-toggle="tab" href="#pve" role="tab" aria-controls="pve" aria-selected="true">PVE</a>
              </li>
              <li class="nav-item">
                <a class="nav-link px-4 py-3" id="tw-tab" data-toggle="tab" href="#tw" role="tab" aria-controls="tw" aria-selected="true">TW</a>
              </li>
              <li class="nav-item">
                <a class="nav-link px-4 py-3" id="gvg-tab" data-toggle="tab" href="#gvg" role="tab" aria-controls="gvg" aria-selected="true">GVG</a>
              </li>
              <li class="nav-item">
                <a class="nav-link px-4 py-3" id="listaclans-tab" data-toggle="tab" href="#listaclans" role="tab" aria-controls="listaclans" aria-selected="true">Ranking de Clans</a>
              </li>
              <li class="nav-item">
                <a class="nav-link px-4 py-3" id="mensagenspvp-tab" data-toggle="tab" href="#mensagenspvp" role="tab" aria-controls="mensagenspvp" aria-selected="true">Mensagens PVP</a>
              </li>
              <li class="nav-item">
                <a class="nav-link px-4 py-3" id="trocaitenspvp-tab" data-toggle="tab" href="#trocaitenspvp" role="tab" aria-controls="trocaitenspvp" aria-selected="true">Troca de Itens PVP</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active pt-4" id="pvp" role="tabpanel" aria-labelledby="pvp-tab">
                <div class="row">
                  <div class="col-lg-6">
                    <h6 class="heading-small text-muted">Ativar ranking PVP</h6>
                  </div>
                  <div class="col-lg-6 text-right">
                    <label class="custom-toggle">
                      <input type="checkbox" name="usarpvp" <?php echo ($this->config->item("usarpvp") == 1 ? "checked" : '') ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-lg-6">
                    <h6 class="heading-small text-muted">Mostrar pontos zerados ou negativos</h6>
                  </div>
                  <div class="col-lg-6 text-right">
                    <label class="custom-toggle">
                      <input type="checkbox" name="mostrarzeradosenegativospvp" <?php echo ($this->config->item("mostrarzeradosenegativospvp") == 1 ? "checked" : '') ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="pontosmatarpvp">Multiplicador de pontos ao matar</label>
                      <input type="number" min="1" required value="<?php echo $this->config->item("pontosmatarpvp"); ?>" name="pontosmatarpvp" id="pontosmatarpvp" class="form-control form-control-alternative">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="pontosmorrer">Multiplicador perda de pontos ao morrer</label>
                      <input type="number" min="1" required value="<?php echo $this->config->item("pontosmorrerpvp"); ?>" name="pontosmorrerpvp" id="pontosmorrerpvp" class="form-control form-control-alternative">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="limiterankingpvp">Número de posições Ranking PVP</label>
                      <input type="number" min="1" required value="<?php echo $this->config->item("limiterankingpvp"); ?>" name="limiterankingpvp" id="limiterankingpvp" class="form-control form-control-alternative">
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade pt-4" id="pve" role="tabpanel" aria-labelledby="pve-tab">
                <div class="row">
                  <div class="col-lg-6">
                    <h6 class="heading-small text-muted">Ativar ranking PVE</h6>
                  </div>
                  <div class="col-lg-6 text-right">
                    <label class="custom-toggle">
                      <input type="checkbox" name="usarpve" <?php echo ($this->config->item("usarpve") == 1 ? "checked" : '') ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="limiterankingpve">Número de posições Ranking PVE</label>
                      <input type="number" min="1" required value="<?php echo $this->config->item("limiterankingpve"); ?>" name="limiterankingpve" id="limiterankingpve" class="form-control form-control-alternative">
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade pt-4" id="tw" role="tabpanel" aria-labelledby="tw-tab">
                <div class="row">
                  <div class="col-lg-6">
                    <h6 class="heading-small text-muted">Ativar ranking TW</h6>
                  </div>
                  <div class="col-lg-6 text-right">
                    <label class="custom-toggle">
                      <input type="checkbox" name="usartw" <?php echo ($this->config->item("usartw") == 1 ? "checked" : '') ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="iconlisttxt">Atualiar iconlist_guild.txt</label>
                      <input type="file" accept=".txt" name="iconlisttxt" id="iconlisttxt" class="form-control form-control-alternative">
                    </div>
                    <h6 class="heading-small text-muted">Último update: <?php echo $this->config->item("guildlisttxtultipdate") ?></h6>

                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="iconlistpng">Atualiar iconlist_guild.png</label>
                      <input type="file" accept=".png" name="iconlistpng" id="iconlistpng" class="form-control form-control-alternative">
                    </div>
                    <h6 class="heading-small text-muted">Último update: <?php echo $this->config->item("guildlistpngultipdate") ?></h6>

                  </div>
                </div>
              </div>
              <div class="tab-pane fade pt-4" id="gvg" role="tabpanel" aria-labelledby="gvg-tab">
                <div class="row">
                  <div class="col-lg-6">
                    <h6 class="heading-small text-muted">Ativar ranking GVG</h6>
                  </div>
                  <div class="col-lg-6 text-right">
                    <label class="custom-toggle">
                      <input type="checkbox" name="usargvg" <?php echo ($this->config->item("usargvg") == 1 ? "checked" : '') ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-lg-6">
                    <h6 class="heading-small text-muted">Mostrar pontos zerados ou negativos</h6>
                  </div>
                  <div class="col-lg-6 text-right">
                    <label class="custom-toggle">
                      <input type="checkbox" name="mostrarzeradosenegativosgvg" <?php echo ($this->config->item("mostrarzeradosenegativosgvg") == 1 ? "checked" : '') ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="limiterankinggvg">Número de posições Ranking GVG</label>
                      <input type="number" min="1" required value="<?php echo $this->config->item("limiterankinggvg"); ?>" name="limiterankinggvg" id="limiterankinggvg" class="form-control form-control-alternative">
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade pt-4" id="listaclans" role="tabpanel" aria-labelledby="listaclans-tab">
                <div class="row">
                  <div class="col-lg-6">
                    <h6 class="heading-small text-muted">Ativar </h6>
                  </div>
                  <div class="col-lg-6 text-right">
                    <label class="custom-toggle">
                      <input type="checkbox" name="usarlistaclans" <?php echo ($this->config->item("usarlistaclans") == 1 ? "checked" : '') ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="limiterankinglistaclan">Limitar número de clans</label>
                      <input type="number" min="1" required value="<?php echo $this->config->item("limiterankinglistaclan"); ?>" name="limiterankinglistaclan" id="limiterankinglistaclan" class="form-control form-control-alternative">
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade pt-4" id="mensagenspvp" role="tabpanel" aria-labelledby="mensagenspvp-tab">
                <div class="row">
                  <div class="col-lg-6">
                    <h6 class="heading-small text-muted">Ativar mensagens do pvp</h6>
                  </div>
                  <div class="col-lg-6 text-right">
                    <label class="custom-toggle">
                      <input type="checkbox" name="usarmensagempvp" <?php echo ($this->config->item("usarmensagempvp") == 1 ? "checked" : '') ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="canalmensagenspvp">Canal de envio (padrão - 11)</label>
                      <input type="number" min="0" max="15" required value="<?php echo $this->config->item("canalmensagenspvp"); ?>" name="canalmensagenspvp" id="canalmensagenspvp" class="form-control form-control-alternative">
                    </div>
                  </div>
                </div>
                <h6 class="text-uppercase text-muted ls-1 mb-1">Canais</h6>
                <h4 class="mb-0">1  -  Global</h4>
                <h4 class="mb-0">2  -  Grupo</h4>
                <h4 class="mb-0">3  -  Clã</h4>
                <h4 class="mb-0">5  -  Aviso</h4>
                <h4 class="mb-0">6  -  Aviso laranja</h4>
                <h4 class="mb-0">7  -  Comércio</h4>
                <h4 class="mb-0">9  -  Broadcast (Chat Gm)</h4>
                <h4 class="mb-0">10  -  Aviso azul</h4>
                <h4 class="mb-0">11  -  Mensagem Vermelha (Valor padrão)</h4>
                <h4 class="mb-0">12  -  Mensageiro</h4>
                <h4 class="mb-0">13  -  Mensagem branca</h4>
                <h4 class="mb-0">14  -  Mensagem branca</h4>
                <h4 class="mb-0">15  -  InterServidor</h4>
              </div>
              <div class="tab-pane fade pt-4" id="trocaitenspvp" role="tabpanel" aria-labelledby="trocaitenspvp-tab">
                <div class="row">
                  <div class="col-lg-6">
                    <h6 class="heading-small text-muted">Usar troca de itens PVP</h6>
                  </div>
                  <div class="col-lg-6 text-right">
                    <label class="custom-toggle">
                      <input type="checkbox" name="usartrocaitenspvp" <?php echo ($this->config->item("usartrocaitenspvp") == 1 ? "checked" : '') ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="comandoconsultapontos">Comando para consulta da pontuação</label>
                      <input type="text" minlength="5" required value="<?php echo $this->config->item("comandoconsultapontos"); ?>" name="comandoconsultapontos" id="comandoconsutlapontos" class="form-control form-control-alternative">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="comandoconsultaitens">Comando para consulta de itens</label>
                      <input type="text" minlength="5" required value="<?php echo $this->config->item("comandoconsultaitens"); ?>" name="comandoconsultaitens" id="comandoconsultaitens" class="form-control form-control-alternative">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="comandosacaritens">Comando para sacar os itens</label>
                      <input type="text" minlength="5" required value="<?php echo $this->config->item("comandosacaritens"); ?>" name="comandosacaritens" id="comandosacaritens" class="form-control form-control-alternative">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <button type="submit" class="btn btn-primary btn-lg float-right">Salvar</button> 
          </form>
        </div>
      </div>
    </div>
  </div>