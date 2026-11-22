<?php

require_once __DIR__ . "/../model/Curtida_Avaliacao.php";


class Curtida_Avaliacao_Repository
{

    private $conexao;


    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }


    // Inserir curtida em uma avaliação
    public function insertCurtido(Curtida_Avaliacao $curtido)
    {

        $sql = "INSERT INTO Curtida_Avaliacao (data_curtida, Avaliacao_id, Usuario_id)
                VALUES (?, ?, ?);";

        $stmt = mysqli_prepare($this->conexao, $sql);

        $dataCurtida = $curtido->getDataCurtida();
        $idAvaliacao = $curtido->getAvaliacaoId();
        $idUsuario = $curtido->getUsuarioId()->getIdUsuario();

        mysqli_stmt_bind_param($stmt, "sii", $dataCurtida, $idAvaliacao, $idUsuario);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }


    // Buscar curtida por ID
    public function findCurtidoById($idCurtido)
    {

        $sql = "SELECT *
                FROM Curtida_Avaliacao
                WHERE id = ?;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idCurtido);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $curtido = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);

        return $curtido ?: null;
    }


    // Buscar curtidas por usuário
    public function findCurtidoByUsuario($idUsuario)
    {

        $sql = "SELECT *
                FROM Curtida_Avaliacao
                WHERE Usuario_id = ?
                ORDER BY data_curtida DESC;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idUsuario);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $curtidos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        mysqli_stmt_close($stmt);

        return $curtidos ?: null;
    }


    // Buscar curtidas por avaliação
    public function findCurtidoByAvaliacao($idAvaliacao)
    {

        $sql = "SELECT *
                FROM Curtida_Avaliacao
                WHERE Avaliacao_id = ?
                ORDER BY data_curtida DESC;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idAvaliacao);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $curtidos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        mysqli_stmt_close($stmt);

        return $curtidos ?: null;
    }


    // Buscar curtida específica de um usuário para uma avaliação
    public function findCurtidoByUsuarioAvaliacao($idUsuario, $idAvaliacao)
    {

        $sql = "SELECT *
                FROM Curtida_Avaliacao
                WHERE Usuario_id = ?
                AND Avaliacao_id = ?;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "ii", $idUsuario, $idAvaliacao);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $curtido = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);

        return $curtido ?: null;
    }


    // Excluir curtida por ID
    public function deleteCurtido($idCurtido)
    {

        $sql = "DELETE FROM Curtida_Avaliacao
                WHERE id = ?;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idCurtido);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }


    // Excluir curtida específica de um usuário em uma avaliação
    public function deleteCurtidoByUsuarioAvaliacao($idUsuario, $idAvaliacao)
    {

        $sql = "DELETE FROM Curtida_Avaliacao
                WHERE Usuario_id = ?
                AND Avaliacao_id = ?;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "ii", $idUsuario, $idAvaliacao);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }


    // Excluir todas as curtidas de determinado usuário
    public function deleteCurtidoByUsuario($idUsuario)
    {

        $sql = "DELETE FROM Curtida_Avaliacao
                WHERE Usuario_id = ?;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idUsuario);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }

}