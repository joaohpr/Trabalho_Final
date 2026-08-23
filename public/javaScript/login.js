/* =========================================================
   LOGIN
   Validação client-side + fluxo de submit simulado
   (não há backend neste projeto, então a "autenticação" é
   apenas demonstrativa: qualquer usuário/senha válidos
   nas regras do formulário são aceitos).
   Requer jQuery 4.0.0 e formUtils.js.
   ========================================================= */

$(function () {

    const $form = $("#formLogin");
    if ($form.length === 0) return;

    const $username = $("#inputUsername");
    const $password = $("#inputPassword");
    const $divUsername = $("#divUsername");
    const $divPassword = $("#divPassword");
    const $button = $("#buttonLogin");

    CineSearchForms.bindPasswordToggle("#toggleLoginPassword", "#inputPassword");

    // Preenche o usuário lembrado, se houver, sem usar localStorage
    // (aqui simulamos apenas o comportamento visual do checkbox).
    $("#rememberMe").on("change", function () {
        CineSearchForms.showToast(
            $(this).is(":checked") ? "Vamos lembrar de você neste dispositivo." : "Tudo bem, não vamos lembrar.",
            "success",
            2000
        );
    });

    $("#forgotPasswordLink").on("click", function (e) {
        e.preventDefault();
        CineSearchForms.showToast("Em breve: recuperação de senha por e-mail.", "success");
    });

    function validateUsername() {
        const value = $username.val().trim();

        if (value.length === 0) {
            CineSearchForms.markInvalid($divUsername, "Informe seu usuário.");
            return false;
        }

        if (value.length < 3) {
            CineSearchForms.markInvalid($divUsername, "Use pelo menos 3 caracteres.");
            return false;
        }

        CineSearchForms.markValid($divUsername);
        return true;
    }

    function validatePassword() {
        const value = $password.val();

        if (value.length === 0) {
            CineSearchForms.markInvalid($divPassword, "Informe sua senha.");
            return false;
        }

        if (value.length < 6) {
            CineSearchForms.markInvalid($divPassword, "Mínimo de 6 caracteres.");
            return false;
        }

        CineSearchForms.markValid($divPassword);
        return true;
    }

    // Validação em tempo real, sem incomodar antes do primeiro blur
    $username.on("blur", validateUsername);
    $password.on("blur", validatePassword);

    $username.on("input", () => CineSearchForms.clearState($divUsername));
    $password.on("input", () => CineSearchForms.clearState($divPassword));

    $form.on("submit", function (e) {
        e.preventDefault();

        const usernameOk = validateUsername();
        const passwordOk = validatePassword();

        if (!usernameOk || !passwordOk) {
            CineSearchForms.showToast("Verifique os campos destacados.", "error");
            return;
        }

        CineSearchForms.setLoading($button, true, "Entrando...");

        // Simulação de chamada de rede (sem backend real neste projeto)
        setTimeout(() => {
            CineSearchForms.setLoading($button, false);
            CineSearchForms.showToast(`Bem-vindo, ${$username.val().trim()}!`, "success");

            setTimeout(() => {
                window.location.href = "home.html";
            }, 900);
        }, 1100);
    });

});
