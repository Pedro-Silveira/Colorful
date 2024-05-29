<?php
    # Imports
    require './../classes/usuario_banco.php';

    # Variáveis
    $usuarioBanco = new UsuarioBanco();

    /*
    * Verifica se o ID do usuário foi recebido via POST.
    * Cria um objeto do usuário com o ID informado através do método retornarUsuario().
    * Exclui o usuário através do método excluirUsuário(), do próprio objeto.
    * Retorna para a Página Inicial com uma mensagem de erro ou de sucesso.
    */
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $usuario = $usuarioBanco->retornarUsuario($id);

        if ($usuario) {
            $usuarioBanco->excluirUsuario($id);
            header("location: /../index.php?m=5");
            exit();
        }
    }
?>