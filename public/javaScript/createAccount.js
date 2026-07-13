/* =========================================================
   CREATE ACCOUNT
   Validação client-side completa: usuário, email, senha
   (com medidor de força), confirmação de senha e termos.
   Requer jQuery 4.0.0 e formUtils.js.
   ========================================================= */

$(function () {

    const $form = $("#formCreateAccount");
    if ($form.length === 0) return;

    const $username = $("#username");
    const $email = $("#email");
    const $password = $("#password");
    const $confirmPassword = $("#confirm-password");
    const $acceptTerms = $("#acceptTerms");

    const $divUsername = $("#divUsername");
    const $divEmail = $("#divEmail");
    const $divPassword = $("#divPassword");
    const $divConfirmPassword = $("#divConfirmPassword");

    const $button = $("#buttonCreate");
    const $strengthBar = $("#passwordStrength");
    const $strengthLabel = $("#passwordStrengthLabel");

    CineSearchForms.bindPasswordToggle("#togglePassword", "#password");
    CineSearchForms.bindPasswordToggle("#toggleConfirmPassword", "#confirm-password");

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    function validateUsername() {
        const value = $username.val().trim();

        if (value.length === 0) {
            CineSearchForms.markInvalid($divUsername, "Informe um usuário.");
            return false;
        }

        if (value.length < 3) {
            CineSearchForms.markInvalid($divUsername, "Use pelo menos 3 caracteres.");
            return false;
        }

        if (!/^[a-zA-Z0-9_.]+$/.test(value)) {
            CineSearchForms.markInvalid($divUsername, "Use apenas letras, números, ponto ou _.");
            return false;
        }

        CineSearchForms.markValid($divUsername);
        return true;
    }

    function validateEmail() {
        const value = $email.val().trim();

        if (value.length === 0) {
            CineSearchForms.markInvalid($divEmail, "Informe seu email.");
            return false;
        }

        if (!emailPattern.test(value)) {
            CineSearchForms.markInvalid($divEmail, "Email inválido.");
            return false;
        }

        CineSearchForms.markValid($divEmail);
        return true;
    }

    function getPasswordStrength(value) {
        let score = 0;
        if (value.length >= 6) score++;
        if (value.length >= 10) score++;
        if (/[A-Z]/.test(value) && /[a-z]/.test(value)) score++;
        if (/\d/.test(value)) score++;
        if (/[^A-Za-z0-9]/.test(value)) score++;

        if (score <= 1) return "weak";
        if (score <= 3) return "medium";
        return "strong";
    }

    function updateStrengthMeter() {
        const value = $password.val();

        if (value.length === 0) {
            $strengthBar.removeClass("weak medium strong");
            $strengthLabel.text("");
            return;
        }

        const level = getPasswordStrength(value);
        const labels = { weak: "Senha fraca", medium: "Senha média", strong: "Senha forte" };

        $strengthBar.removeClass("weak medium strong").addClass(level);
        $strengthLabel.text(labels[level]);
    }

    function validatePassword() {
        const value = $password.val();

        if (value.length === 0) {
            CineSearchForms.markInvalid($divPassword, "Crie uma senha.");
            return false;
        }

        if (value.length < 6) {
            CineSearchForms.markInvalid($divPassword, "Mínimo de 6 caracteres.");
            return false;
        }

        CineSearchForms.markValid($divPassword);
        return true;
    }

    function validateConfirmPassword() {
        const value = $confirmPassword.val();

        if (value.length === 0) {
            CineSearchForms.markInvalid($divConfirmPassword, "Confirme sua senha.");
            return false;
        }

        if (value !== $password.val()) {
            CineSearchForms.markInvalid($divConfirmPassword, "As senhas não coincidem.");
            return false;
        }

        CineSearchForms.markValid($divConfirmPassword);
        return true;
    }

    // Eventos em tempo real
    $username.on("blur", validateUsername);
    $username.on("input", () => CineSearchForms.clearState($divUsername));

    $email.on("blur", validateEmail);
    $email.on("input", () => CineSearchForms.clearState($divEmail));

    $password.on("input", function () {
        updateStrengthMeter();
        CineSearchForms.clearState($divPassword);
        if ($confirmPassword.val().length > 0) validateConfirmPassword();
    });
    $password.on("blur", validatePassword);

    $confirmPassword.on("input", () => CineSearchForms.clearState($divConfirmPassword));
    $confirmPassword.on("blur", validateConfirmPassword);

    $form.on("submit", function (e) {
        e.preventDefault();

        const results = [
            validateUsername(),
            validateEmail(),
            validatePassword(),
            validateConfirmPassword()
        ];

        if (!$acceptTerms.is(":checked")) {
            CineSearchForms.showToast("Você precisa aceitar os Termos de Uso.", "error");
            $acceptTerms.trigger("focus");
            return;
        }

        if (results.includes(false)) {
            CineSearchForms.showToast("Verifique os campos destacados.", "error");
            return;
        }

        CineSearchForms.setLoading($button, true, "Criando conta...");

        // Simulação de chamada de rede (sem backend real neste projeto)
        setTimeout(() => {
            CineSearchForms.setLoading($button, false);
            CineSearchForms.showToast(`Conta criada com sucesso, ${$username.val().trim()}!`, "success");

            setTimeout(() => {
                window.location.href = "login.html";
            }, 1000);
        }, 1200);
    });

});
