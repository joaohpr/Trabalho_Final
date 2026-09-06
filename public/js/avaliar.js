$(function () {

    function fecharPopup() {
        $('#modal')
            .css('display', 'none')
            .empty();
    }

    $(document)
        .off('click.popupCards', '#modal #popup-avaliacao .btn-avaliar')
        .on('click.popupCards', '#modal #popup-avaliacao .btn-avaliar', function () {
            const nota = Number($(this).val());
            const popup = $(this).closest('#popup-avaliacao');

            popup.find('.btn-avaliar').each(function () {
                $(this).toggleClass('selecionada', Number($(this).val()) <= nota);
            });

            popup.data('nota', nota);
        })
        .off('click.popupCards', '#modal #popup-avaliacao #close, #modal #popup-avaliacao #cancelar')
        .on('click.popupCards', '#modal #popup-avaliacao #close, #modal #popup-avaliacao #cancelar', fecharPopup)
        .off('click.popupCards', '#modal #popup-avaliacao #enviar')
        .on('click.popupCards', '#modal #popup-avaliacao #enviar', fecharPopup);
});
