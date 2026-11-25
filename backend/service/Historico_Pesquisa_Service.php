<?php

require_once __DIR__ . "/../model/Historico_Pesquisa.php";
require_once __DIR__ . "/../model/Usuario.php";
require_once __DIR__ . "/../model/Filme.php";
require_once __DIR__ . "/../repository/Historico_Pesquisa_Repository.php";

class Historico_Pesquisa_Service
{
    private Historico_Pesquisa_Repository $historico_repository;

    public function __construct()
    {
        require __DIR__ . "/../config/Conexao.php";

        $this->historico_repository =
            new Historico_Pesquisa_Repository($conexao);
    }

    // Registrar uma pesquisa no histórico do usuário
    public function cadastrarHistorico(Historico_Pesquisa $historico)
    {
        if (!$this->validarHistorico($historico)) {
            return false;
        }

        return $this->historico_repository
            ->insertHistoricoPesquisa($historico);
    }

    // Buscar histórico de um usuário
    public function readHistoricoPorUsuario(Usuario $usuario)
    {
        $idUsuario = $usuario->getIdUsuario();

        if (!is_numeric($idUsuario) || $idUsuario <= 0) {
            return false;
        }

        return $this->historico_repository
            ->findHistoricoByUsuario((int) $idUsuario);
    }

    // Buscar histórico relacionado a um filme
    public function readHistoricoPorFilme(Filme $filme)
    {
        $idFilme = $filme->getIdFilme();

        if (!is_numeric($idFilme) || $idFilme <= 0) {
            return false;
        }

        return $this->historico_repository
            ->findHistoricoByFilme((int) $idFilme);
    }

    // Buscar registro do histórico pelo ID
    public function readHistoricoPorId($idHistorico)
    {
        if (!is_numeric($idHistorico) || $idHistorico <= 0) {
            return false;
        }

        return $this->historico_repository
            ->findHistoricoById((int) $idHistorico);
    }

    // Excluir um registro específico
    public function excluirHistorico($idHistorico)
    {
        if (!is_numeric($idHistorico) || $idHistorico <= 0) {
            return false;
        }

        return $this->historico_repository
            ->deleteHistoricoPesquisa((int) $idHistorico);
    }

    // Excluir todo o histórico de um usuário
    public function excluirHistoricoPorUsuario(Usuario $usuario)
    {
        $idUsuario = $usuario->getIdUsuario();

        if (!is_numeric($idUsuario) || $idUsuario <= 0) {
            return false;
        }

        return $this->historico_repository
            ->deleteHistoricoByUsuario((int) $idUsuario);
    }

    public function validarHistorico(Historico_Pesquisa $historico)
    {
        $usuario = $historico->getUsuario();
        $filme = $historico->getFilme();

        if (!($usuario instanceof Usuario) || !($filme instanceof Filme)) {
            return false;
        }

        $idUsuario = $usuario->getIdUsuario();
        $idFilme = $filme->getIdFilme();
        $termo = $historico->getTermo();
        $dataPesquisa = $historico->getDataPesquisa();

        return is_numeric($idUsuario)
            && $idUsuario > 0
            && is_numeric($idFilme)
            && $idFilme > 0
            && is_string($termo)
            && trim($termo) !== ""
            && strlen($termo) <= 100
            && is_string($dataPesquisa)
            && trim($dataPesquisa) !== "";
    }
}
