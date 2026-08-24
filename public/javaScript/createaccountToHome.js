$(document).ready(function () {

    $("#buttonCreateAccount").click(function () {

        let username = $("#username").val().trim();
        let email = $("#email").val().trim();
        let password = $("#password").val().trim();
        let confirmPassword = $("#confirm-password").val().trim();

        if (username === "" || email === "" || password === "" || confirmPassword === "") {
            alert("Preencha todos os campos.");
            return;
        }

        if (password !== confirmPassword) {
            alert("As senhas não são iguais.");
            return;
        }

        window.location.href = "../../index.html";

    });

});