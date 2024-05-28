<?php
    require "Usuario.php";
    require 'connection.php';

    class UsuarioBanco {
        private $connection;

        public function __construct(){
            $this->connection = new Connection();
        }

        public function retornarTodosUsuarios() {
            $usuarios = [];
            $query = $this->connection->query("SELECT * FROM users");
    
            foreach ($query as $usuario) {
                array_push($usuarios, new Usuario($usuario->id, $usuario->name, $usuario->email));
            }
    
            return $usuarios;
        }
    
        public function retornarUsuario($id) {
            $query = $this->connection->query("SELECT * FROM users WHERE id = '$id'")->fetch();
    
            if ($query) {
                return new Usuario($query->id, $query->name, $query->email);
            }
    
            return null;
        }
    
        public function salvarUsuario(Usuario $usuario) {
            if ($usuario->id) {
                $query = $this->connection->query("UPDATE users SET name = '$usuario->nome', email = '$usuario->email' WHERE id = '$usuario->id'");
            } else {
                $query = $this->connection->query("INSERT INTO users (name, email) VALUES ('$usuario->nome', '$usuario->email')");
                $usuario->id = $this->connection->getConnection()->lastInsertId();
            }

            return $query;
        }
    
        public function excluirUsuario($id) {
            $query = $this->connection->query("DELETE FROM users WHERE id = '$id'");

            return $query;
        }

        public function retornarCoresAssociadas($id) {
            $cores = [];
            $query = $this->connection->query("SELECT c.name, c.hex FROM colors AS c JOIN user_colors AS uc ON c.id = uc.color_id WHERE uc.user_id = '$id'");
            
            while ($cor = $query->fetch(PDO::FETCH_OBJ)) {
                array_push($cores, $cor);
            }

            return $cores;
        }
    };
?>