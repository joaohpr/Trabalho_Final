$(function () {


    /* =====================================================
       CURTIR FILME
    ===================================================== */

    $('.btn-curtir').each(function (index) {

        const button = $(this);

        const key = 'filme-curtido-' + index;


        function update(curtiu) {

            button
                .toggleClass('curtiu', curtiu)
                .text(curtiu ? '♥' : '♡');

            localStorage.setItem(key, curtiu);

        }


        update(
            localStorage.getItem(key) === 'true'
        );


        button.on('click', function (event) {

            event.stopPropagation();

            update(
                !button.hasClass('curtiu')
            );

        });

    });



    /* =====================================================
       FAVORITAR FILME
    ===================================================== */

    $('.btn-favorito').each(function (index) {

        const button = $(this);

        const key = 'filme-favorito-' + index;


        function update(isFavorite) {

            button.toggleClass(
                'favoritado',
                isFavorite
            );

            localStorage.setItem(
                key,
                isFavorite
            );

        }


        update(
            localStorage.getItem(key) === 'true'
        );


        button.on('click', function (event) {

            event.stopPropagation();

            update(
                !button.hasClass('favoritado')
            );

        });

    });



    /* =====================================================
       ABRIR WINDOW CARD
    ===================================================== */

    let ultimoToque = 0;


    $(document).on(
        'dblclick',
        '.cards',
        function () {

            abrirCard(this);

        }
    );


    $(document).on(
        'touchend',
        '.cards',
        function (evento) {

            const agora = Date.now();


            if (agora - ultimoToque < 300) {

                evento.preventDefault();

                abrirCard(this);

                ultimoToque = 0;

            } else {

                ultimoToque = agora;

            }

        }
    );


    function abrirCard(card) {

        const modalWindow = $('#modal-window');


        modalWindow.load(
            'windowCards.html #container-global',

            function (response, status) {

                if (status === 'error') {

                    console.error(
                        'Erro ao carregar o Window Card.'
                    );

                    return;

                }


                modalWindow.css(
                    'display',
                    'flex'
                );

            }
        );

    }



    /* =====================================================
       FECHAR WINDOW CARD
    ===================================================== */

    $(document).on(
        'click',
        '#modal-window #close',
        function () {

            $('#modal-window')
                .css('display', 'none')
                .empty();

        }
    );



    /* =====================================================
       ABRIR POPUP DE AVALIAÇÃO
    ===================================================== */

    $(document).on(
        'click',
        '#bntAvaliar',
        function (event) {

            event.stopPropagation();


            const modal = $('#modal');


            modal.load(
                'popupCards.html #popup-avaliacao',

                function (response, status) {

                    if (status === 'error') {

                        console.error(
                            'Erro ao carregar popupCards.html.'
                        );

                        return;

                    }


                    modal.css(
                        'display',
                        'flex'
                    );

                }
            );

        }
    );
});