
<?php

require_once __DIR__ . "/../model/Historico_Pesquisa.php";
require_once __DIR__ . "/../model/Filme.php";
require_once __DIR__ . "/../model/Usuario.php";

class Historico_Pesquisa_Repository
{

    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }


    // Inserir registro no histórico de pesquisa
    public function insertHistoricoPesquisa(Historico_Pesquisa $historico)
    {

        $sql = "INSERT INTO Historico_Pesquisa (termo, data_pesquisa, Filme_id, Usuario_id)
                VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->conexao, $sql);

        $termo = $historico->getTermo();
        $dataPesquisa = $historico->getDataPesquisa();
        $idFilme = $historico->getFilme()->getIdFilme();
        $idUsuario = $historico->getUsuario()->getIdUsuario();

        mysqli_stmt_bind_param($stmt, "ssii", $termo, $dataPesquisa, $idFilme, $idUsuario);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }


    // Buscar histórico de pesquisa por usuário
    public function findHistoricoByUsuario($idUsuario)
    {

        $sql = "SELECT * FROM Historico_Pesquisa
                WHERE Usuario_id = ?";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idUsuario);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $historicos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        mysqli_stmt_close($stmt);

        return $historicos ?: null;
    }


    // Buscar histórico de pesquisa por filme
    public function findHistoricoByFilme($idFilme)
    {

        $sql = "SELECT * FROM Historico_Pesquisa
                WHERE Filme_id = ?";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idFilme);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $historicos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        mysqli_stmt_close($stmt);

        return $historicos ?: null;
    }


    // Buscar registro específico do histórico
    public function findHistoricoById($idHistoricoPesquisa)
    {

        $sql = "SELECT * FROM Historico_Pesquisa
                WHERE id = ?";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idHistoricoPesquisa);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $historico = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);

        return $historico ?: null;
    }


    // Excluir registro específico do histórico
    public function deleteHistoricoPesquisa($idHistoricoPesquisa)
    {

        $sql = "DELETE FROM Historico_Pesquisa
                WHERE id = ?";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idHistoricoPesquisa);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }


    // Excluir todo o histórico de determinado usuário
    public function deleteHistoricoByUsuario($idUsuario)
    {

        $sql = "DELETE FROM Historico_Pesquisa
                WHERE Usuario_id = ?";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idUsuario);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }

}
