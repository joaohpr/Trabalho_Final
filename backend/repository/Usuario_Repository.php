
<?php

require_once __DIR__ . "/../model/Usuario.php";

class Usuario_Repository
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function insertUsuario($nome, $email, $senha)
    {
        $sql = "INSERT INTO Usuario (nome, email, senha)
                VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $senha);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }

    public function deleteUsuario($nome, $email, $senha)
    {
        $sql = "DELETE FROM Usuario
                WHERE nome = ? AND email = ? AND senha = ?";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $senha);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }

    public function updateUsuario($nome, $email, $senha, $idUsuario)
    {
        $sql = "UPDATE Usuario
                SET nome = ?, email = ?, senha = ?
                WHERE idUsuario = ?";

        $stmt = mysqli_prepare($this->conexao, $sql);

        mysqli_stmt_bind_param($stmt, "sssi", $nome, $email, $senha, $idUsuario);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        return $resultado > 0;
    }

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
