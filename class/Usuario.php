<?php
    class Usuario{
        private $id;
        private $nome;
        private $email;
        private $connection;

        public function __construct($nome, $email, $connection){
            $this->nome = $nome;
            $this->email = $email;
            $this->connection = $connection;
        }

        public function __get($atributo){
            return $this->$atributo;
        }

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        public function __toString(){
            return '<p>ID: '.$this->id.
            '.<br />Nome: '.$this->nome.
            '.<br />E-mail: '.$this->email.
            '.</p>';
        }

        public function enviarBanco() {
            switch ($this->id) {
                case true:
                    $query = $this->connection->query("UPDATE users SET name = '$this->nome', email = '$this->email' WHERE id = '$this->id'");

                    break;
                case false:
                    $query = $this->connection->query("INSERT INTO users (name, email) VALUES ('$this->nome', '$this->email')");

                    $this->id = $this->connection->getConnection()->lastInsertId();

                    break;
            }
        }
    
        public static function buscarBanco($connection, $id) {
            $query = $connection->query("SELECT * FROM users WHERE id = '$id'")->fetch();
            var_dump($query);
    
            if ($query) {
                return new self($query->id, $query->name, $query->email);
            }
    
            return null;
        }

        public function deletarBanco($connection) {
            $query = $connection->query("DELETE * FROM users WHERE id = '$this->id'");

            return null;
        }
    }
?>