<?php

$host = "localhost";
$dbname = "Trabalho_Final";
$user = "root";
$password = "";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    $conexao = mysqli_connect(
        $host,
        $user,
        $password,
        $dbname
    );

    mysqli_set_charset($conexao, "utf8mb4");

    echo "Conectado com sucesso!";

} catch (mysqli_sql_exception $e) {

    echo "Erro na conexão: " . $e->getMessage();

}