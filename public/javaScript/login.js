$(document).ready(function () {

    $("#formLogin").submit(function (evento) {

        evento.preventDefault();

        let username = $("#inputUsername").val().trim();
        let password = $("#inputPassword").val().trim();

        $("#inputUsername").removeClass("is-valid is-invalid");
        $("#inputPassword").removeClass("is-valid is-invalid");

        let valido = true;

        if (username === "") {

            $("#inputUsername").addClass("is-invalid");

            valido = false;

        } else {

            $("#inputUsername").addClass("is-valid");

        }

        if (password === "") {

            $("#inputPassword").addClass("is-invalid");

            valido = false;

        } else {

            $("#inputPassword").addClass("is-valid");

        }

        if (!valido) {
            return;
        }

        window.location.href = "public/html/home.html";

    });

});