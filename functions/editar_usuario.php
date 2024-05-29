<?php
    # Imports
    require './../classes/usuario_banco.php';

    # Variáveis
    $usuarioBanco = new UsuarioBanco();
    $nomeRegex = "/^[A-Za-zÀ-ú]+(?:\s[A-Za-zÀ-ú]+)*$/";
    $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    /*
    * Verifica se os parâmetros necessário foram recebidos via POST.
    * Armazena os valores em variáveis, para facilitar o manuseio.
    * Testa os campos recebidos através das expressões regulares.
    * Caso os dados sejam válidos, cria um objeto do usuário com ID igual ao recebido como parâmetro.
    * Edita no DB os dados do usuário, conforme os parâmetros recebidos.
    * Retorna para a Página Inicial com uma mensagem de erro ou sucesso.
    */
    if (isset($_POST["id"]) && isset($_POST["nome"]) && isset($_POST["email"])) {
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];

        if (!preg_match($nomeRegex, $nome)) {
            header("location: /../index.php?m=1");
            exit();
        } else if (!preg_match($emailRegex, $email)) {
            header("location: /../index.php?m=2");
            exit();
        } else {
            $usuario = $usuarioBanco->retornarUsuario($id);

            if ($usuario) {
                $usuarioBanco->salvarUsuario($usuario, $nome, $email);
                header("location: /../index.php?m=4");
                exit();
            } else {
                header("location: /../index.php?m=3");
                exit();
            }
        };
    } else {
        header("location: /../index.php?m=3");
        exit();
    };
?>
