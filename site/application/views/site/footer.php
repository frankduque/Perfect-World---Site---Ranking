<footer class="footer">
  <a href="<?= base_url() ?>">
    <img class="w-100"
      src="<?= base_url() ?>assets/upload/logo.<?= $this->config->item("extlogo") . "?v=" . $this->config->item("vlogo") ?>"
      alt="<?= $this->config->item("nomeservidor") ?>">
  </a>
  <ul class="footer-menu">
    <li class="active">
      <a href="<?= base_url() ?>">
        Inicio
      </a>
    </li>
    <li>
      <a href="<?= base_url("racas") ?>">
        Raças
      </a>
    </li>
    <li>
      <a href="<?= base_url("classes") ?>">
        Classes
      </a>
    </li>
    <li>
      <a href="<?= base_url("competitivo") ?>">
        Competitivo
      </a>
    </li>
    <li>
      <a href="<?= base_url("downloads") ?>">Downloads</a>

    </li>
    <li>
      <a href="<?= base_url("informacoes") ?>">informacoes</a>

    </li>

  </ul>
  <div class="mt60">
    &nbsp;
  </div>
  <div class="social-content mt30">
    <div class="social-list">
      <a href="https://www.linkedin.com/in/frankduque3/" target="_blank">
        <i class="fab fa-linkedin" aria-hidden="true"></i>
      </a>
    </div>

    <div class="social-list">
      <a href="https://api.whatsapp.com/send?phone=5562284498599&text=Ol%C3%A1%20Frank" target="_blank">
        <i class="fab fa-whatsapp" aria-hidden="true"></i>
      </a>
    </div>
    <div class="social-list">
      <a href="mailto:contato@frankduque.com" target="_blank">
        <i class="fa fa-envelope-open-text" aria-hidden="true"></i>
      </a>
    </div>
  </div>


</footer>
<div class="copyright ptb30 col-lg-12">

  <div class="row">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="font-weight: 700;color: #ffffff!important;">
      © <?= $this->config->item("nomeservidor") ?> 2019
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right" style="font-weight: 700;color: #ffffff!important;">
      Todos os direitos reservados
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
  integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="<?= base_url("assets/plugins/DataTables/datatables.min.js") ?>"></script>
<script src="<?= base_url("assets/plugins/DataTables/dataTables.responsive.min.js") ?>"></script>
<script src="<?= base_url("assets/site/js/script.js") ?>"></script>
<?php if ($this->config->item("usardisqus") == 1 and !empty($this->config->item("disqusshortname")) and !is_null($this->config->item("disqusshortname")) and ($pagina == "noticias" or $pagina == "noticia" or $pagina == "index")): ?>
  <script id="dsq-count-scr" src="//<?= $this->config->item("disqusshortname") ?>.disqus.com/count.js" async></script>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<?php if (null !== $this->session->flashdata('tipo')): ?>
  <script>
    Swal.fire({
      type: '<?= $this->session->flashdata('tipo') ?>',
      title: '<?= $this->session->flashdata('titulo') ?>',
      text: '<?= $this->session->flashdata('msg') ?>',

    })
  </script>
<?php endif; ?>

<img id="toasty" src="<?php echo base_url("assets/painel/img/toasty.png") ?>">
<script>
  // a key map of allowed keys
  var allowedKeys = {
    37: 'left',
    38: 'up',
    39: 'right',
    40: 'down',
    65: 'a',
    66: 'b'
  };
  // the 'official' Konami Code sequence
  var konamiCode = ['up', 'up', 'down', 'down', 'left', 'right', 'left', 'right', 'b', 'a'];
  // a variable to remember the 'position' the user has reached so far.
  var konamiCodePosition = 0;
  // add keydown event listener
  document.addEventListener('keydown', function (e) {
    // get the value of the key code from the key map
    var key = allowedKeys[e.keyCode];
    // get the value of the required key from the konami code
    var requiredKey = konamiCode[konamiCodePosition];
    // compare the key with the required key
    if (key == requiredKey) {

      // move to the next key in the konami code sequence
      konamiCodePosition++;
      // if the last key is reached, activate cheats
      if (konamiCodePosition == konamiCode.length) {
        activateCheats();
        konamiCodePosition = 0;
      }
    } else {
      konamiCodePosition = 0;
    }
  });
  function activateCheats() {
    var audio = new Audio("<?php echo base_url("assets/painel/mp3/toasty.mp3") ?>");
    audio.play();
    var element = document.getElementById("toasty");
    element.classList.add("show");
    element.classList.add("d-block");
    setTimeout(function () {
      element.classList.remove("show");
    }, 2000);
    setTimeout(function () {
      element.classList.remove("d-block");
    }, 2500);
  }
</script>

</html>