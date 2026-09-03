$(document).ready(function () {

    function onDoubleTapOrClick(selector, handler) {

        $(document).on("dblclick", selector, handler);

        var ultimoToque = {};

        $(document).on("touchend", selector, function (evento) {

            var agora = Date.now();
            var idElemento = $(this).attr("id") || selector;
            var toqueAnterior = ultimoToque[idElemento] || 0;

            if (agora - toqueAnterior < 300) {

                evento.preventDefault();

                handler.call(this, evento);

            }

            ultimoToque[idElemento] = agora;

        });
    }

    var modal = $("#modal-window");


    onDoubleTapOrClick("#openSettings", function () {

        modal.load(
            "../html/menuConfig.html #cfg-container",
            function (response, status) {

                if (status === "error") {

                    console.error(
                        "Erro ao carregar o menu de configurações."
                    );

                    return;
                }

                $(document).trigger(
                    "settings:loaded",
                    [modal]
                );

                modal.css("display", "flex");

            }
        );

    });


    modal.on("click", "#cfg-close-btn", function () {

        modal
            .css("display", "none")
            .empty();

    });

});