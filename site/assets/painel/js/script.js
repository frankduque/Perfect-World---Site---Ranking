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

    if ($("#Form").length != 0) {
        $('#Form').parsley().on('field:validated', function () {
            var ok = $('.parsley-error').length === 0;
        }).on('form:submit', function () {
            grecaptcha.execute();
            return false;
        });
    }
});

function Submit(token) {
    document.getElementById("Form").submit();
}