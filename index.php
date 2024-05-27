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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="/css/styles.css" rel="stylesheet">
        <script src="/js/bootstrap.bundle.min.js"></script>
        <script src="/js/getDate.js"></script>
    </head>
    <body class="bg-light d-flex flex-column min-vh-100">
        <header>
            <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">
                        <img src="/images/Colorful.png" alt="Logo" width="200" height="50" class="d-inline-block align-text-top">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Página Inicial</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cadastrar_usuario.php">Cadastrar Usuário</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Cores
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="gerenciar_cores.php">Gerenciar Cores</a></li>
                                    <li><a class="dropdown-item" href="cadastrar_cor.php">Cadastrar Cor</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="p-5">
            <p class="h1">Gerenciar Usuários</p>
            <p class="text-body-secondary mb-5">Aqui você pode gerenciar todos os usuários do nosso colorido sistema.</p>
            <div class="list-group">
                <?php foreach($users as $user):
                    $cores = $connection->query("SELECT c.name, c.hex FROM colors as c, users as u, user_colors as uc WHERE $user->id = uc.user_id AND c.id = uc.color_id GROUP BY c.id");
                ?>
                    <div class='list-group-item list-group-item-action d-flex justify-content-between align-items-center' data-bs-toggle='collapse' href='#<?= $user->id ?>' aria-expanded='false'>
                        <div>
                            <div class='d-flex'>
                                <span style='font-size:32px;'>&#128546;</span>
                                <div class='ms-2'>
                                    <p class='m-0 p-0'>
                                        <strong><?= $user->name ?></strong>
                                    </p>
                                    <p class='m-0 p-0'>
                                        <?= $user->email ?>
                                    </p>
                                </div>
                            </div>
                            <div class='collapse' id='<?= $user->id ?>'>
                                <?php foreach ($cores as $cor): ?>
                                    <div class='badge rounded-pill mt-2 me-1' style='color: <?= $cor->hex ?>; border: 1px solid <?= $cor->hex ?>;'><?= $cor->name ?></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div>
                            <a class="link-offset-2 link-underline link-underline-opacity-0 link-secondary" href="editar_usuario.php?id=<?= $user->id ?>">
                                <img src="/images/editar.png" alt="Editar" width="25" height="25">
                            </a>
                            <a class="link-offset-2 link-underline link-underline-opacity-0 link-secondary" href="delete_usuario.php?id=<?= $user->id ?>">
                                <img src="/images/apagar-simbolo.png" alt="Apagar" width="25" height="25">
                            </a>
                        </div>
                                </div>
                <?php endforeach; ?>
            </div>
        </main>
        <footer class="mt-auto bg-white border-top d-flex justify-content-between p-2">
            <span class="text-dark">VersoTech &copy; <span id="ano">2024</span></span>
            <span class="text-dark">Desenvolvido por <a href="https://linkedin.com/in/pedroh-silveira" class="link-offset-2 link-underline link-underline-opacity-0 link-dark">Pedro Silveira <img src="/images/linkedin.png" alt="Logo" width="15" height="15" class="mb-1"></a></span>
        </footer>
    </body>
</html>