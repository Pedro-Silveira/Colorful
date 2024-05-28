<?php
    # Imports
    require 'class/UsuarioBanco.php';

    # Variáveis
    $usuarioBanco = new UsuarioBanco();
    $usuarios = $usuarioBanco->retornarTodosUsuarios();
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
        <script src="/js/exibir_modal.js"></script>
        <script src="/js/inicializar_tooltips.js"></script>
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
                                <a class="nav-link active" aria-current="page" href="index.php">Página Inicial</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cadastrar_usuario.php">Cadastrar Usuário</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="associar_cores.php">Associar Cores</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="p-5">
            <p class="h1">Página Inicial</p>
            <p class="text-body-secondary mb-5">Aqui você pode gerenciar todos os usuários do nosso colorido sistema.</p>
            <div class="list-group">
                <?php foreach($usuarios as $usuario): 
                    $cores = $usuarioBanco->retornarCoresAssociadas($usuario->id);
                ?>
                    <div class='list-group-item list-group-item-action d-flex justify-content-between align-items-center' data-bs-toggle='collapse' href='#<?= $usuario->id ?>' aria-expanded='false'>
                        <div>
                            <div class='d-flex'>
                                <span style='font-size: 35px;'>
                                    <?= count($cores) == 4 ? "&#128526" : 
                                        (count($cores) == 3 ? "&#128512" : 
                                        (count($cores) == 2 ? "&#128516" : 
                                        (count($cores) == 1 ? "&#128578" : "&#128546")))
                                    ?>
                                </span>
                                <div class='ms-3'>
                                    <p class='m-0 p-0'>
                                        <strong><?= $usuario->nome ?></strong>
                                    </p>
                                    <p class='m-0 p-0'>
                                        <?= $usuario->email ?>
                                    </p>
                                </div>
                            </div>
                            <div class='collapse' id='<?= $usuario->id ?>'>
                                <?php foreach ($cores as $cor): ?>
                                    <div class='badge rounded-pill mt-2 me-1' style='color: <?= $cor->hex ?>; border: 1px solid <?= $cor->hex ?>;'><?= $cor->name ?></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-dark btn-sm p-1 rounded-circle align-items-center me-1" data-bs-toggle="tooltip" title="Editar" onclick="confirmarEdicao(<?= $usuario->id ?>, '<?= $usuario->nome ?>', '<?= $usuario->email ?>')">
                                <img src="/images/editar.png" class="d-flex" width="20px" height="20px" alt="Editar" >
                            </button>
                            <button type="button" class="btn btn-danger btn-sm p-1 rounded-circle align-items-center" data-bs-toggle="tooltip" title="Excluir" onclick="confirmarExclusao(<?= $usuario->id ?>, '<?= $usuario->nome ?>')">
                                <img src="/images/apagar.png" class="d-flex" width="20px" height="20px" alt="Apagar" >
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
        <footer class="mt-auto bg-white border-top d-flex justify-content-between px-3 py-2" style="font-size: 14px;">
            <span class="text-secondary">VersoTech &copy; <span id="ano">2024</span></span>
            <span class="text-secondary d-flex">Desenvolvido por <a href="https://linkedin.com/in/pedroh-silveira" class="link-offset-2 link-underline link-underline-opacity-0 link-secondary d-flex align-items-center ms-1" target="_blank">Pedro Silveira <img src="/images/linkedin.png" class="ms-1" alt="LinkedIn" width="15" height="15"></a></span>
        </footer>
        <div class="modal fade" id="modalEditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tituloModalEditar" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tituloModalEditar">Editar Usuário</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditar" action="editar_usuario.php" method="POST">
                            <p class="text-body-secondary">Preencha os campos abaixo para editar o usuário.</p>
                            <div class="mb-2">
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira seu nome..." aria-describedby="nomeAjuda" required>
                                <div id="nomeAjuda" class="form-text text-danger <?= isset($_GET['m']) && $_GET['m'] == 1 ? 'd-flex' : 'd-none' ?> align-items-center">
                                    <img src="/images/alert.png" alt="Alerta" width="13" height="13" class="me-1">
                                    O nome inserido é inválido!
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">E-mail:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Insira seu e-mail..." aria-describedby="emailAjuda" required>
                                <div id="emailAjuda" class="form-text text-danger <?= isset($_GET['m']) && $_GET['m'] == 2 ? 'd-flex' : 'd-none' ?> align-items-center">
                                    <img src="/images/alert.png" alt="Alerta" width="13" height="13" class="me-1">
                                    O e-mail inserido é inválido!
                                </div>
                            </div>
                            <input id="id" type="hidden" name="id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                        <button id="botaoEditar" type="submit" form="formEditar" class="btn btn-primary me-2">Editar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalExcluir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tituloModalExcluir" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tituloModalExcluir">Excluir Usuário</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir o usuário? Esta ação não poderá ser revertida após a confirmação.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                        <a href="#" id="botaoExcluir" class="btn btn-danger">Excluir</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>