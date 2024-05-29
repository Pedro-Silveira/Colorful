<?php
    # Imports
    require 'classes/usuario_banco.php';
    require 'classes/cor_banco.php';
    require 'functions/mensagem_erro.php';

    # Variáveis
    $usuarioBanco = new UsuarioBanco();
    $corBanco = new CorBanco();

    $usuarios = $usuarioBanco->retornarTodosUsuarios();
    $cores = $corBanco->retornarTodasCores();

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
        <title>Associar Cores - Colorful</title>
        <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <script src="/js/bootstrap.bundle.min.js"></script>
        <script src="/js/marcar_checkbox.js"></script>
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
                                <a class="nav-link" href="cadastrar_usuario.php">Cadastrar Usuário</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="associar_cores.php">Associar Cores</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="p-5">
            <div class="text-center">
                <p class="h1">Associar Cores</p>
                <p class="text-body-secondary mb-5">Selecione os usuários e as cores que serão associadas/desassociadas a eles.</p>
            </div>
            <form action="functions/post_associar.php" method="POST">
                <div class="row">
                    <div class="col-md-5">
                        <div class="w-100 bg-secondary-subtle border rounded-top d-flex justify-content-between align-items-center p-2">
                            <p class="h6 m-0">Usuários</p>
                            <span class="badge text-bg-primary"><?= count($usuarios) ?></span>
                        </div>
                        <div class="border rounded-bottom">
                            <ul class="list-group list-group-flush overflow-auto rounded-bottom" style="max-height: 225px;">
                                <?php foreach ($usuarios as $usuario): 
                                    $coresUsuarios = $usuarioBanco->retornarCoresAssociadas($usuario->id);
                                ?>
                                    <li class="list-group-item list-group-item-action d-flex justify-content-between">
                                        <div>
                                            <span style='font-size: 16px;'>
                                                <?= count($coresUsuarios) <= 0 ? "&#128546" : 
                                                    (count($coresUsuarios) == 1 ? "&#128578" : 
                                                    (count($coresUsuarios) == 2 ? "&#128516" : 
                                                    (count($coresUsuarios) == 3 ? "&#128512" : "&#128526")))
                                                ?>
                                            </span>
                                            <label class="form-check-label ms-2" for="checkbox-<?= $usuario->id ?>"><?= $usuario->nome ?></label>
                                        </div>
                                        <input class="form-check-input" type="checkbox" name="usuarios[]" value="<?= $usuario->id ?>" id="checkbox-<?= $usuario->id ?>">
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 text-center my-4">
                        <p class="h1 text-secondary">X</p>
                        <select class="form-select mt-4" name="tipo" aria-label="Tipo">
                            <option selected value="associar">Associar</option>
                            <option value="desassociar">Desassociar</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <div class="w-100 bg-secondary-subtle border rounded-top d-flex justify-content-between align-items-center p-2">
                            <p class="h6 m-0">Cores</p>
                            <span class="badge text-bg-primary"><?= count($cores) ?></span>
                        </div>
                        <div class="border rounded-bottom">
                            <ul class="list-group list-group-flush overflow-auto rounded" style="max-height: 225px;">
                                <?php foreach ($cores as $cor): ?>
                                    <li class="list-group-item list-group-item-action d-flex justify-content-between">
                                        <label class="form-check-label" for="checkbox-<?= $cor->id ?>"><div class='badge rounded-pill' style='color: <?= $cor->hex ?>; border: 1px solid <?= $cor->hex ?>;'><?= $cor->nome ?></div></label>
                                        <input class="form-check-input" type="checkbox" name="cores[]" value="<?= $cor->id ?>" id="checkbox-<?= $cor->id ?>">
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary btn-lg">Executar</button>
                </div>
            </form>
            <?php if ($mensagem): ?>
                <div class="alert alert-<?= $mensagem['tipo'] === 'erro' ? 'danger' : 'success' ?> alert-dismissible fade show" style="position: fixed; left: 50%; top: 90%; transform: translate(-50%, -90%); z-index: 1050;" role="alert">
                    <?= $mensagem['texto'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </main>
        <footer class="mt-auto bg-white border-top d-flex justify-content-between px-3 py-2" style="font-size: 14px;">
            <span class="text-secondary">VersoTech &copy; <span id="ano"><?= date("Y") ?></span></span>
            <span class="text-secondary d-flex">Desenvolvido por <a href="https://linkedin.com/in/pedroh-silveira" class="link-offset-2 link-underline link-underline-opacity-0 link-secondary d-flex align-items-center ms-1" target="_blank">Pedro Silveira <img src="/images/linkedin.png" class="ms-1" alt="LinkedIn" width="15" height="15"></a></span>
        </footer>
    </body>
</html>