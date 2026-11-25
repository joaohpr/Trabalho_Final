<?php

require_once __DIR__ . "/../model/Curtida_Avaliacao.php";
require_once __DIR__ . "/../model/Usuario.php";
require_once __DIR__ . "/../repository/Curtida_Avaliacao_Repository.php";

class Curtida_Avaliacao_Service
{
    private Curtida_Avaliacao_Repository $curtida_avaliacao_repository;

    public function __construct()
    {
        require __DIR__ . "/../config/Conexao.php";

        $this->curtida_avaliacao_repository =
            new Curtida_Avaliacao_Repository($conexao);
    }

    // Cadastrar curtida em uma avaliação
    public function cadastrarCurtida(Curtida_Avaliacao $curtida)
    {
        if (!$this->validarCurtida($curtida)) {
            return false;
        }

        $idUsuario = $curtida->getUsuarioId()->getIdUsuario();
        $idAvaliacao = $curtida->getAvaliacaoId();

        // Impede que o mesmo usuário curta a mesma avaliação mais de uma vez
        $curtidaExistente = $this->curtida_avaliacao_repository
            ->findCurtidoByUsuarioAvaliacao($idUsuario, $idAvaliacao);

        if ($curtidaExistente !== null) {
            return false;
        }

        return $this->curtida_avaliacao_repository
            ->insertCurtido($curtida);
    }

    // Buscar curtida pelo ID
    public function readCurtidaPorId($idCurtida)
    {
        if (!is_numeric($idCurtida) || $idCurtida <= 0) {
            return false;
        }

        return $this->curtida_avaliacao_repository
            ->findCurtidoById((int) $idCurtida);
    }

    // Buscar curtidas feitas por um usuário
    public function readCurtidasPorUsuario(Usuario $usuario)
    {
        $idUsuario = $usuario->getIdUsuario();

        if (!is_numeric($idUsuario) || $idUsuario <= 0) {
            return false;
        }

        return $this->curtida_avaliacao_repository
            ->findCurtidoByUsuario((int) $idUsuario);
    }

    // Buscar curtidas recebidas por uma avaliação
    public function readCurtidasPorAvaliacao($idAvaliacao)
    {
        if (!is_numeric($idAvaliacao) || $idAvaliacao <= 0) {
            return false;
        }

        return $this->curtida_avaliacao_repository
            ->findCurtidoByAvaliacao((int) $idAvaliacao);
    }

    // Verificar se um usuário curtiu uma avaliação
    public function readCurtidaPorUsuarioAvaliacao(Usuario $usuario, $idAvaliacao)
    {
        $idUsuario = $usuario->getIdUsuario();

        if (
            !is_numeric($idUsuario) || $idUsuario <= 0
            || !is_numeric($idAvaliacao) || $idAvaliacao <= 0
        ) {
            return false;
        }

        return $this->curtida_avaliacao_repository
            ->findCurtidoByUsuarioAvaliacao(
                (int) $idUsuario,
                (int) $idAvaliacao
            );
    }

    // Excluir curtida pelo ID
    public function excluirCurtida($idCurtida)
    {
        if (!is_numeric($idCurtida) || $idCurtida <= 0) {
            return false;
        }

        return $this->curtida_avaliacao_repository
            ->deleteCurtido((int) $idCurtida);
    }

    // Excluir curtida específica de um usuário em uma avaliação
    public function excluirCurtidaPorUsuarioAvaliacao(Usuario $usuario, $idAvaliacao)
    {
        $idUsuario = $usuario->getIdUsuario();

        if (
            !is_numeric($idUsuario) || $idUsuario <= 0
            || !is_numeric($idAvaliacao) || $idAvaliacao <= 0
        ) {
            return false;
        }

        return $this->curtida_avaliacao_repository
            ->deleteCurtidoByUsuarioAvaliacao(
                (int) $idUsuario,
                (int) $idAvaliacao
            );
    }

    // Excluir todas as curtidas em avaliações de um usuário
    public function excluirCurtidasPorUsuario(Usuario $usuario)
    {
        $idUsuario = $usuario->getIdUsuario();

        if (!is_numeric($idUsuario) || $idUsuario <= 0) {
            return false;
        }

        return $this->curtida_avaliacao_repository
            ->deleteCurtidoByUsuario((int) $idUsuario);
    }

    public function validarCurtida(Curtida_Avaliacao $curtida)
    {
        $usuario = $curtida->getUsuarioId();

        if (!($usuario instanceof Usuario)) {
            return false;
        }

        $idUsuario = $usuario->getIdUsuario();
        $idAvaliacao = $curtida->getAvaliacaoId();
        $dataCurtida = $curtida->getDataCurtida();

        return is_numeric($idUsuario)
            && $idUsuario > 0
            && is_numeric($idAvaliacao)
            && $idAvaliacao > 0
            && is_string($dataCurtida)
            && trim($dataCurtida) !== "";
    }
}
