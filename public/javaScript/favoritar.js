$(document).ready(function () {

    $(document).on("touchend", ".btn-favorito", function (event) {

        event.preventDefault();

        $(this).toggleClass("favoritado");

    });

    $(document).on("click", ".btn-favorito", function () {

        if (!$(this).data("touch")) {
            $(this).toggleClass("favoritado");
        }

    });

});