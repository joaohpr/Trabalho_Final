<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CineSearch</title>


    <!-- Bootstrap -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">


    <!-- Font Awesome -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <!-- Bootstrap Icons -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- CSS Window Card -->

    <link rel="stylesheet" href="../css/windowCards.css">

</head>


<body>


    <!-- ==================================================
         WINDOW CARD
    =================================================== -->

    <div id="container-global">


        <!-- ==================================================
             CAIXA PRINCIPAL
        =================================================== -->

        <div id="caixa">


            <!-- CABEÇALHO -->

            <div id="cabecalho">

                <h1 class="h-text">
                    Details
                </h1>


                <button id="close" class="btn-close-custom" type="button" aria-label="Fechar">
                    &times;
                </button>

            </div>


            <!-- ==================================================
                 CONTEÚDO
            =================================================== -->

            <div id="conteudo">


                <!-- FILME -->

                <div class="filme">


                    <!-- POSTER -->

                    <img src="../img/CineSearch.png" id="poster" class="img-fluid" alt="Poster do filme">


                    <!-- INFORMAÇÕES -->

                    <div id="info">


                        <h1 id="titulo">
                            Nome do Filme
                        </h1>


                        <p id="meta">
                            2024 • 1h 45min • Drama
                        </p>


                        <p id="nota">
                            ★ 8.5 / 10
                        </p>


                        <!-- ==================================================
                             AÇÕES
                        =================================================== -->

                        <div class="acoes">


                            <!-- AVALIAR -->

                            <button type="button" class="btn-avaliar" id="bntAvaliar" aria-label="Avaliar filme">

                                <i class="bi bi-star-fill"></i>

                            </button>


                            <!-- CURTIR -->

                            <button type="button" class="btn-curtir" id="bntCurtir" aria-label="Curtir filme">

                                <i class="bi bi-heart-fill"></i>

                            </button>


                        </div>


                        <!-- DESCRIÇÃO -->

                        <p id="descricao">

                            Lorem ipsum dolor sit amet
                            consectetur adipisicing elit.
                            Fugiat beatae explicabo dolor
                            quia nesciunt.

                        </p>


                    </div>

                </div>


                <!-- ==================================================
                     INFORMAÇÕES
                =================================================== -->

                <div class="secao">


                    <h2>
                        Informações
                    </h2>


                    <div class="informacoes">


                        <div>

                            <small>
                                Idioma
                            </small>

                            <p>
                                Português
                            </p>

                        </div>


                        <div>

                            <small>
                                Lançamento
                            </small>

                            <p>
                                10/05/2024
                            </p>

                        </div>


                    </div>


                </div>


                <!-- ==================================================
                     GÊNEROS
                =================================================== -->

                <div class="secao">


                    <h2>
                        Gêneros
                    </h2>


                    <div id="generos" class="d-flex flex-wrap gap-2">


                        <button type="button" class="btn btn-dark">
                            Comédia
                        </button>


                        <button type="button" class="btn btn-dark">
                            Drama
                        </button>


                        <button type="button" class="btn btn-dark">
                            Terror
                        </button>


                        <button type="button" class="btn btn-dark">
                            Aventura
                        </button>


                    </div>


                </div>


            </div>


        </div>


        <!-- ==================================================
             MODAL DO POPUP DE AVALIAÇÃO

             Fica dentro do container-global para que
             seja carregado junto com o Window Card.
        =================================================== -->

        <div id="modal"></div>


    </div>


    <!-- ==================================================
         JQUERY
    =================================================== -->

    <script src="../js/lib/jquery-4.0.0.js"></script>

    <script src="../js/windowCards.js"></script>


</body>

</html>