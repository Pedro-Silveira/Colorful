<?php
    class Usuario{
        private $id;
        private $nome;
        private $email;

        public function __construct($id = null, $nome, $email){
            $this->id = $id;
            $this->nome = $nome;
            $this->email = $email;
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
                <p>E-mail: $this->email</p>"  
            );
        }
    }
?>