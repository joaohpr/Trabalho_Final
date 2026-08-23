/* =========================================================
   POSTER WALL
   Gera um mosaico de "capas de filme" fictícias em CSS puro
   (sem usar imagens de terceiros) e adiciona duas interações:
     1) Parallax sutil seguindo o mouse / giroscópio.
     2) Destaque cíclico aleatório em pôsteres, como se a
        parede de cinema estivesse "respirando".
   Requer jQuery 4.0.0 (já incluso no projeto).
   ========================================================= */

$(function () {

    const $wall = $("#posterWall");
    if ($wall.length === 0) return;

    /* ---------- 1. Banco de "filmes" fictícios ---------- */

    const genres = ["Ação", "Drama", "Ficção", "Suspense", "Comédia", "Terror", "Romance", "Aventura"];

    const titleParts = {
        a: ["Sombra", "Último", "Eterno", "Fragmento", "Horizonte", "Silêncio", "Fogo", "Espelho", "Instante", "Labirinto", "Vazio", "Fronteira"],
        b: ["Escarlate", "Distante", "Perdido", "Absoluto", "Interior", "Noturno", "Cinza", "Infinito", "Secreto", "Selvagem", "Quebrado", "Azul"]
    };

    function randomFrom(arr) {
        return arr[Math.floor(Math.random() * arr.length)];
    }

    function buildTitle() {
        return `${randomFrom(titleParts.a)} ${randomFrom(titleParts.b)}`;
    }

    // Paletas de gradiente (tons compatíveis com o tema do site)
    const palettes = [
        ["#16213e", "#0a0e27"],
        ["#0f3460", "#0a0e27"],
        ["#1e3a5f", "#132340"],
        ["#132340", "#060815"],
        ["#0d2847", "#0a0e27"],
        ["#173456", "#0a0e27"]
    ];

    /* ---------- 2. Geração do mosaico ---------- */

    const TILE_COUNT = 48;
    const $track = $('<div class="wallTrack" aria-hidden="true"></div>');

    for (let i = 0; i < TILE_COUNT; i++) {
        const [a, b] = randomFrom(palettes);
        const $tile = $('<div class="posterTile"></div>')
            .css({ "--tile-a": a, "--tile-b": b })
            .append(`<span class="posterGenre">${randomFrom(genres)}</span>`)
            .append(`<span class="posterLabel">${buildTitle()}</span>`);
        $track.append($tile);
    }

    const $overlay = $('<div class="wallOverlay"></div>');

    $wall.append($track).append($overlay);

    /* ---------- 3. Parallax pelo mouse (desktop) ---------- */

    let ticking = false;

    $(document).on("mousemove", function (e) {
        if (ticking) return;
        ticking = true;

        requestAnimationFrame(() => {
            const xPct = (e.clientX / window.innerWidth) * 100;
            const yPct = (e.clientY / window.innerHeight) * 100;

            $overlay.css({
                "--mx": xPct + "%",
                "--my": yPct + "%"
            });

            const offsetX = (xPct - 50) * 0.15;
            const offsetY = (yPct - 50) * 0.08;

            $track.css("transform", `rotate(-6deg) scale(1.15) translate(${offsetX}px, ${offsetY}px)`);

            ticking = false;
        });
    });

    /* ---------- 4. Destaque aleatório cíclico ("respiração" da parede) ---------- */

    const $tiles = $track.find(".posterTile");

    function pulseRandomTile() {
        $tiles.removeClass("is-focused");
        const $chosen = $tiles.eq(Math.floor(Math.random() * $tiles.length));
        $chosen.addClass("is-focused");
    }

    pulseRandomTile();
    setInterval(pulseRandomTile, 2600);

    /* ---------- 5. Clique/duplo toque em um pôster: pequeno "wow" ---------- */

    $tiles.on("click", function () {
        $(this).addClass("is-focused")
            .css("transition", "transform 0.15s ease")
            .css("transform", "scale(1.1)");

        setTimeout(() => {
            $(this).css("transform", "");
        }, 180);
    });

});
