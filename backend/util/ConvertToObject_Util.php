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


        private function convertToAvaliacao($comentario,$data_criacao,$nota,Usuario $usuario_id,Filme $filme_id){

            $avaliacao = new Avaliacao($usuario_id,$filme_id,$nota,$comentario,$data_criacao,null);

            return $avaliacao;
        }

        private function convertToCurtida_Avaliacao($id,$data_criacao,$Avaliacao_id,$Usuario_id){
           
            $curtida_Avaliacao = new Curtida_Avaliacao($id,$data_criacao,$Avaliacao_id,$Usuario_id); 
            
            return $curtida_Avaliacao;
        }

        private function convertToCurtido($usuario_id,$filme_id,$id,$data_curtida){
            
            $curtido = new Curtido($usuario_id,$filme_id,$id,$data_curtida);

            return $curtido;
        }

        private function convertToFilme($nome,$idTmdb,$notaTmdb,$description,$dataLancamento,$imagem){

            $filme = new Filme($nome,$idTmdb,$notaTmdb,$description,$dataLancamento,$imagem);

            return $filme;
        }

        private function convertToGenero_Filme($idGenero, $idFilme){
            
            $genero_filme = new Genero_Filme($idGenero, $idFilme);

            return $genero_filme;
        }

        private function convertToGenero($idGenero,$nome,$descricao){

            $genero = new Genero($idGenero,$nome,$descricao);

            return $genero;
        }

        private function convertToHistorico_Pesquisa($idHistoricoPesquisa, $termo, $dataPesquisa, Filme $filme, Usuario $usuario){
            
            $historico_pesquisa = new Historico_Pesquisa ($idHistoricoPesquisa, $termo, $dataPesquisa, $filme, $usuario);

            return $historico_pesquisa;
        }

        private function convertToUsuario($idUsuario,$nome,$email,$senha){

            $usuario = new Usuario($idUsuario,$nome,$email,$senha);

            return $usuario;

        }


    }
