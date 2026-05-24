const cards = document.querySelectorAll(".cards");

cards.forEach((card) => {

    card.addEventListener("click", () => {

        if(document.querySelector(".expanded-card")){
            return;
        }

        const expandedCard = document.createElement("div");

        expandedCard.classList.add("expanded-card");

        expandedCard.innerHTML = `

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
                            src="https://via.placeholder.com/300x450"
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

        `;

        document.body.appendChild(expandedCard);

        const closeBtn = expandedCard.querySelector(".close-btn");

        closeBtn.addEventListener("click", () => {

            expandedCard.remove();

        });

    });

});