<?php
# Imports
require 'connection.php';

# Variáveis
$connection = new Connection();
$users = $connection->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Página Inicial - Colorful</title>
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <script src="/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="/images/Colorful.png" alt="Logo" width="200" height="50" class="d-inline-block align-text-top">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Features</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Pricing</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown link
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <table border='1'>
                <tr>
                    <th>ID</th>    
                    <th>Nome</th>    
                    <th>Email</th>
                    <th>Ação</th>    
                </tr>
                <?php
                    foreach($users as $user){
                        echo(
                            "<tr>
                                <td>" . $user->id . "</td>
                                <td>" . $user->name . "</td>
                                <td>" . $user->email . "</td>
                                <td>
                                    <a href='#'>Editar</a>
                                    <a href='#'>Excluir</a>
                                </td>
                            </tr>"
                        );
                    };
                ?>
            </table>
        </main> 
    </body>
</html>