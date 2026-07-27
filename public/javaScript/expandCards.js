$(document).ready(function () {

    $(document).on('dblclick', '.cards', function () {

        $('#modal-window').load('../html/expandCards.html #container-global', function (response, status) {

            if (status === 'error') {

                console.error('Erro ao carregar o menu de configurações.');
                return;
            }

            $('#modal-window').css('display', 'flex');

        });

    });

    $(document).on('click', '.close-btn', function () {

        $('#modal-window').css('display', 'none').empty();

    });

});