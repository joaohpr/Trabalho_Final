
<?php

require_once __DIR__ . "/../model/Usuario.php";

class Usuario_Repository
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    // Cadastra um usuário utilizando um objeto Usuario.
    public function insertUsuario(Usuario $usuario)
    {
        $sql = "INSERT INTO Usuario (nome, email, senha)
                VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($this->conexao, $sql);

        $nome = $usuario->getNome();
        $email = $usuario->getEmail();
        $senha = $usuario->getSenha();

        mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $senha);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }

    // Exclui um usuário utilizando seu ID.
    public function deleteUsuario($idUsuario)
    {
        $sql = "DELETE FROM Usuario
                WHERE idUsuario = ?";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $idUsuario);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }

    // Atualiza um usuário utilizando um objeto Usuario.
    public function updateUsuario(Usuario $usuario)
    {
        $sql = "UPDATE Usuario
                SET nome = ?, email = ?, senha = ?
                WHERE idUsuario = ?";

        $stmt = mysqli_prepare($this->conexao, $sql);

        $nome = $usuario->getNome();
        $email = $usuario->getEmail();
        $senha = $usuario->getSenha();
        $idUsuario = $usuario->getIdUsuario();

        mysqli_stmt_bind_param(
            $stmt,
            "sssi",
            $nome,
            $email,
            $senha,
            $idUsuario
        );

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }

    // Busca um usuário pelo email.
    public function findUsuarioByEmail($email)
    {
        $sql = "SELECT * FROM Usuario WHERE email = ?";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "s", $email);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $usuario = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);

        return $usuario ?: null;
    }

    // Busca um usuário pelo nome.
    public function findUsuarioByNome($nome)
    {
        $sql = "SELECT * FROM Usuario WHERE nome = ?";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "s", $nome);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $usuario = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);

        return $usuario ?: null;
    }
}
