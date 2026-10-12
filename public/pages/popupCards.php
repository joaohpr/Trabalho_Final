<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Avaliar filme</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../css/popupCards.css">

</head>

<body>

    <div id="popup-avaliacao">

        <div id="avaliacao">

            <div class="header">

                <h4 class="title">
                    Avaliar
                </h4>

                <button type="button" id="close-avaliacao" aria-label="Fechar">
                    X
                </button>

            </div>


            <div class="estrelas">

                <button type="button" class="btn-avaliar" value="1" aria-label="1 estrela">
                    <i class="bi bi-star-fill"></i>
                </button>


                <button type="button" class="btn-avaliar" value="2" aria-label="2 estrelas">
                    <i class="bi bi-star-fill"></i>
                </button>


                <button type="button" class="btn-avaliar" value="3" aria-label="3 estrelas">
                    <i class="bi bi-star-fill"></i>
                </button>


                <button type="button" class="btn-avaliar" value="4" aria-label="4 estrelas">
                    <i class="bi bi-star-fill"></i>
                </button>


                <button type="button" class="btn-avaliar" value="5" aria-label="5 estrelas">
                    <i class="bi bi-star-fill"></i>
                </button>

            </div>


            <div class="container-fluid" id="campo-descricao">

                <header class="header">

                    <h4 class="tilte">Comente</h4>
                </header>

               <textarea class="input-comentario" maxlength="1000"></textarea>

            </div>


            <div id="options">

                <button type="button" id="cancelar">
                    Cancelar
                </button>


                <button type="button" id="enviar">
                    Enviar
                </button>

            </div>

        </div>

    </div>

</body>
</html>