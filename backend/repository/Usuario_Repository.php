
<?php

// Importa a classe Usuario para permitir a utilização de seus objetos.
require_once __DIR__ . "/../model/Usuario.php";

// Classe responsável por realizar as operações de acesso
// e manipulação dos dados dos usuários no banco de dados.
class Usuario_Repository
{
    // Armazena a conexão com o banco de dados.
    private $conexao;

    // Recebe a conexão com o banco de dados e a armazena no atributo da classe.
    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    // Cadastra um usuário utilizando um objeto Usuario.
    public function insertUsuario(Usuario $usuario)
    {
        // Define o comando SQL para inserir um novo usuário.
        // Os pontos de interrogação representam os parâmetros que serão preenchidos.
        $sql = "INSERT INTO Usuario (nome, email, senha)
                VALUES (?, ?, ?)";

        // Prepara o comando SQL para receber os parâmetros com segurança.
        $stmt = mysqli_prepare($this->conexao, $sql);

        // Obtém os dados do objeto Usuario através dos métodos getters.
        $nome = $usuario->getNome();
        $email = $usuario->getEmail();
        $senha = $usuario->getSenha();

        // Associa os valores aos parâmetros da consulta.
        // O tipo "sss" indica que os três parâmetros são strings.
        mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $senha);

        // Executa o comando SQL.
        mysqli_stmt_execute($stmt);

        // Verifica quantas linhas foram afetadas pela operação.
        $resultado = mysqli_stmt_affected_rows($stmt);

        // Fecha a declaração preparada para liberar recursos.
        mysqli_stmt_close($stmt);

        // Retorna true se pelo menos uma linha foi afetada; caso contrário, false.
        return $resultado > 0;
    }

    // Exclui um usuário utilizando seu ID.
    public function deleteUsuario($idUsuario)
    {
        // Define o comando SQL para excluir um usuário específico.
        $sql = "DELETE FROM Usuario
                WHERE idUsuario = ?";

        // Prepara o comando SQL.
        $stmt = mysqli_prepare($this->conexao, $sql);

        // Associa o ID ao parâmetro da consulta.
        // O tipo "i" indica que o parâmetro é um número inteiro.
        mysqli_stmt_bind_param($stmt, "i", $idUsuario);

        // Executa o comando SQL.
        mysqli_stmt_execute($stmt);

        // Obtém a quantidade de linhas afetadas pela exclusão.
        $resultado = mysqli_stmt_affected_rows($stmt);

        // Fecha a declaração preparada.
        mysqli_stmt_close($stmt);

        // Retorna true se algum usuário foi excluído.
        return $resultado > 0;
    }

    // Atualiza os dados de um usuário utilizando um objeto Usuario.
    public function updateUsuario(Usuario $usuario)
    {
        // Define o comando SQL para atualizar os dados de um usuário.
        // A identificação do registro é feita pelo idUsuario.
        $sql = "UPDATE Usuario
                SET nome = ?, email = ?, senha = ?
                WHERE idUsuario = ?";

        // Prepara o comando SQL.
        $stmt = mysqli_prepare($this->conexao, $sql);

        // Obtém os dados do objeto Usuario através dos métodos getters.
        $nome = $usuario->getNome();
        $email = $usuario->getEmail();
        $senha = $usuario->getSenha();
        $idUsuario = $usuario->getIdUsuario();

        // Associa os valores aos parâmetros da consulta.
        // "sssi" indica três strings seguidas de um inteiro.
        mysqli_stmt_bind_param(
            $stmt,
            "sssi",
            $nome,
            $email,
            $senha,
            $idUsuario
        );

        // Executa a atualização no banco de dados.
        mysqli_stmt_execute($stmt);

        // Obtém a quantidade de linhas afetadas pela atualização.
        $resultado = mysqli_stmt_affected_rows($stmt);

        // Fecha a declaração preparada.
        mysqli_stmt_close($stmt);

        // Retorna true se alguma linha foi alterada.
        return $resultado > 0;
    }

    // Busca um usuário pelo seu email.
    public function findUsuarioByEmail($email)
    {
        // Define o comando SQL para buscar um usuário pelo email.
        $sql = "SELECT * FROM Usuario WHERE email = ?";

        // Prepara o comando SQL.
        $stmt = mysqli_prepare($this->conexao, $sql);

        // Associa o email ao parâmetro da consulta.
        // O tipo "s" indica que o parâmetro é uma string.
        mysqli_stmt_bind_param($stmt, "s", $email);

        // Executa a consulta.
        mysqli_stmt_execute($stmt);

        // Obtém o resultado da consulta.
        $resultado = mysqli_stmt_get_result($stmt);

        // Recupera o primeiro registro encontrado como um array associativo.
        $usuario = mysqli_fetch_assoc($resultado);

        // Fecha a declaração preparada.
        mysqli_stmt_close($stmt);

        // Retorna os dados encontrados ou null caso nenhum usuário seja encontrado.
        return $usuario ?: null;
    }

    // Busca um usuário pelo seu nome.
    public function findUsuarioByNome($nome)
    {
        // Define o comando SQL para buscar um usuário pelo nome.
        $sql = "SELECT * FROM Usuario WHERE nome = ?";

        // Prepara o comando SQL.
        $stmt = mysqli_prepare($this->conexao, $sql);

        // Associa o nome ao parâmetro da consulta.
        mysqli_stmt_bind_param($stmt, "s", $nome);

        // Executa a consulta.
        mysqli_stmt_execute($stmt);

        // Obtém o resultado da consulta.
        $resultado = mysqli_stmt_get_result($stmt);

        // Recupera o primeiro registro encontrado como um array associativo.
        $usuario = mysqli_fetch_assoc($resultado);

        // Fecha a declaração preparada.
        mysqli_stmt_close($stmt);

        // Retorna os dados encontrados ou null caso nenhum usuário seja encontrado.
        return $usuario ?: null;
    }
}
