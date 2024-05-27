<?php
    # Imports
    require 'connection.php';
    require 'class/Usuario.php';

    # Variáveis
    $connection = new Connection();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $Usuario = Usuario::buscarBanco($connection, $id);
        var_dump($Usuario);
        
        if ($Usuario) {
            $Usuario->deletarBanco($connection);
            header("location: index.php");
        }
    }
?>
