<?php
    # Imports
    require_once "./../classes/connection.php";

    # Variáveis
    $connection = new Connection();

    /*
    * Verifica se todos os parâmetros foram recebidos via POST.
    * Para cada usuário, verifica se a cor já foi associada a ele anteriormente.
    * Em seguida verifica se o tipo é "associar" ou "desassociar".
    * Caso seja associar, inclue registro da associação daquela cor com o usuário no DB.
    * Caso contrário, desassocia todas as cores que foram recebidas como parâmetro e que estão associadas com o usuário.
    * Por fim, retorna para a Página Inicial com uma mensagem de erro ou de sucesso.
    */
    if (isset($_POST["usuarios"]) && isset($_POST["cores"]) && isset($_POST["tipo"])) {
        $usuarios = $_POST["usuarios"];
        $cores = $_POST["cores"];
        $tipo = $_POST["tipo"];

        foreach ($usuarios as $usuario) {
            foreach ($cores as $cor) {
                $query = $connection->query("SELECT COUNT(*) FROM user_colors WHERE user_id = '$usuario' AND color_id = '$cor'")->fetchColumn();

                if ($tipo == "associar") {
                    if ($query == 0) {
                        $query = $connection->query("INSERT INTO user_colors (user_id, color_id) VALUES ('$usuario', '$cor')");
                    }
                } else {
                    if ($query != 0) {
                        $query = $connection->query("DELETE FROM user_colors WHERE user_id = '$usuario' AND color_id = '$cor'");
                    }
                }
            }
        }

        header("location: /../index.php?m=7");
        exit();
    } else {
        header("location: /../associar_cores.php?m=8");
        exit();
    }
?>