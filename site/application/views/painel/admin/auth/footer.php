<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<footer class="py-5 text-center">
  <div class="container">
    <div class="copyright mx-auto" style="display: block;">
      <a href="<?php echo base_url() ?>" class="font-weight-bold ml-1" target="_blank"><?php echo $this->config->item("nomeservidor") ?></a>
    </div>

  </div>
</footer>

</div>

<!--   Core   -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/painel/js/parsley/parsley.js') ?>"></script>
<script src="<?php echo base_url('assets/painel/js/parsley/pt-br.js') ?>"></script>
<?php if ($this->config->item("usarrecaptcha") == 1 and !empty($this->config->item("recaptchasitekey")) and ! is_null($this->config->item("recaptchasitekey"))) : ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>
<script src="<?php echo base_url('assets/painel/js/script.js') ?>"></script>
<!--   Optional JS   -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<?php if (null !== $this->session->flashdata('tipo')): ?>
    <script>
        Swal.fire({
            type: '<?php echo $this->session->flashdata('tipo') ?>',
            title: '<?php echo $this->session->flashdata('titulo') ?>',
            text: '<?php echo $this->session->flashdata('msg') ?>',
        })
    </script>
<?php endif; ?>


</body>

</html>