/* =========================================================
   FORM UTILS
   Funções reutilizáveis para os formulários de Login e
   Criar Conta: toast de feedback, toggle de senha e
   helpers de validação visual.
   Requer jQuery 4.0.0.
   ========================================================= */

const CineSearchForms = (function () {

    let toastTimer = null;

    /** Mostra uma notificação temporária no rodapé da tela. */
    function showToast(message, type = "success", duration = 3200) {
        const $toast = $("#toast");
        if ($toast.length === 0) return;

        clearTimeout(toastTimer);

        $toast
            .text(message)
            .removeClass("error show")
            .toggleClass("error", type === "error")
            .addClass("show");

        toastTimer = setTimeout(() => {
            $toast.removeClass("show");
        }, duration);
    }

    /** Alterna a visibilidade de um campo de senha e o ícone associado. */
    function bindPasswordToggle(buttonSelector, inputSelector) {
        $(buttonSelector).on("click", function () {
            const $btn = $(this);
            const $input = $(inputSelector);
            const isPassword = $input.attr("type") === "password";

            $input.attr("type", isPassword ? "text" : "password");
            $btn.find("i").toggleClass("fa-eye fa-eye-slash");
            $btn.attr("aria-pressed", isPassword ? "true" : "false");
            $btn.attr("aria-label", isPassword ? "Ocultar senha" : "Mostrar senha");
        });
    }

    /** Marca um campo como inválido, exibindo a mensagem de erro. */
    function markInvalid($wrapper, message) {
        $wrapper.removeClass("valid").addClass("invalid");
        $wrapper.find(".field-error").text(message || "");
    }

    /** Marca um campo como válido, limpando a mensagem de erro. */
    function markValid($wrapper) {
        $wrapper.removeClass("invalid").addClass("valid");
        $wrapper.find(".field-error").text("");
    }

    /** Remove os estados de validação (usado ao digitar novamente). */
    function clearState($wrapper) {
        $wrapper.removeClass("invalid valid");
        $wrapper.find(".field-error").text("");
    }

    /** Ativa/desativa o estado de carregamento de um botão de submit. */
    function setLoading($button, isLoading, labelWhenLoading = "Entrando...") {
        const $label = $button.find(".btnLabel");

        if (isLoading) {
            $button.data("original-label", $label.text());
            $label.text(labelWhenLoading);
            $button.addClass("loading").prop("disabled", true);
        } else {
            $label.text($button.data("original-label") || $label.text());
            $button.removeClass("loading").prop("disabled", false);
        }
    }

    return {
        showToast,
        bindPasswordToggle,
        markInvalid,
        markValid,
        clearState,
        setLoading
    };

})();
