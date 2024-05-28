<?php
    # Imports
    require 'class/UsuarioBanco.php';

    # Variáveis
    $usuarioBanco = new UsuarioBanco();
    $nomeRegex = "/^[A-Za-zÀ-ú]+(?:\s[A-Za-zÀ-ú]+)*$/";
    $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    if (isset($_POST["nome"]) && isset($_POST["email"])) {
        $nome = $_POST["nome"];
        $email = $_POST["email"];

        if (!preg_match($nomeRegex, $nome)) {
            header("location: cadastrar_usuario.php?m=1");
            exit();
        } else if (!preg_match($emailRegex, $email)) {
            header("location: cadastrar_usuario.php?m=2");
            exit();
        } else {
            $usuario = new Usuario(null, $nome, $email);

            if ($usuario) {
                $usuarioBanco->salvarUsuario($usuario);
                header("location: index.php");
                exit();
            } else {
                header("location: cadastrar_usuario.php?m=3");
                exit();
            };
        };
    } else {
        header("location: cadastrar_usuario.php?m=3");
        exit();
    };
?>
