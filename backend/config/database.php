<?php

$host = "localhost";
$dbname = "Trabalho_Final";
$user = "root";
$password = "";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    echo "Conectado com sucesso!";

} catch (PDOException $e) {

    echo "Erro na conexão: " . $e->getMessage();

}