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
              <h6 class="text-uppercase text-muted ls-1 mb-1">Configurações</h6>
              <h2 class="mb-0">Integrações</h2>
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
          <form id="Form" method="post" action="<?php echo base_url("admin/configuracoes/salvar_integracoes") ?>">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
              value="<?php echo $this->security->get_csrf_hash(); ?>">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active px-4 py-3" id="recaptcha-tab" data-toggle="tab" href="#recaptcha" role="tab"
                  aria-controls="recaptcha" aria-selected="true">reCaptcha</a>
              </li>
              <li class="nav-item">
                <a class="nav-link px-4 py-3" id="disqus-tab" data-toggle="tab" href="#disqus" role="tab"
                  aria-controls="disqus" aria-selected="false">Disqus</a>
              </li>
              <li class="nav-item">
                <a class="nav-link px-4 py-3" id="mailchimp-tab" data-toggle="tab" href="#mailchimp" role="tab"
                  aria-controls="mailchimp" aria-selected="false">MailChimp</a>
              </li>
              <li class="nav-item">
                <a class="nav-link px-4 py-3" id="analytics-tab" data-toggle="tab" href="#analytics" role="tab"
                  aria-controls="analytics" aria-selected="false">Google Analytics</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active pt-4" id="recaptcha" role="tabpanel"
                aria-labelledby="recaptcha-tab">
                <div class="row">
                  <div class="col-lg-6">
                    <h6 class="heading-small text-muted">Ativar reCaptcha</h6>
                  </div>
                  <div class="col-lg-6 text-right">
                    <label class="custom-toggle">
                      <input type="checkbox" name="usarrecaptcha" <?php echo ($this->config->item("usarrecaptcha") == 1 ? "checked" : '') ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="recaptchasitekey">reCAPTCHA Site Key</label>
                      <input type="text" value="<?php echo $this->config->item("recaptchasitekey"); ?>"
                        name="recaptchasitekey" id="recaptchasitekey" class="form-control form-control-alternative">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="recaptchasecretkey">reCAPTCHA Secret Key</label>
                      <input type="text" value="<?php echo $this->config->item("recaptchasecretkey"); ?>"
                        name="recaptchasecretkey" id="recaptchasecretkey" class="form-control form-control-alternative">
                    </div>
                  </div>
                </div>
                <h6 class="heading-small text-muted">Consiga sua chave de acesso aqui: <a
                    href="https://www.google.com/recaptcha/admin" target="_BLANK">Google reCAPTCHA</a></h6>
              </div>
              <div class="tab-pane fade pt-4" id="disqus" role="tabpanel" aria-labelledby="disqus-tab">
                <div class="row">
                  <div class="col-lg-6">
                    <h6 class="heading-small text-muted">Ativar Disqus</h6>
                  </div>
                  <div class="col-lg-6 text-right">
                    <label class="custom-toggle">
                      <input type="checkbox" name="usardisqus" <?php echo ($this->config->item("usardisqus") == 1 ? "checked" : '') ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="disqusshortname">Disqus Shortname</label>
                      <input type="text" value="<?php echo $this->config->item("disqusshortname"); ?>"
                        name="disqusshortname" id="disqusshortname" class="form-control form-control-alternative">
                    </div>
                  </div>
                </div>
                <h6 class="heading-small text-muted">Consiga o shortname aqui: <a
                    href="https://disqus.com/admin/settings/general" target="_BLANK">Disqus</a></h6>
              </div>
              <div class="tab-pane fade pt-4" id="mailchimp" role="tabpanel" aria-labelledby="mailchimp-tab">
                <div class="row">
                  <div class="col-lg-6">
                    <h6 class="heading-small text-muted">Ativar MailChimp</h6>
                  </div>
                  <div class="col-lg-6 text-right">
                    <label class="custom-toggle">
                      <input type="checkbox" name="usarmailchimp" <?php echo ($this->config->item("usarmailchimp") == 1 ? "checked" : '') ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group focused">
                      <label class="form-control-label" for="mailchimpcode">Custom Website Code</label>
                      <textarea rows="7" name="mailchimpcode" class="form-control form-control-alternative">
                          <?php echo trim($this->config->item("mailchimpcode")); ?>
                      </textarea>
                    </div>
                  </div>
                </div>
                <h6 class="heading-small text-muted">Consiga o seu código aqui: <a
                    href="https://us15.admin.mailchimp.com/account/connected-sites/app-selection/#other"
                    target="_BLANK">MailChimp</a></h6>
              </div>
              <div class="tab-pane fade pt-4" id="analytics" role="tabpanel" aria-labelledby="analytics-tab">
                <div class="row">
                  <div class="col-lg-6">
                    <h6 class="heading-small text-muted">Ativar Google Analytics</h6>
                  </div>
                  <div class="col-lg-6 text-right">
                    <label class="custom-toggle">
                      <input type="checkbox" name="usaranalytics" <?php echo ($this->config->item("usaranalytics") == 1 ? "checked" : '') ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="analyticsid">ID de acompanhamento</label>
                      <input type="text" value="<?php echo $this->config->item("analyticsid"); ?>" name="analyticsid"
                        id="analyticsid" class="form-control form-control-alternative">
                    </div>
                  </div>
                </div>
                <h6 class="heading-small text-muted">Consiga o seu ID de acompanhamento aqui: <a
                    href="https://analytics.google.com/analytics/web/provision/#/provision" target="_BLANK">Google
                    Analytics</a></h6>
              </div>
              <div class="tab-pane fade pt-4" id="facebook" role="tabpanel" aria-labelledby="facebook-tab">
                <div class="row">
                  <div class="col-lg-6">
                    <h6 class="heading-small text-muted">Mostrar Página do facebook</h6>
                  </div>
                  <div class="col-lg-6 text-right">
                    <label class="custom-toggle">
                      <input type="checkbox" name="usarfacebook" <?php echo ($this->config->item("usarfacebook") == 1 ? "checked" : '') ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="linkpaginafacebook">Link da página</label>
                      <input type="url" value="<?php echo $this->config->item("linkpaginafacebook"); ?>"
                        name="linkpaginafacebook" id="linkpaginafacebook" class="form-control form-control-alternative">
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