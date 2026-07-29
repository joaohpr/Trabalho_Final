$(document).ready(function () {

    // Abre a modal de perfil ao clicar no botão da sidebar
    $('#openProfile').on('dblclick', function () {
        $('#modal-window').load('../html/windowProfile.html #prof-container', function (response, status) {
            if (status === 'error') {
                console.error('Erro ao carregar o menu de perfil.');
                return;
            }

            $('#modal-window').css('display', 'flex');
        });
    });

    // Fecha clicando no X (delegação: o botão só existe após o .load())
    $('#modal-window').on('click', '#prof-close-btn', function () {
        fecharModalPerfil();
    });

    // Fecha clicando no fundo escuro, fora do card
    $('#modal-window').on('click', function (e) {
        if (e.target.id === 'modal-window') {
            fecharModalPerfil();
        }
    });

    // Fecha com a tecla ESC
    $(document).on('keydown', function (e) {
        if (e.key === 'Escape') {
            fecharModalPerfil();
        }
    });

    // Preview da imagem escolhida no upload de avatar
    $('#modal-window').on('change', '#prof-avatar-input', function (event) {
        const file = event.target.files[0];

        if (!file) return;

        if (!file.type.startsWith('image/')) {
            console.error('Selecione um arquivo de imagem válido.');
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            $('#prof-avatar-preview').attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
    });

    // Atalho: abrir configurações a partir de dentro do menu de perfil
    $('#modal-window').on('click', '#prof-open-settings', function () {
        fecharModalPerfil();
        $('#openSettings').trigger('click');
    });

    // Sair da conta: redireciona para a tela de login
    $('#modal-window').on('click', '#prof-logout', function () {
        window.location.href = 'login.html';
    });

    function fecharModalPerfil() {
        $('#modal-window').css('display', 'none').empty();
    }

});