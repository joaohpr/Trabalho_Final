<?php

require_once __DIR__ . "/../repository/Usuario_Repository.php";
require_once __DIR__ . "/../model/Usuario.php";

class Usuario_Service
{
    private Usuario_Repository $usuario_repository;

    public function __construct()
    {
        require __DIR__ . "/../config/database.php";

        $this->usuario_repository = new Usuario_Repository($conexao);
    }

    public function cadastrarUsuario(Usuario $usuario, $confirmacaoSenha)
    {
        if (!$this->validarCadastro($usuario, $confirmacaoSenha)) {
            return false;
        }

        // Criptografa a senha antes de armazená-la
        $senhaHash = password_hash(
            $usuario->getSenha(),
            PASSWORD_DEFAULT
        );

        $usuario->setSenha($senhaHash);

        return $this->usuario_repository->insertUsuario($usuario);
    }

    public function loginUsuario(Usuario $usuario)
    {
        if (!$this->validarLogin($usuario)) {
            return false;
        }

        // Busca o usuário pelo nome
        $usuarioEncontrado = $this->usuario_repository
            ->findUsuarioByNome($usuario->getNome());

        if ($usuarioEncontrado === null) {
            return false;
        }

        // Verifica a senha
        if (!password_verify(
            $usuario->getSenha(),
            $usuarioEncontrado['senha']
        )) {
            return false;
        }

        return $usuarioEncontrado;
    }

    public function deleteUsuario(Usuario $usuario)
    {
        if ($usuario->getIdUsuario() === null) {
            return false;
        }

        return $this->usuario_repository
            ->deleteUsuario($usuario->getIdUsuario());
    }

    public function readUsuario(Usuario $usuario)
    {
        if (
            $usuario->getNome() === null ||
            trim($usuario->getNome()) === ""
        ) {
            return false;
        }

        return $this->usuario_repository
            ->findUsuarioByNome($usuario->getNome());
    }

    public function readUsuarioPorEmail($email)
    {
        if (!$this->validarEmail($email)) {
            return false;
        }

        return $this->usuario_repository
            ->findUsuarioByEmail($email);
    }

    public function atualizarUsuario(Usuario $usuario)
    {
        if (!$this->validarUsuario($usuario)) {
            return false;
        }

        // Verifica se o email pertence a outro usuário
        $usuarioEncontrado = $this->readUsuarioPorEmail(
            $usuario->getEmail()
        );

        if ($usuarioEncontrado !== null && $usuarioEncontrado !== false) {

            if (
                $usuarioEncontrado['idUsuario']
                != $usuario->getIdUsuario()
            ) {
                return false;
            }
        }

        // Criptografa a senha caso ela esteja sendo atualizada
        if (
            $usuario->getSenha() !== null &&
            $usuario->getSenha() !== ""
        ) {
            $senhaHash = password_hash(
                $usuario->getSenha(),
                PASSWORD_DEFAULT
            );

            $usuario->setSenha($senhaHash);
        }

        return $this->usuario_repository->updateUsuario($usuario);
    }

    public function validarUsuario(Usuario $usuario)
    {
        // Valida o nome
        if (
            $usuario->getNome() === null ||
            trim($usuario->getNome()) === ""
        ) {
            return false;
        }

        // Valida o email
        if (!$this->validarEmail($usuario->getEmail())) {
            return false;
        }

        // Valida a senha
        if (
            $usuario->getSenha() === null ||
            $usuario->getSenha() === ""
        ) {
            return false;
        }

        return true;
    }

    public function validarCadastro(Usuario $usuario, $confirmacaoSenha)
    {
        // Valida nome, email e senha
        if (!$this->validarUsuario($usuario)) {
            return false;
        }

        // Verifica se as senhas são iguais
        if ($usuario->getSenha() !== $confirmacaoSenha) {
            return false;
        }

        // Verifica se o email já está cadastrado
        $usuarioEncontrado = $this->readUsuarioPorEmail(
            $usuario->getEmail()
        );

        if ($usuarioEncontrado !== null && $usuarioEncontrado !== false) {
            return false;
        }

        // Verifica se o nome já está cadastrado
        $usuarioEncontrado = $this->usuario_repository
            ->findUsuarioByNome($usuario->getNome());

        if ($usuarioEncontrado !== null) {
            return false;
        }

        return true;
    }

    public function validarLogin(Usuario $usuario)
    {
        // Login exige nome de usuário
        if (
            $usuario->getNome() === null ||
            trim($usuario->getNome()) === ""
        ) {
            return false;
        }

        // Login exige senha
        if (
            $usuario->getSenha() === null ||
            $usuario->getSenha() === ""
        ) {
            return false;
        }

        return true;
    }

    public function validarEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}