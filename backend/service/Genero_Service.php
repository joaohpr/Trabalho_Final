<?php

require_once __DIR__ . "/../repository/Genero_Repository.php";
require_once __DIR__ . "/../model/Genero.php";

class Genero_Service
{
    private Genero_Repository $genero_repository;

    public function __construct()
    {
        require __DIR__ . "/../config/Conexao.php";

        $this->genero_repository = new Genero_Repository($conexao);
    }

    // Cadastrar gênero
    public function cadastrarGenero(Genero $genero)
    {
        if (!$this->validarGenero($genero)) {
            return false;
        }

        // Verifica se o gênero já existe
        $generosEncontrados = $this->readGeneroPorNome($genero);

        if ($generosEncontrados !== null) {

            foreach ($generosEncontrados as $generoEncontrado) {

                if (
                    strcasecmp(
                        trim($generoEncontrado['nome']),
                        trim($genero->getNome())
                    ) === 0
                ) {
                    return false;
                }
            }
        }

        return $this->genero_repository->insertGenero($genero);
    }

    // Buscar gênero pelo nome
    public function readGeneroPorNome(Genero $genero)
    {
        if (
            $genero->getNome() === null ||
            trim($genero->getNome()) === ""
        ) {
            return false;
        }

        return $this->genero_repository->findByNome($genero);
    }

    // Buscar gênero pela descrição
    public function readGeneroPorDescricao(Genero $genero)
    {
        if (
            $genero->getDescricao() === null ||
            trim($genero->getDescricao()) === ""
        ) {
            return false;
        }

        return $this->genero_repository->findByDescricao($genero);
    }

    // Buscar todos os gêneros
    public function readAllGeneros()
    {
        return $this->genero_repository->findAllGenero();
    }

    // Validar gênero
    public function validarGenero(Genero $genero)
    {
        // Validar nome
        if (
            $genero->getNome() === null ||
            trim($genero->getNome()) === ""
        ) {
            return false;
        }

        // Validar tamanho do nome
        if (strlen($genero->getNome()) > 100) {
            return false;
        }

        return true;
    }
}