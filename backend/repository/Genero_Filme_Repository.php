<?php


require_once __DIR__ . "/../model/Genero.php";
require_once __DIR__ . "/../model/Filme.php";


class Genero_Filme_Repository
{

    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }


    public function insertGeneroFilme(Genero_Filme $genero_filme)
    {

        $sql = "INSERT INTO Genero_Filme (Genero_id,Filme_id)
                        VALUES (?,?)";

        $stmt = mysqli_prepare($this->conexao, $sql);

        $idGenero = $genero_filme->getIdGenero();
        $idFilme = $genero_filme->getIdFilme();

        mysqli_stmt_bind_param($stmt, "ii", $idGenero, $idFilme);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }

    public function findGeneroFilme(Genero_Filme $genero_filme)
    {

        $sql = "SELECT *
                FROM Genero_Filme
                WHERE Genero_id = ?
                AND Filme_id = ?; ";

        $stmt = mysqli_prepare($this->conexao, $sql);

        $idGenero = $genero_filme->getIdGenero();
        $idFilme = $genero_filme->getIdFilme();

        mysqli_stmt_bind_param($stmt, "ii", $idGenero, $idFilme);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado ?: null;
    }

    public function findGeneroByFilme($idFilme) {}

    public function findFilmeByGenero($idFilme) {}
}
