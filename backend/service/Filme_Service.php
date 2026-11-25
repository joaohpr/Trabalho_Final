
<?php

require_once __DIR__ . "/../model/Filme.php";
require_once __DIR__ . "/../model/Genero.php";
require_once __DIR__ . "/../model/Genero_Filme.php";

require_once __DIR__ . "/../repository/Filme_Repository.php";
require_once __DIR__ . "/../repository/Genero_Repository.php";
require_once __DIR__ . "/../repository/Genero_Filme_Repository.php";

class Filme_Service
{
    private Filme_Repository $filme_repository;
    private Genero_Repository $genero_repository;
    private Genero_Filme_Repository $genero_filme_repository;

    public function __construct()
    {
        require __DIR__ . "/../config/Conexao.php";

        $this->filme_repository = new Filme_Repository($conexao);
        $this->genero_repository = new Genero_Repository($conexao);
        $this->genero_filme_repository = new Genero_Filme_Repository($conexao);
    }


    // Pesquisar filmes
    public function pesquisarFilmes($termo)
    {
        if ($termo === null || trim($termo) === "") {
            return false;
        }

        // Primeiro, pesquisa no banco local
        $filmesLocais = $this->filme_repository
            ->findFilmeLocalByTitulo($termo);

        if ($filmesLocais !== null) {

            $filmes = [];

            foreach ($filmesLocais as $dadosFilme) {
                $filmes[] = $this->montarFilmeLocal($dadosFilme);
            }

            return $filmes;
        }

        // Caso não encontre, consulta a TMDb
        $resposta = $this->filme_repository->findFilme($termo);

        if ($resposta === false || empty($resposta->results)) {
            return null;
        }

        $filmes = [];

        // Limita a pesquisa a 15 filmes
        $resultados = array_slice($resposta->results, 0, 15);

        foreach ($resultados as $dadosFilme) {

            // Verifica se o filme já está cadastrado
            $filmeLocal = $this->filme_repository
                ->findFilmeLocalByTmdbId($dadosFilme->id);

            if ($filmeLocal === null) {

                // Obtém a imagem de fundo ou o pôster como alternativa
                $caminhoImagem = $dadosFilme->backdrop_path
                    ?? $dadosFilme->poster_path
                    ?? null;

                if ($caminhoImagem !== null) {
                    $dadosFilme->poster_path =
                        "https://image.tmdb.org/t/p/w1280" . $caminhoImagem;
                }

                // Cadastra o filme no banco local
                $inserido = $this->filme_repository
                    ->insertFilme($dadosFilme);

                if (!$inserido) {
                    continue;
                }

                // Recupera o cadastro local
                $filmeLocal = $this->filme_repository
                    ->findFilmeLocalByTmdbId($dadosFilme->id);
            }

            if ($filmeLocal === null) {
                continue;
            }

            // Cria as associações dos gêneros
            $this->cadastrarGenerosDoFilme(
                $dadosFilme,
                $filmeLocal['idFilme']
            );

            // Converte os dados para objeto Filme
            $filmes[] = $this->montarFilmeLocal($filmeLocal);
        }

        return $filmes ?: null;
    }


    // Transformar registro do banco em objeto Filme
    private function montarFilmeLocal($dados)
    {
        $filme = new Filme(
            $dados['titulo'],
            $dados['id_tmdb'],
            $dados['nota'],
            $dados['sinopse'],
            $dados['data_lancamento'],
            $dados['imagem']
        );

        $filme->setIdFilme($dados['idFilme']);

        // Recupera os gêneros associados
        $generosEncontrados = $this->genero_filme_repository
            ->findGeneroByFilme($filme->getIdFilme());

        if ($generosEncontrados !== null) {

            foreach ($generosEncontrados as $dadosGenero) {

                $genero = new Genero(
                    $dadosGenero['idGenero'],
                    $dadosGenero['nome'],
                    $dadosGenero['descricao']
                );

                $filme->addGenero($genero);
            }
        }

        return $filme;
    }


    // Cadastrar e associar os gêneros do filme
    private function cadastrarGenerosDoFilme($dadosFilme, $idFilme)
    {
        if (empty($dadosFilme->genre_ids)) {
            return false;
        }

        // IDs e nomes oficiais dos gêneros da TMDb
        $generosTmdb = [
            28 => "Ação",
            12 => "Aventura",
            16 => "Animação",
            35 => "Comédia",
            80 => "Crime",
            99 => "Documentário",
            18 => "Drama",
            10751 => "Família",
            14 => "Fantasia",
            36 => "História",
            27 => "Terror",
            10402 => "Música",
            9648 => "Mistério",
            10749 => "Romance",
            878 => "Ficção científica",
            10770 => "Cinema TV",
            53 => "Suspense",
            10752 => "Guerra",
            37 => "Faroeste"
        ];

        // Considera somente os dois primeiros gêneros
        $idsGeneros = array_slice($dadosFilme->genre_ids, 0, 2);

        foreach ($idsGeneros as $idGeneroTmdb) {

            if (!isset($generosTmdb[$idGeneroTmdb])) {
                continue;
            }

            $nomeGenero = $generosTmdb[$idGeneroTmdb];

            // Cria o objeto Genero
            $genero = new Genero(null, $nomeGenero, null);

            // Procura o gênero no banco local
            $generosEncontrados = $this->genero_repository
                ->findByNome($genero);

            $generoLocal = null;

            if ($generosEncontrados !== null) {

                foreach ($generosEncontrados as $registro) {

                    if (
                        strcasecmp(
                            trim($registro['nome']),
                            trim($nomeGenero)
                        ) === 0
                    ) {
                        $generoLocal = $registro;
                        break;
                    }
                }
            }

            // Cadastra caso não exista
            if ($generoLocal === null) {

                $inserido = $this->genero_repository
                    ->insertGenero($genero);

                if (!$inserido) {
                    continue;
                }

                // Recupera o gênero cadastrado
                $generosEncontrados = $this->genero_repository
                    ->findByNome($genero);

                if ($generosEncontrados !== null) {

                    foreach ($generosEncontrados as $registro) {

                        if (
                            strcasecmp(
                                trim($registro['nome']),
                                trim($nomeGenero)
                            ) === 0
                        ) {
                            $generoLocal = $registro;
                            break;
                        }
                    }
                }
            }

            if ($generoLocal === null) {
                continue;
            }

            // Cria a associação entre Filme e Genero
            $generoFilme = new Genero_Filme(
                $generoLocal['idGenero'],
                $idFilme
            );

            // Verifica se a associação já existe
            $associacao = $this->genero_filme_repository
                ->findGeneroFilme($generoFilme);

            if ($associacao === null) {

                $this->genero_filme_repository
                    ->insertGeneroFilme($generoFilme);
            }
        }

        return true;
    }


    // Buscar detalhes de um filme pela TMDb
    public function findFilmeById(Filme $filme)
    {
        if ($filme->getIdTmdb() === null) {
            return false;
        }

        return $this->filme_repository
            ->findFilmeById($filme->getIdTmdb());
    }


    // Buscar filmes semelhantes
    public function findSimilarFilmes(Filme $filme)
    {
        if ($filme->getIdTmdb() === null) {
            return false;
        }

        return $this->filme_repository
            ->findSimilarFilmes($filme->getIdTmdb());
    }


    // Buscar filmes populares
    public function findPopularFilmes()
    {
        $resposta = $this->filme_repository->findPopularFilmes();

        if ($resposta === false || empty($resposta->results)) {
            return null;
        }

        return array_slice($resposta->results, 0, 15);
    }
}
