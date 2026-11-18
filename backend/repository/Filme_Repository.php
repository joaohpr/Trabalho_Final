
<?php

    require_once __DIR__ . "/../model/Filme.php";

    class Filme_Repository
    {
        private $conexao;

        public function __construct($conexao)
        {
            $this->conexao = $conexao;
        }



        public function insertFilme($dados)
        {
            // Comando SQL para cadastrar um filme no banco de dados.
            $sql = "INSERT INTO Filme (titulo, sinopse, data_lancamento, nota, imagem, id_tmdb)
                VALUES (?, ?, ?, ?, ?, ?)";

            // Prepara o comando SQL.
            $stmt = mysqli_prepare($this->conexao, $sql);

            // Obtém os dados do objeto retornado pela TMDb.
            $titulo = $dados->title;
            $sinopse = $dados->overview;
            $dataLancamento = $dados->release_date;
            $nota = $dados->vote_average;
            $imagem = $dados->poster_path;
            $idTmdb = $dados->id;

            // Associa os valores aos parâmetros da consulta.
            // "sssdsi" indica: string, string, string, double, string e inteiro.
            mysqli_stmt_bind_param(
                $stmt,
                "sssdsi",
                $titulo,
                $sinopse,
                $dataLancamento,
                $nota,
                $imagem,
                $idTmdb
            );

            // Executa a inserção.
            mysqli_stmt_execute($stmt);

            // Verifica quantas linhas foram inseridas.
            $resultado = mysqli_stmt_affected_rows($stmt);

            // Fecha a declaração preparada.
            mysqli_stmt_close($stmt);

            // Retorna true se a inserção foi realizada.
            return $resultado > 0;
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
