<?php
    # Imports
    require 'functions/mensagem_erro.php';
    
    # Mensagens de erro
    if (isset($_GET["m"])) {
        $mensagem = mensagemErro($_GET["m"]);
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastrar Usuário - Colorful</title>
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <script src="/js/bootstrap.bundle.min.js"></script>
        <script src="/js/focar_formulario.js"></script>
    </head>
    <body class="bg-light d-flex flex-column min-vh-100">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
                <div class="container-fluid px-5 py-2">
                    <a class="navbar-brand" href="index.php">
                        <img src="/images/Colorful.png" alt="Logo" width="200" height="50" class="d-inline-block align-text-top">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php">Página Inicial</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="cadastrar_usuario.php">Cadastrar Usuário</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="associar_cores.php">Associar Cores</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="container-fluid p-5 justify-content-center">
            <div class="card bg-transparent p-0 border-0 w-100">
                <div class="row g-0">
                    <div class="col-md-9">
                        <div class="card-body bg-white me-4 rounded-start p-5 h-100">
                            <p class="h1">Cadastrar Usuário</p>
                            <p class="text-body-secondary mb-5">Preencha os campos abaixo para cadastrar um novo usuário.</p>
                            <form action="functions/post_usuario.php" method="POST">
                                <div class="mb-2">
                                    <label for="nome" class="form-label">Nome:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira o nome..." required>
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="form-label">E-mail:</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Insira o e-mail..." required>
                                </div>
                                <div class="d-flex">
                                    <button id="botaoCadastrar" type="submit" class="btn btn-primary me-2">Cadastrar</button>
                                    <button type="reset" class="btn btn-secondary">Limpar</button>
                                </div>
                            </form>
                            <?php if ($mensagem): ?>
                                <div class="alert alert-<?= $mensagem['tipo'] === 'erro' ? 'danger' : 'success' ?> alert-dismissible fade show" style="position: fixed; left: 50%; top: 90%; transform: translate(-50%, -90%); z-index: 1050;" role="alert">
                                    <?= $mensagem['texto'] ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-3 d-none d-md-block">
                        <img src="images/users.jpg" class="rounded-end" width="100%" height="100%" alt="Imagem ilustrativa">
                    </div>
                </div>
            </div>
        </main>
        <footer class="mt-auto bg-white border-top d-flex justify-content-between px-3 py-2" style="font-size: 14px;">
            <span class="text-secondary">VersoTech &copy; <span id="ano"><?= date("Y") ?></span></span>
            <span class="text-secondary d-flex">Desenvolvido por <a href="https://linkedin.com/in/pedroh-silveira" class="link-offset-2 link-underline link-underline-opacity-0 link-secondary d-flex align-items-center ms-1" target="_blank">Pedro Silveira <img src="/images/linkedin.png" class="ms-1" alt="LinkedIn" width="15" height="15"></a></span>
        </footer>
    </body>
</html>