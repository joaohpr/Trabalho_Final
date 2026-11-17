
<?php

require_once __DIR__ . "/../model/Filme.php";

class Filme_Repository
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    // Consultar filmes pelo nome
    public function findFilme($nomeFilme)
    {
        $nomeFilme = urlencode($nomeFilme);

        $url = "https://api.themoviedb.org/3/search/movie";
        $url .= "?api_key=" . $_ENV['TMDB_API_KEY'];
        $url .= "&query=" . $nomeFilme;
        $url .= "&language=pt-BR";

        return $this->requestApi($url);
    }

    // Consultar detalhes de um filme pelo ID
    public function findFilmeById($idTmdb)
    {
        $url = "https://api.themoviedb.org/3/movie/" . $idTmdb;
        $url .= "?api_key=" . $_ENV['TMDB_API_KEY'];
        $url .= "&language=pt-BR";

        return $this->requestApi($url);
    }

    // Consultar filmes semelhantes
    public function findSimilarFilmes($idTmdb)
    {
        $url = "https://api.themoviedb.org/3/movie/" . $idTmdb . "/similar";
        $url .= "?api_key=" . $_ENV['TMDB_API_KEY'];
        $url .= "&language=pt-BR";

        return $this->requestApi($url);
    }

    // Consultar filmes populares
    public function findPopularFilmes()
    {
        $url = "https://api.themoviedb.org/3/movie/popular";
        $url .= "?api_key=" . $_ENV['TMDB_API_KEY'];
        $url .= "&language=pt-BR";

        return $this->requestApi($url);
    }

    // Realizar requisição à API
    private function requestApi($url)
    {
        try {

            $resposta = file_get_contents($url);

            if ($resposta === false) {
                return false;
            }

            $dados = json_decode($resposta);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return false;
            }

            return $dados;

        } catch (Throwable $erro) {

            return false;

        }
    }
}
