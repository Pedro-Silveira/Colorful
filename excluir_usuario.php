<?php
    # Imports
    require 'class/UsuarioBanco.php';

    # Variáveis
    $usuarioBanco = new UsuarioBanco();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $usuario = $usuarioBanco->retornarUsuario($id);

        if ($usuario) {
            $usuarioBanco->excluirUsuario($id);
            header("location: index.php");
            exit();
        }
    }
?>