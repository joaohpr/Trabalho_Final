$(document).ready(function () {

    var modal = $('#modal-window');


    $('#openSettings').click(function () {

        abrirModal(modal);

    });


    modal.on("click", "#backButton", function () {

        fecharModal(modal);

    });


    modal.on('click', '.cfg-card', function () {

        var card = $(this);

        card.toggleClass('cfg-card-selected');

    });


    function abrirModal(modal) {

        modal.load(
            "../html/windowMenu.html #container-main",

            function (response, status) {

                if (status === "error") {

                    console.error("Erro ao carregar o windowMenu.");

                    return;

                }

                modal.css("display", "flex");

            }

        );

    }


    function fecharModal(modal) {

        modal.css("display", "none").empty();

    }

});