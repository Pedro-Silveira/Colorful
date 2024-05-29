<?php
    require "usuario.php";
    require_once 'connection.php';

    class UsuarioBanco {
        private $connection;

        public function __construct(){
            $this->connection = new Connection();
        }

        /*
        * Busca todos os usuários cadastrados no BD, com inclusão de filtros.
        * Retorna um array contendo o resultado da busca.
        */
        public function retornarTodosUsuarios($queryFiltro = null, $queryOrdem = null) {
            $filtroSeguro = preg_replace('/[^[:alnum:]_]/', '', $queryFiltro);
            $ordemSegura = preg_replace('/[^[:alnum:]_]/', '', $queryOrdem);

            $usuarios = [];
            $query = $this->connection->query("SELECT * FROM users WHERE name LIKE '%$filtroSeguro%' ORDER BY name $ordemSegura");
    
            foreach ($query as $usuario) {
                array_push($usuarios, new Usuario($usuario->id, $usuario->name, $usuario->email));
            }
    
            return $usuarios;
        }
    
        /*
        * Busca um usuário no DB com o ID recebido como parâmetro.
        * Retorna um objeto com os dados do usuário encontrado, ou retorna null caso não encontre.
        */
        public function retornarUsuario($id) {
            $idSeguro = preg_replace('/[^[:alnum:]_]/', '', $id);

            $query = $this->connection->query("SELECT * FROM users WHERE id = '$idSeguro'")->fetch();
    
            if ($query) {
                return new Usuario($query->id, $query->name, $query->email);
            }
    
            return null;
        }
        
        /*
        * Verifica se o objeto do usuário recebido como parâmetro já existe no sistema.
        * Caso exista, faz o update no DB com os dados recebidos como parâmetro.
        * Caso não exista, insere o usuário no DB com os dados recebidos como parâmetro.
        * Por fim, retorna um booleano com o resultado da query.
        */
        public function salvarUsuario(Usuario $usuario, $nome = null, $email = null) {
            $nomeSeguro = preg_replace('/[^[:alnum:]_]/', '', $nome);
            $emailSeguro = preg_replace('/[^[:alnum:@.]_]/', '', $email);

            if ($usuario->id) {
                $query = $this->connection->query("UPDATE users SET name = '$nomeSeguro', email = '$emailSeguro' WHERE id = '$usuario->id'");
            } else {
                $query = $this->connection->query("INSERT INTO users (name, email) VALUES ('$usuario->nome', '$usuario->email')");
                $usuario->id = $this->connection->getConnection()->lastInsertId();
            }

            return $query;
        }
    
        /*
        * Exclui o usuário no DB conforme o ID recebido como parâmetro.
        * Em seguida, exclui todas as associações desse usuário com as cores.
        * Por fim, retorna um booleano com o resultado da operação.
        */
        public function excluirUsuario($id) {
            $idSeguro = preg_replace('/[^[:alnum:]_]/', '', $id);

            $query = $this->connection->query("DELETE FROM users WHERE id = '$idSeguro'");
            $query = $this->connection->query("DELETE FROM user_colors WHERE user_id = '$idSeguro'");

            return $query;
        }

        /*
        * Busca todas as cores no BD que estão associadas ao usuário com ID igual ao recebido como parâmetro.
        * Retorna um array contendo o resultado da busca.
        */
        public function retornarCoresAssociadas($id) {
            $idSeguro = preg_replace('/[^[:alnum:]_]/', '', $id);

            $cores = [];
            $query = $this->connection->query("SELECT c.name, c.hex FROM colors AS c JOIN user_colors AS uc ON c.id = uc.color_id WHERE uc.user_id = '$idSeguro'");
            
            while ($cor = $query->fetch(PDO::FETCH_OBJ)) {
                array_push($cores, $cor);
            }

            return $cores;
        }
    };
?>