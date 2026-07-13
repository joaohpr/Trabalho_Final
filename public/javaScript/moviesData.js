/* =========================================================
   MOVIES DATA
   Catálogo de exemplo (mock) usado para popular a Home.
   Em uma versão futura, isso pode ser substituído por uma
   chamada de API real (fetch) para um backend de filmes.
   As "capas" são geradas em CSS puro, via par de cores
   (tileA/tileB) + ícone, para evitar depender de imagens
   de terceiros protegidas por direitos autorais.
   ========================================================= */

const MOVIES = [
    { id: 1,  title: "Sombra Escarlate",     genre: "Ação",      year: 2024, rating: 8.4, tileA: "#3a1e1e", tileB: "#0a0e27", description: "Um agente encoberto precisa desmontar uma rede de espionagem antes que ela ameace a paz entre duas nações rivais." },
    { id: 2,  title: "Último Horizonte",     genre: "Ficção",    year: 2023, rating: 7.9, tileA: "#16213e", tileB: "#0a0e27", description: "Uma tripulação espacial descobre um sinal vindo de além do sistema solar e precisa decidir se deve respondê-lo." },
    { id: 3,  title: "Eterno Silêncio",      genre: "Drama",     year: 2022, rating: 8.7, tileA: "#1e3a5f", tileB: "#132340", description: "Duas irmãs reencontram-se após décadas para lidar com um segredo de família que mudou o rumo de suas vidas." },
    { id: 4,  title: "Fragmento Distante",   genre: "Suspense",  year: 2025, rating: 7.5, tileA: "#132340", tileB: "#060815", description: "Uma investigadora reconstrói os últimos dias de uma vítima a partir de fragmentos de memória digital." },
    { id: 5,  title: "Instante Perdido",     genre: "Romance",   year: 2021, rating: 7.2, tileA: "#3a1e33", tileB: "#0a0e27", description: "Dois estranhos se cruzam repetidamente ao longo de dez anos, sempre no momento errado." },
    { id: 6,  title: "Labirinto Absoluto",   genre: "Terror",    year: 2024, rating: 6.9, tileA: "#241428", tileB: "#0a0e27", description: "Um grupo de amigos fica preso em uma mansão que muda de forma toda vez que alguém tenta encontrar a saída." },
    { id: 7,  title: "Vazio Interior",       genre: "Drama",     year: 2023, rating: 8.1, tileA: "#0d2847", tileB: "#0a0e27", description: "Um músico em declínio tenta reconstruir a relação com o filho enquanto enfrenta os próprios fracassos." },
    { id: 8,  title: "Fronteira Noturna",    genre: "Aventura",  year: 2022, rating: 7.8, tileA: "#173456", tileB: "#0a0e27", description: "Uma cartógrafa embarca em uma expedição para mapear um território que ninguém conseguiu atravessar." },
    { id: 9,  title: "Espelho Cinza",        genre: "Suspense",  year: 2025, rating: 8.0, tileA: "#1e3a5f", tileB: "#060815", description: "Um escritor começa a viver os mesmos eventos que descreve em seu novo romance, um dia antes de escrevê-los." },
    { id: 10, title: "Fogo Infinito",        genre: "Ação",      year: 2024, rating: 7.6, tileA: "#3a2414", tileB: "#0a0e27", description: "Um esquadrão de resgate corre contra o tempo para evacuar uma cidade cercada por incêndios coordenados." },
    { id: 11, title: "Silêncio Secreto",     genre: "Comédia",   year: 2023, rating: 7.0, tileA: "#0f3460", tileB: "#132340", description: "Um funcionário público desastrado precisa fingir ser um espião por 24 horas para não perder o emprego." },
    { id: 12, title: "Horizonte Selvagem",   genre: "Aventura",  year: 2021, rating: 8.3, tileA: "#16213e", tileB: "#060815", description: "Três amigos de infância reencontram-se para uma última expedição ao lugar onde tudo começou." },
    { id: 13, title: "Último Quebrado",      genre: "Drama",     year: 2025, rating: 8.9, tileA: "#132340", tileB: "#0a0e27", description: "Um ex-atleta tenta retomar a carreira depois de um acidente que mudou completamente sua vida." },
    { id: 14, title: "Fragmento Azul",       genre: "Ficção",    year: 2022, rating: 7.4, tileA: "#0d2847", tileB: "#132340", description: "Uma cientista descobre uma falha na realidade que permite observar versões alternativas do próprio passado." },
];

const GENRES = ["Todos", "Ação", "Drama", "Ficção", "Suspense", "Comédia", "Terror", "Romance", "Aventura"];
