<?php 

    require_once __DIR__ . "/../model/Genero.php";
    require_once __DIR__ . "/../repository/Genero_Repository.php";
    
    class Genero_Service {

        private $genero_repository;

        public function __construct()
        {
            require_once __DIR__ . "/../config/database.php";

            $genero_repository = new Genero_Repository($conexao);
        }


        

    }