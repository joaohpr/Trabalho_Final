$(document).ready(function () {

    $('#openSettings').on('click', function () {
        $('#modal-window').load('../html/menuConfig.html #cfg-container', function (response, status) {
            if (status === 'error') {
                console.error('Erro ao carregar o menu de configurações.');
                return;
            }
            $('#modal-window').css('display', 'flex');
        });
    });

    $('#modal-window').on('click', '#cfg-close-btn', function () {
        $('#modal-window').css('display', 'none').empty();
    });

});