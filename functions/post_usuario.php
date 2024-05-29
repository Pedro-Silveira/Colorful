<?php
    # Imports
    require './../classes/usuario_banco.php';

    # Variáveis
    $usuarioBanco = new UsuarioBanco();
    $nomeRegex = "/^[A-Za-zÀ-ú]+(?:\s[A-Za-zÀ-ú]+)*$/";
    $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    /*
    * Verifica se todos os parâmetros foram recebidos via POST.
    * Testa os parâmetros recebidos através das expressões regulares.
    * Caso sejam válidos, cria um novo objeto para o usuário.
    * Envia os dados do usuário para o DB através do método salvarUsuario().
    * Retorna para a Página Inicial com uma mensagem de erro ou de sucesso.
    */
    if (isset($_POST["nome"]) && isset($_POST["email"])) {
        $nome = $_POST["nome"];
        $email = $_POST["email"];

        if (!preg_match($nomeRegex, $nome)) {
            header("location: /../cadastrar_usuario.php?m=1");
            exit();
        } else if (!preg_match($emailRegex, $email)) {
            header("location: /../cadastrar_usuario.php?m=2");
            exit();
        } else {
            $usuario = new Usuario(null, $nome, $email);

            if ($usuario) {
                $usuarioBanco->salvarUsuario($usuario);
                header("location: /../index.php?m=6");
                exit();
            } else {
                header("location: /../cadastrar_usuario.php?m=3");
                exit();
            };
        };
    } else {
        header("location: /../cadastrar_usuario.php?m=3");
        exit();
    };
?>
