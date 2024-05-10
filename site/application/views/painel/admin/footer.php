<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Footer -->
<footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
                &copy; 2019 <a href="<?php echo base_url() ?>" class="font-weight-bold ml-1"
                    target="_blank"><?php echo $this->config->item("nomeservidor") ?></a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<img id="toasty" src="<?php echo base_url("assets/painel/img/toasty.png") ?>">

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/painel/js/parsley/parsley.js') ?>"></script>
<script src="<?php echo base_url('assets/painel/js/parsley/pt-br.js') ?>"></script>
<!--   Optional JS   -->
<!--   Argon JS   -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if (null !== $this->session->flashdata('tipo')): ?>
    <script>
        //use toast instead


    </script>
<?php endif; ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
<script src="<?php echo base_url('assets/painel/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/painel/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/painel/js/jquery.fileuploader.min.js') ?>" type="text/javascript"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    <?php if (null !== $this->session->flashdata('tipo')): ?>
        Toast.fire({
            icon: '<?php echo $this->session->flashdata('tipo') ?>',
            title: '<?php echo $this->session->flashdata('titulo') ?>',
            text: '<?php echo $this->session->flashdata('msg') ?>'

        });
    <?php endif; ?>
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

<script>
    $(document).ready(function () {
        if ($("#Form").length != 0) {
            $('#Form').parsley().on('field:validated', function () {
                var ok = $('.parsley-error').length === 0;
            });
        }
    });</script>
<script>
    $(document).ready(function () {
        $("[id^='dataTable']").each(function () {
            var $table = $(this);
            // Verifique se a tabela tem um atributo de ordem de dados
            var order = $table.data('order') || []; // Se não houver um atributo de ordem, use um array vazio
            $table.DataTable({
                keys: true,
                order: order,
                select: {
                    style: "multi"
                },
                language: {
                    paginate: {
                        previous: "<i class='fas fa-angle-left'></i>",
                        next: "<i class='fas fa-angle-right'></i>"
                    }
                }
            });
        });

    });
</script>
</body>

</html>