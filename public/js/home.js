$(function () {


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
       CURTIR / DESCURTIR FILME
    ===================================================== */

    $(document).on(
        'click',
        '#bntCurtir',
        function (event) {

            event.stopPropagation();


            var color = $(this).css('color');


            if (color === 'rgb(255, 0, 0)') {

                $(this)
                    .css('color', 'gray')
                    .css('border', 'solid gray');

            } else {

                $(this)
                    .css('color', 'red')
                    .css('border', 'solid red');

            }

        }
    );


    /* =====================================================
       FECHAR WINDOW CARD
    ===================================================== */

    $(document).on(
        'click',
        '#modal-window #close',
        function (event) {

            event.stopPropagation();


            $('#modal-window')
                .css(
                    'display',
                    'none'
                )
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


    /* =====================================================
       FECHAR POPUP PELO X
    ===================================================== */

    $(document).on(
        'click',
        '#modal #close-avaliacao',
        function (event) {

            event.stopPropagation();


            fecharAvaliacao();

        }
    );


    /* =====================================================
       CANCELAR AVALIAÇÃO
    ===================================================== */

    $(document).on(
        'click',
        '#modal #cancelar',
        function (event) {

            event.stopPropagation();


            fecharAvaliacao();

        }
    );


    function fecharAvaliacao() {

        $('#modal')
            .css(
                'display',
                'none'
            )
            .empty();

    }


    /* =====================================================
       SELECIONAR ESTRELAS
    ===================================================== */

    $(document).on(
        'click',
        '#modal .btn-avaliar',
        function (event) {

            event.stopPropagation();


            const notaSelecionada =
                Number(
                    $(this).val()
                );


            $('#modal .btn-avaliar').each(
                function () {

                    const valor =
                        Number(
                            $(this).val()
                        );


                    if (
                        valor <=
                        notaSelecionada
                    ) {

                        $(this)
                            .addClass(
                                'selecionada'
                            );

                    } else {

                        $(this)
                            .removeClass(
                                'selecionada'
                            );

                    }

                }
            );

        }
    );


    /* =====================================================
       ENVIAR AVALIAÇÃO
    ===================================================== */

    $(document).on(
        'click',
        '#modal #enviar',
        function (event) {

            event.stopPropagation();

            let nota = 0;

            $('#modal .btn-avaliar.selecionada')
                .each(
                    function () {

                        nota = Math.max(
                            nota,
                            Number(
                                $(this).val()
                            )
                        );

                    }
                );

            let comentario =
                $('#modal .input-comentario').val();

            if (comentario == '' && nota == 0) {

                $('.input-comentario')
                    .attr('placeholder',
                        'Você deve praticar alguma ação para poder criar uma avaliação!'
                    );

            } else {

                fecharAvaliacao();

            }
        }
    );

});