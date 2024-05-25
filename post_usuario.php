<?php
    # Imports
    require 'connection.php';
    require 'class/Usuario.php';

    # Variáveis
    $connection = new Connection();
    $nomeRegex = "/^[A-Za-zÀ-ú]+(?:\s[A-Za-zÀ-ú]+)*$/";
    $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    if (isset($_POST['nome']) && isset($_POST['email'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        if (!preg_match($nomeRegex, $nome)) {
            header("location: cadastrar_usuario.php?m=1");
        } else if (!preg_match($emailRegex, $email)) {
            header("location: cadastrar_usuario.php?m=2");
        } else {
            $Usuario = new Usuario($_POST['nome'], $_POST['email'], $connection);
            
            if ($Usuario) {
                $Usuario->enviarBanco();
                header("location: index.php");
            } else {
                header("location: cadastrar_usuario.php?m=3");
            }
        }
    } else {
        header("location: cadastrar_usuario.php?m=3");
    }
?>
