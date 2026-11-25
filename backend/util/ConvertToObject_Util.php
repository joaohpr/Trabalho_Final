<?php

    require_once __DIR__ . "/../model/Avaliacao.php";
    require_once __DIR__ . "/../model/Curtida_Avaliacao.php";
    require_once __DIR__ . "/../model/Curtido.php";
    require_once __DIR__ . "/../model/Filme.php";
    require_once __DIR__ . "/../model/Genero.php";
    require_once __DIR__ . "/../model/Genero_Filme.php";
    require_once __DIR__ . "/../model/Historico_Pesquisa.php";
    require_once __DIR__ . "/../model/Usuario.php";


    class ConvertToObject_Util {

        private Avaliacao $avaliacao;
        private Curtida_Avaliacao $curtida_avalicao;
        private Curtido $curtido;
        private Filme $filme;
        private Genero $genero;
        private Genero_Filme $genero_filme;
        private Historico_Pesquisa $historico_pesquisa;
        private Usuario $usuario;


        public function __construct()
        {
            throw new \Exception('Not implemented');
        }


        public function convertToAvaliacao($comentario,$data_criacao,$nota,Usuario $usuario_id,Filme $filme_id){

            $avaliacao = new Avaliacao($usuario_id,$filme_id,$nota,$comentario,$data_criacao,null);

            return $avaliacao;
        }

        public function convertToCurtida_Avaliacao($id,$data_criacao,$Avaliacao_id,$Usuario_id){
           
            $curtida_Avaliacao = new Curtida_Avaliacao($id,$data_criacao,$Avaliacao_id,$Usuario_id); 
            
            return $curtida_Avaliacao;
        }

        public function convertToCurtido($usuario_id,$filme_id,$id,$data_curtida){
            
            $curtido = new Curtido($usuario_id,$filme_id,$id,$data_curtida);

            return $curtido;
        }

        public function convertToFilme($nome,$idTmdb,$notaTmdb,$description,$dataLancamento,$imagem){

            $filme = new Filme($nome,$idTmdb,$notaTmdb,$description,$dataLancamento,$imagem);

            return $filme;
        }

        public function convertToGenero_Filme($idGenero, $idFilme){
            
            $genero_filme = new Genero_Filme($idGenero, $idFilme);

            return $genero_filme;
        }

        public function convertToGenero($idGenero,$nome,$descricao){

            $genero = new Genero($idGenero,$nome,$descricao);

            return $genero;
        }

        public function convertToHistorico_Pesquisa($idHistoricoPesquisa, $termo, $dataPesquisa, Filme $filme, Usuario $usuario){
            
            $historico_pesquisa = new Historico_Pesquisa ($idHistoricoPesquisa, $termo, $dataPesquisa, $filme, $usuario);

            return $historico_pesquisa;
        }

        public function convertToUsuario($idUsuario,$nome,$email,$senha){

            $usuario = new Usuario($idUsuario,$nome,$email,$senha);

            return $usuario;

        }


    }
