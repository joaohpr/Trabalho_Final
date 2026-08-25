$(document).ready(function () {

    function getStorageKey(card) {
        return 'card-selecionado-' + card.data('streaming');
    }

    function restoreSelectedCards(container) {
        $(container).find('.cfg-card[data-streaming]').each(function () {
            var card = $(this);
            var estaSelecionado = localStorage.getItem(getStorageKey(card));

        if (estaSelecionado === 'true') {
                card.addClass('cfg-card-selecionado');
            }
        }
        );
    }

    // O menu é inserido dinamicamente na Home; restaura as escolhas após o carregamento.
    $(document).on('settings:loaded', function (event, container) {
        restoreSelectedCards(container);
    });

    // Clique simples: marca o card com borda verde e salva no localStorage
    $(document).on('click', '.cfg-card', function () {
        var card = $(this);

        card.addClass('cfg-card-selecionado');
        localStorage.setItem(getStorageKey(card), 'true');
    });

    // Duplo clique: volta ao formato original e remove do localStorage
    $(document).on('dblclick', '.cfg-card', function () {
        var card = $(this);

        card.removeClass('cfg-card-selecionado');
        localStorage.removeItem(getStorageKey(card));
    });

});
