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

    var fieldsSelector =
        "#input-name, #input-username, #input-email, #input-password";


    function validate(field) {

        var input = $(field);

        var isValid =
            field.checkValidity() &&
            input.val().trim() !== "";

        input
            .toggleClass("is-valid", isValid)
            .toggleClass("is-invalid", !isValid);

        return isValid;
    }


    onDoubleTapOrClick("#openProfile", function () {

        modal.load(
            "windowProfile.html #Global",
            function (_, status, xhr) {

                if (status === "error") {

                    console.error(
                        "Erro ao carregar o perfil:",
                        xhr.status,
                        xhr.statusText
                    );

                    return;
                }

                modal.css("display", "flex");

            }
        );

    });


    modal.on("click", "#btn-close", function () {

        modal.hide().empty();

    });


    modal.on("change", "#prof-avatar-input", function (event) {

        var file = event.target.files[0];

        if (!file) {
            return;
        }

        if (!file.type.startsWith("image/")) {

            console.error(
                "O arquivo selecionado não é uma imagem."
            );

            return;
        }

        var imageURL = URL.createObjectURL(file);

        $("#prof-avatar-preview").attr(
            "src",
            imageURL
        );

    });


    modal.on(
        "input blur",
        fieldsSelector,
        function () {

            validate(this);

        }
    );


    modal.on("click", "#btn-save", function () {

        var fields = modal.find(fieldsSelector);

        var isFormValid =
            fields.toArray().every(validate);

        if (!isFormValid) {

            fields
                .filter(".is-invalid")
                .first()
                .trigger("focus");

            return;
        }

        var button = $(this);

        button
            .prop("disabled", true)
            .html(
                '<span class="spinner-border spinner-border-sm"></span> Salvando...'
            );

        setTimeout(function () {

            window.location.href = "home.html";

        }, 600);

    });

});