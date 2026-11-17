
<?php
//Ta ai Otavio ,comentado!
// Importa a classe Usuario, caso seja necessário utilizá-la neste Repository.
require_once __DIR__ . "/../model/Usuario.php";

// Classe responsável por realizar as operações de acesso
// e manipulação dos dados dos usuários no banco de dados.
class Usuario_Repository
{
    // Armazena a conexão com o banco de dados.
    // O atributo é private para impedir o acesso direto de fora da classe.
    private $conexao;

    // Construtor da classe.
    // Recebe a conexão com o banco de dados como parâmetro.
    // Isso permite que outros arquivos criem o Repository
    // passando uma conexão já estabelecida.
    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    // Cadastra um novo usuário no banco de dados.
    public function insertUsuario($nome, $email, $senha)
    {
        // Comando SQL para inserir um usuário.
        // Os ? são parâmetros que serão preenchidos posteriormente.
        $sql = "INSERT INTO Usuario (nome, email, senha)
                VALUES (?, ?, ?)";

        // Prepara a consulta SQL utilizando a conexão armazenada.
        $stmt = mysqli_prepare($this->conexao, $sql);

        // Associa os valores aos parâmetros da consulta.
        // "sss" significa que os três parâmetros são strings.
        mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $senha);

        // Executa o comando INSERT.
        mysqli_stmt_execute($stmt);

        // Recupera a quantidade de linhas afetadas pela consulta.
        $resultado = mysqli_stmt_affected_rows($stmt);

        // Fecha a declaração preparada e libera seus recursos.
        mysqli_stmt_close($stmt);

        // Retorna true se pelo menos uma linha foi inserida.
        // Caso contrário, retorna false.
        return $resultado > 0;
    }

    // Exclui um usuário do banco de dados.
    public function deleteUsuario($nome, $email, $senha)
    {
        // Comando SQL para excluir um usuário.
        // A exclusão acontece somente se os três valores coincidirem.
        $sql = "DELETE FROM Usuario
                WHERE nome = ? AND email = ? AND senha = ?";

        // Prepara a consulta SQL.
        $stmt = mysqli_prepare($this->conexao, $sql);

        // Associa os três parâmetros à consulta.
        // "sss" indica que todos são strings.
        mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $senha);

        // Executa o comando DELETE.
        mysqli_stmt_execute($stmt);

        // Verifica quantas linhas foram excluídas.
        $resultado = mysqli_stmt_affected_rows($stmt);

        // Fecha a declaração preparada.
        mysqli_stmt_close($stmt);

        // Retorna true se algum usuário foi excluído.
        // Retorna false caso nenhuma linha tenha sido afetada.
        return $resultado > 0;
    }

    // Atualiza os dados de um usuário existente.
    public function updateUsuario($nome, $email, $senha, $idUsuario)
    {
        // Comando SQL para atualizar nome, email e senha.
        // O WHERE identifica qual usuário será atualizado.
        $sql = "UPDATE Usuario
                SET nome = ?, email = ?, senha = ?
                WHERE idUsuario = ?";

        // Prepara a consulta SQL.
        $stmt = mysqli_prepare($this->conexao, $sql);

        // Associa os valores aos parâmetros.
        // "sssi" significa:
        // s = nome (string)
        // s = email (string)
        // s = senha (string)
        // i = idUsuario (integer)
        mysqli_stmt_bind_param($stmt, "sssi", $nome, $email, $senha, $idUsuario);

        // Executa o comando UPDATE.
        mysqli_stmt_execute($stmt);

        // Recupera a quantidade de linhas afetadas.
        $resultado = mysqli_stmt_affected_rows($stmt);

        // Fecha a declaração preparada.
        mysqli_stmt_close($stmt);

        // Retorna true se alguma linha foi alterada.
        // Caso contrário, retorna false.
        return $resultado > 0;
    }

    // Busca um usuário utilizando seu endereço de email.
    public function findUsuarioByEmail($email)
    {
        // Consulta SQL que procura um usuário pelo email.
        $sql = "SELECT * FROM Usuario WHERE email = ?";

        // Prepara a consulta.
        $stmt = mysqli_prepare($this->conexao, $sql);

        // Associa o email ao parâmetro da consulta.
        // "s" indica que o parâmetro é uma string.
        mysqli_stmt_bind_param($stmt, "s", $email);

        // Executa a consulta SELECT.
        mysqli_stmt_execute($stmt);

        // Recupera o resultado da consulta.
        $resultado = mysqli_stmt_get_result($stmt);

        // Transforma a primeira linha encontrada em um array associativo.
        // Os nomes das colunas do banco são utilizados como índices.
        $usuario = mysqli_fetch_assoc($resultado);

        // Fecha a declaração preparada.
        mysqli_stmt_close($stmt);

        // Se encontrou um usuário, retorna o array.
        // Se não encontrou, retorna null.
        return $usuario ?: null;
    }

    // Busca um usuário utilizando seu nome.
    public function findUsuarioByNome($nome)
    {
        // Consulta SQL que procura um usuário pelo nome.
        $sql = "SELECT * FROM Usuario WHERE nome = ?";

        // Prepara a consulta.
        $stmt = mysqli_prepare($this->conexao, $sql);

        // Associa o nome ao parâmetro da consulta.
        // "s" indica que o parâmetro é uma string.
        mysqli_stmt_bind_param($stmt, "s", $nome);

        // Executa a consulta SELECT.
        mysqli_stmt_execute($stmt);

        // Recupera o resultado da consulta.
        $resultado = mysqli_stmt_get_result($stmt);

        // Transforma a primeira linha encontrada em um array associativo.
        $usuario = mysqli_fetch_assoc($resultado);

        // Fecha a declaração preparada.
        mysqli_stmt_close($stmt);

        // Retorna os dados do usuário ou null se não encontrar.
        return $usuario ?: null;
    }
}
