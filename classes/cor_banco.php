<?php
    require 'cor.php';
    require_once 'connection.php';

    class CorBanco {
        private $connection;

        public function __construct(){
            $this->connection = new Connection();
        }

        /*
        * Busca todas as cores cadastradas no BD.
        * Retorna um array contendo o resultado da busca.
        */
        public function retornarTodasCores() {
            $cores = [];
            $query = $this->connection->query("SELECT * FROM colors");
    
            foreach ($query as $cor) {
                array_push($cores, new Cor($cor->id, $cor->name, $cor->hex));
            }

            return $cores;
        }
    };
?>