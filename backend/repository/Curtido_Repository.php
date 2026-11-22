<?php

require_once __DIR__ . "/../model/Curtido.php";
require_once __DIR__ . "/../model/Filme.php";
require_once __DIR__ . "/../model/Usuario.php";


class Curtido_Repository
{

    private $conexao;


    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }


    // Inserir curtida
    public function insertCurtido(Curtido $curtido)
    {

        $sql = "INSERT INTO Curtido (data_curtida, Filme_id, Usuario_id)
                VALUES (?, ?, ?);";

        $stmt = mysqli_prepare($this->conexao, $sql);

        $dataCurtida = $curtido->getDataCurtida();
        $idFilme = $curtido->getFilme()->getIdFilme();
        $idUsuario = $curtido->getUsuario()->getIdUsuario();

        mysqli_stmt_bind_param($stmt, "sii", $dataCurtida, $idFilme, $idUsuario);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }


    // Buscar curtida por ID
    public function findCurtidoById($idCurtido)
    {

        $sql = "SELECT *
                FROM Curtido
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
                FROM Curtido
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


    // Buscar curtidas por filme
    public function findCurtidoByFilme($idFilme)
    {

        $sql = "SELECT *
                FROM Curtido
                WHERE Filme_id = ?
                ORDER BY data_curtida DESC;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idFilme);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $curtidos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        mysqli_stmt_close($stmt);

        return $curtidos ?: null;
    }


    // Buscar curtida específica de um usuário para um filme
    public function findCurtidoByUsuarioFilme($idUsuario, $idFilme)
    {

        $sql = "SELECT *
                FROM Curtido
                WHERE Usuario_id = ?
                AND Filme_id = ?;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "ii", $idUsuario, $idFilme);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $curtido = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);

        return $curtido ?: null;
    }


    // Excluir curtida
    public function deleteCurtido($idCurtido)
    {

        $sql = "DELETE FROM Curtido
                WHERE id = ?;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idCurtido);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }


    // Excluir curtida específica de um usuário para um filme
    public function deleteCurtidoByUsuarioFilme($idUsuario, $idFilme)
    {

        $sql = "DELETE FROM Curtido
                WHERE Usuario_id = ?
                AND Filme_id = ?;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "ii", $idUsuario, $idFilme);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }


    // Excluir todas as curtidas de determinado usuário
    public function deleteCurtidoByUsuario($idUsuario)
    {

        $sql = "DELETE FROM Curtido
                WHERE Usuario_id = ?;";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idUsuario);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }

}