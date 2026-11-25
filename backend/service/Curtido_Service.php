<?php

require_once __DIR__ . "/../model/Curtido.php";
require_once __DIR__ . "/../model/Usuario.php";
require_once __DIR__ . "/../model/Filme.php";
require_once __DIR__ . "/../repository/Curtido_Repository.php";

class Curtido_Service
{
    private Curtido_Repository $curtido_repository;

    public function __construct()
    {
        require __DIR__ . "/../config/Conexao.php";

        $this->curtido_repository = new Curtido_Repository($conexao);
    }

    // Cadastrar filme nos curtidos do usuário
    public function cadastrarCurtido(Curtido $curtido)
    {
        if (!$this->validarCurtido($curtido)) {
            return false;
        }

        $idUsuario = $curtido->getUsuario()->getIdUsuario();
        $idFilme = $curtido->getFilme()->getIdFilme();

        // Impede curtidas duplicadas do mesmo usuário no mesmo filme
        $curtidoExistente = $this->curtido_repository
            ->findCurtidoByUsuarioFilme($idUsuario, $idFilme);

        if ($curtidoExistente !== null) {
            return false;
        }

        return $this->curtido_repository->insertCurtido($curtido);
    }

    // Buscar curtido pelo ID
    public function readCurtidoPorId($idCurtido)
    {
        if (!is_numeric($idCurtido) || $idCurtido <= 0) {
            return false;
        }

        return $this->curtido_repository
            ->findCurtidoById((int) $idCurtido);
    }

    // Buscar filmes curtidos por um usuário
    public function readCurtidosPorUsuario(Usuario $usuario)
    {
        $idUsuario = $usuario->getIdUsuario();

        if (!is_numeric($idUsuario) || $idUsuario <= 0) {
            return false;
        }

        return $this->curtido_repository
            ->findCurtidoByUsuario((int) $idUsuario);
    }

    // Buscar usuários que curtiram determinado filme
    public function readCurtidosPorFilme(Filme $filme)
    {
        $idFilme = $filme->getIdFilme();

        if (!is_numeric($idFilme) || $idFilme <= 0) {
            return false;
        }

        return $this->curtido_repository
            ->findCurtidoByFilme((int) $idFilme);
    }

    // Verificar se um usuário curtiu determinado filme
    public function readCurtidoPorUsuarioFilme(Usuario $usuario, Filme $filme)
    {
        $idUsuario = $usuario->getIdUsuario();
        $idFilme = $filme->getIdFilme();

        if (
            !is_numeric($idUsuario) || $idUsuario <= 0
            || !is_numeric($idFilme) || $idFilme <= 0
        ) {
            return false;
        }

        return $this->curtido_repository
            ->findCurtidoByUsuarioFilme((int) $idUsuario, (int) $idFilme);
    }

    // Remover curtido pelo ID
    public function excluirCurtido($idCurtido)
    {
        if (!is_numeric($idCurtido) || $idCurtido <= 0) {
            return false;
        }

        return $this->curtido_repository
            ->deleteCurtido((int) $idCurtido);
    }

    // Remover um filme dos curtidos de determinado usuário
    public function excluirCurtidoPorUsuarioFilme(Usuario $usuario, Filme $filme)
    {
        $idUsuario = $usuario->getIdUsuario();
        $idFilme = $filme->getIdFilme();

        if (
            !is_numeric($idUsuario) || $idUsuario <= 0
            || !is_numeric($idFilme) || $idFilme <= 0
        ) {
            return false;
        }

        return $this->curtido_repository
            ->deleteCurtidoByUsuarioFilme((int) $idUsuario, (int) $idFilme);
    }

    // Remover todos os filmes curtidos por um usuário
    public function excluirCurtidosPorUsuario(Usuario $usuario)
    {
        $idUsuario = $usuario->getIdUsuario();

        if (!is_numeric($idUsuario) || $idUsuario <= 0) {
            return false;
        }

        return $this->curtido_repository
            ->deleteCurtidoByUsuario((int) $idUsuario);
    }

    public function validarCurtido(Curtido $curtido)
    {
        $usuario = $curtido->getUsuario();
        $filme = $curtido->getFilme();
        $dataCurtida = $curtido->getDataCurtida();

        if (!($usuario instanceof Usuario) || !($filme instanceof Filme)) {
            return false;
        }

        $idUsuario = $usuario->getIdUsuario();
        $idFilme = $filme->getIdFilme();

        return is_numeric($idUsuario)
            && $idUsuario > 0
            && is_numeric($idFilme)
            && $idFilme > 0
            && is_string($dataCurtida)
            && trim($dataCurtida) !== "";
    }
}
