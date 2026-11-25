<?php

require_once __DIR__ . "/../model/Genero.php";
require_once __DIR__ . "/../model/Filme.php";
require_once __DIR__ . "/../model/Genero_Filme.php";


class Genero_Filme_Repository
{

    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }


    // Inserir associação entre gênero e filme
    public function insertGeneroFilme(Genero_Filme $genero_filme)
    {

        $sql = "INSERT INTO Genero_Filme (Genero_id, Filme_id)
                VALUES (?, ?);";

        $stmt = mysqli_prepare($this->conexao, $sql);

        $idGenero = $genero_filme->getIdGenero();
        $idFilme = $genero_filme->getIdFilme();

        mysqli_stmt_bind_param($stmt, "ii", $idGenero, $idFilme);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }


    // Buscar associação específica entre gênero e filme
    public function findGeneroFilme(Genero_Filme $genero_filme)
    {

        $sql = "SELECT *
                FROM Genero_Filme
                WHERE Genero_id = ?
                AND Filme_id = ?;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        $idGenero = $genero_filme->getIdGenero();
        $idFilme = $genero_filme->getIdFilme();

        mysqli_stmt_bind_param($stmt, "ii", $idGenero, $idFilme);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $generoFilme = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);

        return $generoFilme ?: null;
    }


    // Buscar filmes associados a um gênero
    public function findFilmeByGenero($idGenero)
    {

        $sql = "SELECT Filme.*
                FROM Filme
                INNER JOIN Genero_Filme
                    ON Filme.id = Genero_Filme.Filme_id
                WHERE Genero_Filme.Genero_id = ?;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idGenero);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $filmes = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        mysqli_stmt_close($stmt);

        return $filmes ?: null;
    }


    // Buscar até dois gêneros associados a um filme
    public function findGeneroByFilme($idFilme)
    {
        $sql = "SELECT Genero.*
            FROM Genero
            INNER JOIN Genero_Filme
                ON Genero.id = Genero_Filme.Genero_id
            WHERE Genero_Filme.Filme_id = ?
            LIMIT 2";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idFilme);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $generos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        mysqli_stmt_close($stmt);

        return $generos ?: null;
    }
}
