/* =========================================================
   HOME CARDS
   Renderiza o catálogo de filmes (MOVIES, de moviesData.js),
   com busca por título, filtro por gênero, seção de
   recomendados, favoritos (em memória) e modal de detalhes.
   Requer jQuery 4.0.0, formUtils.js e moviesData.js.
   ========================================================= */

$(function () {

    const $cardsBar = $("#cards-bar");
    const $cardsRow = $("#cards-row");
    const $genreFilters = $("#genreFilters");
    const $searchInput = $("#searchInput");
    const $clearSearch = $("#clearSearch");
    const $emptyState = $("#emptyState");

    let activeGenre = "Todos";
    let searchTerm = "";
    const favorites = new Set();

    /* ---------- Recomendados: escolhidos uma vez ao carregar a página ---------- */

    const recommended = [...MOVIES]
        .sort((a, b) => b.rating - a.rating)
        .slice(0, 8);

    /* ---------- Helpers de renderização ---------- */

    function buildCard(movie, { compact = false } = {}) {
        const isFav = favorites.has(movie.id);

        const $card = $(`
            <div class="cards" tabindex="0" role="button" aria-label="Ver detalhes de ${movie.title}" data-id="${movie.id}">
                <div class="cardPosterWrap" style="--tile-a:${movie.tileA}; --tile-b:${movie.tileB};">
                    <span class="cardGenre">${movie.genre}</span>
                    <span class="cardRating"><i class="fa-solid fa-star"></i> ${movie.rating.toFixed(1)}</span>
                    <i class="fa-solid fa-film"></i>
                </div>
                <h1 class="title-cards">${movie.title}</h1>
                ${compact ? `<p class="description-cards">${movie.description}</p>` : `
                <div class="cardMeta">
                    <span>${movie.year}</span>
                    <button class="favoriteBtn ${isFav ? "active" : ""}" type="button" aria-label="Favoritar ${movie.title}" data-id="${movie.id}">
                        <i class="fa-solid fa-heart"></i>
                    </button>
                </div>`}
            </div>
        `);

        return $card;
    }

    function renderGenreChips() {
        $genreFilters.empty();

        GENRES.forEach((genre) => {
            const $chip = $(`<button type="button" class="genreChip ${genre === activeGenre ? "active" : ""}">${genre}</button>`);
            $chip.on("click", () => {
                activeGenre = genre;
                $(".genreChip").removeClass("active");
                $chip.addClass("active");
                renderMainGrid();
            });
            $genreFilters.append($chip);
        });
    }

    function getFilteredMovies() {
        return MOVIES.filter((movie) => {
            const matchesGenre = activeGenre === "Todos" || movie.genre === activeGenre;
            const matchesSearch = movie.title.toLowerCase().includes(searchTerm.toLowerCase());
            return matchesGenre && matchesSearch;
        });
    }

    function renderMainGrid() {
        const filtered = getFilteredMovies();

        $cardsBar.empty();

        if (filtered.length === 0) {
            $emptyState.addClass("visible");
        } else {
            $emptyState.removeClass("visible");
            filtered.forEach((movie, i) => {
                const $card = buildCard(movie);
                $card.css("animation-delay", `${Math.min(i, 10) * 40}ms`);
                $cardsBar.append($card);
            });
        }
    }

    function renderRecommendedRow() {
        $cardsRow.empty();
        recommended.forEach((movie) => {
            $cardsRow.append(buildCard(movie, { compact: true }));
        });
    }

    /* ---------- Busca ---------- */

    function applySearch() {
        searchTerm = $searchInput.val().trim();
        $clearSearch.toggleClass("visible", searchTerm.length > 0);
        renderMainGrid();
    }

    let searchDebounce = null;
    $searchInput.on("input", function () {
        clearTimeout(searchDebounce);
        searchDebounce = setTimeout(applySearch, 200);
    });

    $searchInput.on("keydown", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            clearTimeout(searchDebounce);
            applySearch();
        }
    });

    $("#searchButton").on("click", applySearch);

    $clearSearch.on("click", function () {
        $searchInput.val("").trigger("focus");
        applySearch();
    });

    $("#resetFiltersBtn").on("click", function () {
        activeGenre = "Todos";
        searchTerm = "";
        $searchInput.val("");
        $clearSearch.removeClass("visible");
        renderGenreChips();
        renderMainGrid();
    });

    /* ---------- Favoritos ---------- */

    function toggleFavorite(id) {
        const movie = MOVIES.find((m) => m.id === id);
        if (!movie) return;

        if (favorites.has(id)) {
            favorites.delete(id);
            CineSearchForms.showToast(`Removido dos favoritos: ${movie.title}`, "success", 1800);
        } else {
            favorites.add(id);
            CineSearchForms.showToast(`Adicionado aos favoritos: ${movie.title}`, "success", 1800);
        }
    }

    // Delegação de evento: funciona mesmo para cards recriados dinamicamente
    $(document).on("click", ".favoriteBtn", function (e) {
        e.stopPropagation();
        const id = Number($(this).data("id"));
        toggleFavorite(id);
        $(this).toggleClass("active");
    });

    $("#favoritesNavBtn").on("click", function () {
        if (favorites.size === 0) {
            CineSearchForms.showToast("Você ainda não favoritou nenhum filme.", "error");
            return;
        }
        activeGenre = "Todos";
        searchTerm = "";
        $searchInput.val("");
        $cardsBar.empty();
        $emptyState.removeClass("visible");

        MOVIES.filter((m) => favorites.has(m.id)).forEach((movie) => {
            $cardsBar.append(buildCard(movie));
        });

        $("html, body, #Container-main").animate({ scrollTop: 0 }, 300);
        CineSearchForms.showToast(`Mostrando ${favorites.size} filme(s) favorito(s).`, "success", 1800);
    });

    $(".button-sideBar[data-tooltip='Início']").on("click", function () {
        renderMainGrid();
    });

    /* ---------- Modal de detalhes ---------- */

    function openModal(movie) {
        if ($(".expanded-card").length) return;

        const isFav = favorites.has(movie.id);

        const $expandedCard = $(`
            <div class="expanded-card" role="dialog" aria-modal="true" aria-label="Detalhes de ${movie.title}">
                <div class="container">
                    <div class="x-bar">
                        <button class="close-btn" aria-label="Fechar">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <header>${movie.title}</header>
                    </div>

                    <div class="content">
                        <div class="poster" style="--tile-a:${movie.tileA}; --tile-b:${movie.tileB};">
                            <i class="fa-solid fa-film"></i>
                        </div>

                        <div class="details">
                            <div class="detailsMeta">
                                <span><i class="fa-solid fa-star" style="color:#ffd700;"></i> ${movie.rating.toFixed(1)}</span>
                                <span>${movie.genre}</span>
                                <span>${movie.year}</span>
                            </div>

                            <p class="desc">${movie.description}</p>

                            <div class="detailsActions">
                                <button class="btnPrimaryAction" type="button">
                                    <i class="fa-solid fa-play"></i> Assistir trailer
                                </button>
                                <button class="btnSecondaryAction ${isFav ? "active" : ""}" id="modalFavBtn" type="button">
                                    <i class="fa-solid fa-heart"></i> ${isFav ? "Favoritado" : "Favoritar"}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);

        $("body").append($expandedCard).css("overflow", "hidden");

        $expandedCard.find(".close-btn").on("click", () => closeModal($expandedCard));
        $expandedCard.on("click", function (e) {
            if (e.target === this) closeModal($expandedCard);
        });

        $expandedCard.find(".btnPrimaryAction").on("click", () => {
            CineSearchForms.showToast("Trailer indisponível nesta demonstração.", "success", 2000);
        });

        $expandedCard.find("#modalFavBtn").on("click", function () {
            toggleFavorite(movie.id);
            const nowFav = favorites.has(movie.id);
            $(this).toggleClass("active", nowFav).html(`<i class="fa-solid fa-heart"></i> ${nowFav ? "Favoritado" : "Favoritar"}`);
            $(`.favoriteBtn[data-id="${movie.id}"]`).toggleClass("active", nowFav);
        });

        $(document).on("keydown.modal", function (e) {
            if (e.key === "Escape") closeModal($expandedCard);
        });
    }

    function closeModal($expandedCard) {
        $expandedCard.remove();
        $("body").css("overflow", "");
        $(document).off("keydown.modal");
    }

    // Delegação: abre modal ao clicar/Enter em qualquer card (grid principal ou recomendados)
    $(document).on("click", ".cards", function (e) {
        if ($(e.target).closest(".favoriteBtn").length) return;
        const id = Number($(this).data("id"));
        const movie = MOVIES.find((m) => m.id === id);
        if (movie) openModal(movie);
    });

    $(document).on("keydown", ".cards", function (e) {
        if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            $(this).trigger("click");
        }
    });

    // Duplo clique preservado como atalho (comportamento original do projeto)
    $(document).on("dblclick", ".cards", function () {
        $(this).trigger("click");
    });

    /* ---------- Inicialização ---------- */

    renderGenreChips();
    renderMainGrid();
    renderRecommendedRow();

});
