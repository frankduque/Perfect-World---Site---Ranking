$(window).on('load', function () {
    $(".loader-wrapper").hide();

    $('.slider-classes').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});

var dTables = $('.dTablesselector');
if (dTables.length)
{
    dTables.DataTable({
        responsive: false,
        info: false,
        language: {
            search: '',
            searchPlaceholder: 'Pesquise aqui...',
            paginate: {
                previous: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
                next: '<i class="fa fa-chevron-right" aria-hidden="true"></i>'
            },
            "sEmptyTable": "Nenhum registro encontrado",
            "sLengthMenu": "Mostrar _MENU_ resultados",

        }
    });
}
var nTables = $('#cladetail');
if (nTables.length)
{
    nTables.DataTable({
        responsive: true,
        info: false,
        language: {
            search: '',
            searchPlaceholder: 'Pesquise aqui...',
            paginate: {
                previous: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
                next: '<i class="fa fa-chevron-right" aria-hidden="true"></i>'
            },
            "sEmptyTable": "Nenhum registro encontrado",
            "sLengthMenu": "_MENU_ resultados",

        }
    });
}
var nTables = $('#listacla');
if (nTables.length)
{
    nTables.DataTable({
         "order": [[ 4, "desc" ]],
        responsive: true,
        info: false,
        language: {
            search: '',
            searchPlaceholder: 'Pesquise aqui...',
            paginate: {
                previous: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
                next: '<i class="fa fa-chevron-right" aria-hidden="true"></i>'
            },
            "sEmptyTable": "Nenhum registro encontrado",
            "sLengthMenu": "_MENU_ resultados",

        }
    });
}
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})