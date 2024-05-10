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
              <h2 class="mb-0">Configurações Gerais</h2>
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
          <form id="Form" enctype="multipart/form-data" method="post" action="<?php echo base_url("admin/configuracoes/salvar_gerais") ?>">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <h6 class="heading-small text-muted mb-4">Informações do Servidor</h6>
            <!-- Nome/email -->
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="nomeservidor">Nome do Servidor</label>
                  <input type="text" value="<?php echo $this->config->item("nomeservidor"); ?>" name="nomeservidor" id="nomeservidor" class="form-control form-control-alternative">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="versaoservidor">Versão do Servidor</label>
                  <select name="versaoservidor" class="form-control">
                    <option <?php echo ($this->config->item("versaoservidor") == 155 ? "selected" : "") ?> value="155">1.5.5</option>
                    <option <?php echo ($this->config->item("versaoservidor") == 153 ? "selected" : "") ?> value="153">1.5.3</option>
                    <option <?php echo ($this->config->item("versaoservidor") == 151 ? "selected" : "") ?> value="151">1.5.1</option>
                    <option <?php echo ($this->config->item("versaoservidor") == 150 ? "selected" : "") ?> value="151">1.5.0</option>
                    <option <?php echo ($this->config->item("versaoservidor") == 148 ? "selected" : "") ?> value="144">1.4.8</option>
                    <option <?php echo ($this->config->item("versaoservidor") == 147 ? "selected" : "") ?> value="144">1.4.7</option>
                    <option <?php echo ($this->config->item("versaoservidor") == 146 ? "selected" : "") ?> value="144">1.4.6</option>
                    <option <?php echo ($this->config->item("versaoservidor") == 145 ? "selected" : "") ?> value="144">1.4.5</option>
                    <option <?php echo ($this->config->item("versaoservidor") == 144 ? "selected" : "") ?> value="144">1.4.4</option>
                    <option <?php echo ($this->config->item("versaoservidor") == 142 ? "selected" : "") ?> value="142">1.4.2</option>
                    <option <?php echo ($this->config->item("versaoservidor") == 136 ? "selected" : "") ?> value="136">1.3.6</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="linkpainel">Link do Painel</label>
                  <input type="text" value="<?php echo $this->config->item("linkpainel"); ?>" name="linkpainel" id="linkpainel" class="form-control form-control-alternative">
                </div>
              </div>
            </div>
            <!-- Logos/favicon -->
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="logo">Logo</label>
                  <div class="previewimgcont">
                    <img class="configImage" id="logoimg" src="<?php echo base_url() ?>assets/upload/logo.<?php echo $this->config->item("extlogo") . "?v=" . $this->config->item("vlogo") ?>">
                  </div>
                  <input type="file" accept=".webp, .png, .jpeg, .jpg, .gif, .svg" onchange="logoimgpreview(this)" accept="image/*" name="logo" id="logo" class="d-none">
                  <input type="hidden" id="logoatual" value="<?php echo base_url() ?>assets/upload/logo.<?php echo $this->config->item("extlogo") . "?v=" . $this->config->item("vlogo") ?>">  
                  <span style="text-align: center;font-size:0px;display: block;" >
                    <button onclick="$('#logo').trigger('click');" type="button" class="btn btn-primary mr-0 ml-auto" style="border-radius: 5px 0px 0px 5px;">Selecionar Arquivo</button>
                    <button onclick="limparinputlogo()" class="btn btn-icon btn-2 btn-danger mr-auto rounded-right" style="border-radius: 0px 5px 5px 0px;" type="button">
                      <span class="btn-inner--icon"><i class="fas fa-trash"></i></span>
                    </button>
                  </span>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="favicon">Favicon</label>
                  <div class="previewimgcont">
                    <img class="configImage" id="faviconimg" src="<?php echo base_url() ?>assets/upload/favicon.<?php echo $this->config->item("extfavicon") . "?v=" . $this->config->item("vfavicon") ?>">
                  </div>
                  <input type="file" accept=".ico, .png, .jpeg, .jpg, .gif" onchange="faviconimgpreview(this)" accept="image/*" name="favicon" id="favicon" class="d-none">
                  <input type="hidden" id="faviconatual" value="<?php echo base_url() ?>assets/upload/favicon.<?php echo $this->config->item("extfavicon") . "?v=" . $this->config->item("vfavicon") ?>">  
                  <span style="text-align: center;font-size:0px;display: block;" >
                    <button onclick="$('#favicon').trigger('click');" type="button" class="btn btn-primary mr-0 ml-auto" style="border-radius: 5px 0px 0px 5px;">Selecionar Arquivo</button>
                    <button onclick="limparinputfavicon()" class="btn btn-icon btn-2 btn-danger mr-auto rounded-right" style="border-radius: 0px 5px 5px 0px;" type="button">
                      <span class="btn-inner--icon"><i class="fas fa-trash"></i></span>
                    </button>
                  </span>
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

  <script>
      function logoimgpreview(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#logoimg').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
      }

      function faviconimgpreview(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#faviconimg').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
      }

      function limparinputlogo() {
          $('#logo').val("");
          $('#logoimg').attr('src', document.getElementById("logoatual").value);
      }

      function limparinputfavicon() {
          $('#favicon').val("");
          $('#faviconimg').attr('src', document.getElementById("faviconatual").value);
      }
  </script>