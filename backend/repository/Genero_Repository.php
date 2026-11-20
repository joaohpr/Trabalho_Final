<?php

require_once __DIR__ . "/../model/Genero.php";

class Genero_Repository
{

    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }


    // Inserir gênero
    public function insertGenero(Genero $genero)
    {

        $sql = "INSERT INTO Genero(nome, descricao)
                VALUES (?, ?)";

        $stmt = mysqli_prepare($this->conexao, $sql);

        $nome = $genero->getNome();
        $descricao = $genero->getDescricao();

        mysqli_stmt_bind_param($stmt, "ss", $nome, $descricao);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }


    // Buscar gênero pelo nome
    public function findByNome(Genero $genero)
    {

        $sql = "SELECT *
                FROM Genero
                WHERE nome LIKE ?";

        $stmt = mysqli_prepare($this->conexao, $sql);

        $nomeGenero = "%" . $genero->getNome() . "%";

        mysqli_stmt_bind_param($stmt, "s", $nomeGenero);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $generos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        mysqli_stmt_close($stmt);

        return $generos ?: null;
    }


    // Buscar gênero pela descrição
    public function findByDescricao(Genero $genero)
    {

        $sql = "SELECT *
                FROM Genero
                WHERE descricao LIKE ?";

        $stmt = mysqli_prepare($this->conexao, $sql);

        $descricao = "%" . $genero->getDescricao() . "%";

        mysqli_stmt_bind_param($stmt, "s", $descricao);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $generos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        mysqli_stmt_close($stmt);

        return $generos ?: null;
    }


    // Buscar todos os gêneros
    public function findAllGenero()
    {

        $sql = "SELECT *
                FROM Genero
                LIMIT 15";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $generos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        mysqli_stmt_close($stmt);

        return $generos ?: null;
    }

}