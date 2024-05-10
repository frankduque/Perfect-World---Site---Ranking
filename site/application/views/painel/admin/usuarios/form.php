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
              <h6 class="text-uppercase text-muted ls-1 mb-1">Usuários</h6>
              <h2 class="mb-0"><?php echo ($usuario->id ? "Editar" : "Cadastrar") ?> Usuário</h2>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <?php if (validation_errors() != false): ?>
                <div class="alert alert-danger" role="alert">
                  <strong>Falha ao <?php echo ($usuario->id ? "editar" : "cadastrar") ?> o usuário</strong>
                  <?= validation_errors() ?>
                </div>
                <?php
              endif;
              $atributos = array('id' => 'Form');
              echo form_open('admin/usuarios/salvar/' . $usuario->id, $atributos)
                ?>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="nome">Nome</label>
                    <input required type="text" value="<?php echo $usuario->nome ?>" name="nome" class="form-control"
                      placeholder="Nome">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group focused">
                    <label class="form-control-label" for="cargo">Cargo</label>
                    <select required name="cargo" class="form-control">
                      <option value="">Selecione um Cargo</option>
                      <option <?= ($usuario->permissao == "Admin" ? "selected" : null) ?> value="Admin">Administrador

                      <?php foreach ($cargos_dropdown as $id => $cargo): ?>
                        <option <?= ($usuario->cargo_id == $id ? "selected" : null) ?>
                          value="<?php echo $id ?>"><?php echo $cargo ?></option>
                      <?php endforeach; ?>
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group focused">
                    <label class="form-control-label" for="nome">Senha</label>
                    <input type="password" id="senha" data-parsley-minlength="6" name="senha" class="form-control"
                      placeholder="Senha">
                    <?php if ($usuario->id): ?>
                      <h6 class="heading-small text-muted">
                        <small>Deixe os campos de senha em brancos para não alterar a senha.</small>
                      </h6>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group focused">
                    <label class="form-control-label" for="nome">Repetir Senha</label>
                    <input type="password" data-parsley-equalto="#senha" name="resenha" class="form-control"
                      placeholder="Repetir Senha">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group focused">
                    <label class="form-control-label" for="nome">Email</label>
                    <input data-parsley-remote-reverse="true" data-parsley-remote-message="Este email já está em uso"
                      placeholder="Email" required type="email" name="email" class="form-control" id="email"
                      data-parsley-trigger="change"
                      data-parsley-remote="<?php echo base_url("usuarios/usuarioexiste") ?>"
                      data-parsley-remote-options='{ "type": "POST", "dataType": "json", "data": { <?php echo json_encode($this->security->get_csrf_token_name()) ?> : <?php echo json_encode($this->security->get_csrf_hash()) ?>, "id" : <?php echo json_encode($usuario->id) ?> } }'
                      value="<?php echo $usuario->email ?>">
                  </div>
                </div>
              </div>
              <hr class="my-4" />
              <button type="submit" class="btn btn-primary btn-lg float-right"><?php echo ($usuario->id ? "Atualizar" : "Cadastrar") ?> Usuário</button>
              <a href="<?php echo base_url("admin/usuarios") ?>"
                class="mr-3 btn btn-warning btn-lg float-right">Cancelar</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>