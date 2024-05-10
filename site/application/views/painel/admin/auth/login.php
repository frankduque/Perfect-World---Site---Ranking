<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-gradient-primary py-7 py-lg-8">
  <div class="separator separator-bottom separator-skew zindex-100">
    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
      <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
    </svg>
  </div>
</div>
<!-- Page content -->
<div class="container mt--20 pb-5">
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
      <div class="card bg-secondary shadow border-0">
        <div class="card-body px-lg-5 py-lg-5">
            <?php if (validation_errors() != false): ?>
              <div class="alert alert-danger" role="alert">
                <strong>Erro!</strong>
                <?= validation_errors() ?>
              </div>
          <?php endif; ?>
          <form id="Form" method="post" action="<?php echo base_url("admin/login/logar") ?>">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

            <?php if ($this->config->item("usarrecaptcha") == 1 and ! is_null($this->config->item("recaptchasitekey"))) : ?>
                <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('recaptcha_site_key') ?>" data-callback="Submit" data-size="invisible"></div>
            <?php endif; ?>

            <div class="form-group mb-3">
              <h2 class="mb-3">Login</h2>
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <?php
                $data = [
                  'type' => "email",
                  "class" => "form-control",
                  "name" => "email",
                  "autocomplete" => "email",
                  "placeholder" => "Email",
                  "value" => $this->session->flashdata('email'),
                ];
                echo form_input($data, (null !== $this->session->flashdata('login') ? $this->session->flashdata('login') : ''));
                ?>

              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <?php
                $data = [
                  "class" => "form-control",
                  "name" => "senha",
                  "autocomplete" => "current-password",
                  "placeholder" => "Senha",
                  'required' => 'required',
                  "data-parsley-length" => '[8, 20]'
                ];
                echo form_password($data);
                ?>

              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary my-4">Logar</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

