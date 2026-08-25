$(document).ready(function () {

    var ultimoToque = 0;

    $(document).on("dblclick", ".cards", function () {

        abrirCard(this);

    });

    $(document).on("touchend", ".cards", function (evento) {

        var agora = Date.now();

        if (agora - ultimoToque < 300) {

            evento.preventDefault();

            abrirCard(this);

            ultimoToque = 0;

        } else {

            ultimoToque = agora;

        }

    });


    function abrirCard(card) {

        $("#modal-window").load(
            "expandCards.html #container-global",
            function (response, status) {

                if (status === "error") {

                    console.error(
                        "Erro ao carregar o conteúdo do card."
                    );

                    return;
                }

                $("#modal-window").css("display", "flex");

            }
        );

    }


    $(document).on("click", ".close-btn", function () {

        $("#modal-window")
            .css("display", "none")
            .empty();

    });

});