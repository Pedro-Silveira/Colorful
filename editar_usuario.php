<?php
    # Imports
    require 'class/UsuarioBanco.php';

    # Variáveis
    $usuarioBanco = new UsuarioBanco();
    $nomeRegex = "/^[A-Za-zÀ-ú]+(?:\s[A-Za-zÀ-ú]+)*$/";
    $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    if (isset($_POST["id"]) && isset($_POST["nome"]) && isset($_POST["email"])) {
        $id = $_POST["id"];
        var_dump($id);
        $nome = $_POST["nome"];
        $email = $_POST["email"];

        if (!preg_match($nomeRegex, $nome)) {
            header("location: index.php?m=1");
            exit();
        } else if (!preg_match($emailRegex, $email)) {
            header("location: index.php?m=2");
            exit();
        } else {
            $usuario = $usuarioBanco->retornarUsuario($id);
            var_dump($usuario);

            if ($usuario) {
                $usuarioBanco->salvarUsuario($usuario);
                var_dump($usuario);
            }
        };
    } else {
        header("location: index.php?m=3");
        exit();
    };
?>
