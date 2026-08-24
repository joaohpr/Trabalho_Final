$(document).ready(function () {

    $("#formCreateAccount").submit(function (evento) {

        evento.preventDefault();

        let username = $("#username").val().trim();
        let email = $("#email").val().trim();
        let password = $("#password").val().trim();
        let confirmPassword = $("#confirm-password").val().trim();

        if (username === "" || email === "" || password === "" || confirmPassword === "") {
            alert("Preencha todos os campos.");
            return;
        }

        if (password.length < 6) {
            alert("A senha deve ter pelo menos 6 caracteres.");
            return;
        }

        if (password !== confirmPassword) {
            alert("As senhas não são iguais.");
            return;
        }

        var novoUsuario = {
            username: username,
            email: email,
            password: password
        };

        localStorage.setItem("usuario-logado", JSON.stringify(novoUsuario));

        window.location.href = "home.html";

    });

});