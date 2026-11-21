<?php

require_once __DIR__ . "/../model/Avaliacao.php";
require_once __DIR__ . "/../model/Usuario.php";
require_once __DIR__ . "/../model/Filme.php";

class Avaliacao_Repository
{

    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }


    // Inserir avaliação
    public function insertAvaliacao(Avaliacao $avaliacao)
    {
        $sql = "INSERT INTO Avaliacao (comentario, data_criacao, nota, Usuario_id, Filme_id)
                VALUES (?, ?, ?, ?, ?);";

        $stmt = mysqli_prepare($this->conexao, $sql);

        $comentario = $avaliacao->getComentario();
        $dataCriacao = $avaliacao->getDataCriacao();
        $nota = $avaliacao->getNota();
        $idUsuario = $avaliacao->getUsuario()->getIdUsuario();
        $idFilme = $avaliacao->getFilme()->getIdFilme();

        mysqli_stmt_bind_param($stmt, "ssdii", $comentario, $dataCriacao, $nota, $idUsuario, $idFilme);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }


    // Buscar avaliação por ID
    public function findAvaliacaoById($idAvaliacao)
    {
        $sql = "SELECT *
                FROM Avaliacao
                WHERE id = ?;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idAvaliacao);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $avaliacao = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);

        return $avaliacao ?: null;
    }


    // Buscar avaliações por usuário
    public function findAvaliacaoByUsuario($idUsuario)
    {
        $sql = "SELECT *
                FROM Avaliacao
                WHERE Usuario_id = ?
                ORDER BY data_criacao DESC;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idUsuario);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $avaliacoes = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        mysqli_stmt_close($stmt);

        return $avaliacoes ?: null;
    }


    // Buscar avaliações por filme
    public function findAvaliacaoByFilme($idFilme)
    {
        $sql = "SELECT *
                FROM Avaliacao
                WHERE Filme_id = ?
                ORDER BY data_criacao DESC;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idFilme);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $avaliacoes = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        mysqli_stmt_close($stmt);

        return $avaliacoes ?: null;
    }


    // Buscar avaliação específica de um usuário para um filme
    public function findAvaliacaoByUsuarioFilme($idUsuario, $idFilme)
    {
        $sql = "SELECT *
                FROM Avaliacao
                WHERE Usuario_id = ?
                AND Filme_id = ?;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "ii", $idUsuario, $idFilme);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $avaliacao = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);

        return $avaliacao ?: null;
    }


    // Atualizar avaliação
    public function updateAvaliacao(Avaliacao $avaliacao)
    {
        $sql = "UPDATE Avaliacao
                SET comentario = ?,
                    data_criacao = ?,
                    nota = ?
                WHERE id = ?;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        $comentario = $avaliacao->getComentario();
        $dataCriacao = $avaliacao->getDataCriacao();
        $nota = $avaliacao->getNota();
        $idAvaliacao = $avaliacao->getId();

        mysqli_stmt_bind_param($stmt, "ssdi", $comentario, $dataCriacao, $nota, $idAvaliacao);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }


    // Excluir avaliação
    public function deleteAvaliacao($idAvaliacao)
    {
        $sql = "DELETE FROM Avaliacao
                WHERE id = ?;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idAvaliacao);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }

}