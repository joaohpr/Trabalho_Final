
<?php

require_once __DIR__ . "/../model/Avaliacao.php";
require_once __DIR__ . "/../model/Usuario.php";
require_once __DIR__ . "/../model/Filme.php";
require_once __DIR__ . "/../repository/Avaliacao_Repository.php";

class Avaliacao_Service
{
    private Avaliacao_Repository $avaliacao_repository;

    public function __construct()
    {
        require_once __DIR__ . "/../config/database.php";

        $this->avaliacao_repository = new Avaliacao_Repository($conexao);
    }

    // Cadastrar avaliação
    public function cadastrarAvaliacao(Avaliacao $avaliacao)
    {
        if (!$this->validarAvaliacao($avaliacao)) {
            return false;
        }

        return $this->avaliacao_repository->insertAvaliacao($avaliacao);
    }

    // Buscar avaliação por ID
    public function findAvaliacaoById(Avaliacao $avaliacao)
    {
        $idAvaliacao = $avaliacao->getId();

        if ($idAvaliacao === null || $idAvaliacao <= 0) {
            return false;
        }

        return $this->avaliacao_repository->findAvaliacaoById($idAvaliacao);
    }

    // Buscar avaliações de um usuário
    public function findAvaliacaoByUsuario(Usuario $usuario)
    {
        $idUsuario = $usuario->getIdUsuario();

        if ($idUsuario === null || $idUsuario <= 0) {
            return false;
        }

        return $this->avaliacao_repository->findAvaliacaoByUsuario($idUsuario);
    }

    // Buscar avaliações de um filme
    public function findAvaliacaoByFilme(Filme $filme)
    {
        $idFilme = $filme->getIdFilme();

        if ($idFilme === null || $idFilme <= 0) {
            return false;
        }

        return $this->avaliacao_repository->findAvaliacaoByFilme($idFilme);
    }

    // Buscar avaliação de um usuário para um filme
    public function findAvaliacaoByUsuarioFilme(
        Usuario $usuario,
        Filme $filme
    ) {
        $idUsuario = $usuario->getIdUsuario();
        $idFilme = $filme->getIdFilme();

        if ($idUsuario === null || $idUsuario <= 0) {
            return false;
        }

        if ($idFilme === null || $idFilme <= 0) {
            return false;
        }

        return $this->avaliacao_repository
            ->findAvaliacaoByUsuarioFilme($idUsuario, $idFilme);
    }

    // Atualizar avaliação
    public function updateAvaliacao(Avaliacao $avaliacao)
    {
        if ($avaliacao->getId() === null || $avaliacao->getId() <= 0) {
            return false;
        }

        if (!$this->validarAvaliacao($avaliacao)) {
            return false;
        }

        return $this->avaliacao_repository->updateAvaliacao($avaliacao);
    }

    // Excluir avaliação
    public function deleteAvaliacao(Avaliacao $avaliacao)
    {
        $idAvaliacao = $avaliacao->getId();

        if ($idAvaliacao === null || $idAvaliacao <= 0) {
            return false;
        }

        return $this->avaliacao_repository->deleteAvaliacao($idAvaliacao);
    }

    // Validar dados da avaliação
    public function validarAvaliacao(Avaliacao $avaliacao)
    {
        $usuario = $avaliacao->getUsuario();
        $filme = $avaliacao->getFilme();

        //instanceof ,operador que achei na documenatacao do php,
        //verifica se a variavel e uma instancia de tal classe,se vc for ajudar nessa parte do service usa esse operador 
        
        if (!$usuario instanceof Usuario || !$filme instanceof Filme) {
            return false;
        }

        if ($usuario->getIdUsuario() === null || $usuario->getIdUsuario() <= 0) {
            return false;
        }

        if ($filme->getIdFilme() === null || $filme->getIdFilme() <= 0) {
            return false;
        }

        $nota = $avaliacao->getNota();

        if (!is_numeric($nota) || $nota < 0 || $nota > 10) {
            return false;
        }

        $comentario = $avaliacao->getComentario();

        if ($comentario !== null && !is_string($comentario)) {
            return false;
        }

        return true;
    }
}
