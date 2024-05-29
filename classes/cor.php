<?php
    class Cor{
        private $id;
        private $nome;
        private $hex;

        public function __construct($id = null, $nome, $hex){
            $this->id = $id;
            $this->nome = $nome;
            $this->hex = $hex;
        }

        public function __get($atributo){
            return $this->$atributo;
        }

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        public function __toString(){
            return (
                "<p>ID: $this->id</p>
                <p>Nome: $this->nome</p>
                <p>HEX: $this->hex</p>"                
            );
        }
    }
?>