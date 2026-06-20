$(document).ready(function () {

    $(".cards").on("dblclick", function () {

        // Impede abrir mais de um modal
        if ($(".expanded-card").length > 0) {
            return;
        }

        // Cria a div principal
        const expandedCard = $("<div>");

        // Adiciona a classe
        expandedCard.addClass("expanded-card");

        // Adiciona o conteúdo interno
        expandedCard.html(`
            <div class="container">

                <div class="x-bar">

                    <button class="close-btn">
                        X
                    </button>

                    <header>
                        Nome do Filme
                    </header>

                </div>

                <div class="content">

                    <div class="poster">

                        <img
                            src=""
                            alt="Poster do Filme"
                        >

                    </div>

                    <div class="details">

                        <p>
                            Detalhes completos do filme
                        </p>

                    </div>

                </div>

            </div>
        `);

        // Adiciona o modal ao body
        $("body").append(expandedCard);

        // Botão de fechar
        expandedCard.find(".close-btn").on("click", function () {

            expandedCard.remove();

        });

    });

});