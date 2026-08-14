$(document).ready(function () {

    /*
     * =========================================================
     * ABRIR JANELA DE PERFIL
     * =========================================================
     */

    $('#openProfile').on('dblclick', function () {

        $('#modal-window').load(
            'windowProfile.html #Global',
            function (response, status, xhr) {

                if (status === 'error') {

                    console.error(
                        'Erro ao carregar o perfil:',
                        xhr.status,
                        xhr.statusText
                    );

                    return;
                }

                /*
                 * Mostra o modal somente depois que
                 * o conteúdo foi carregado.
                 */

                $('#modal-window').css('display', 'flex');

            }
        );

    });


    /*
     * =========================================================
     * FECHAR JANELA DE PERFIL
     * =========================================================
     *
     * O botão #btn-close é criado dinamicamente pelo .load().
     *
     * Por isso utilizamos delegação de eventos.
     */

    $('#modal-window').on(
        'click',
        '#btn-close',
        function () {

            $('#modal-window')
                .css('display', 'none')
                .empty();

        }
    );


    /*
     * =========================================================
     * ALTERAR FOTO DE PERFIL
     * =========================================================
     *
     * Também utilizamos delegação porque o input
     * é carregado dinamicamente.
     */

    $('#modal-window').on(
        'change',
        '#prof-avatar-input',
        function (event) {

            const file = event.target.files[0];

            if (!file) {
                return;
            }

            /*
             * Verifica se o arquivo selecionado
             * realmente é uma imagem.
             */

            if (!file.type.startsWith('image/')) {

                console.error(
                    'O arquivo selecionado não é uma imagem.'
                );

                return;
            }

            /*
             * Cria uma URL temporária para visualizar
             * a imagem selecionada.
             */

            const imageURL = URL.createObjectURL(file);

            $('#prof-avatar-preview').attr(
                'src',
                imageURL
            );

        }
    );


    /*
     * =========================================================
     * SALVAR
     * =========================================================
     *
     * Por enquanto apenas recuperamos os valores.
     * Posteriormente essa parte poderá enviar os dados
     * para o backend.
     */

    $('#modal-window').on(
        'click',
        '#btn-save',
        function () {

            const name = $('#input-name').val();
            const username = $('#input-username').val();
            const email = $('#input-email').val();
            const password = $('#input-password').val();

            console.log('Nome:', name);
            console.log('Username:', username);
            console.log('Email:', email);
            console.log('Password:', password);

        }
    );

});