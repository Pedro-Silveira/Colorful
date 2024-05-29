<?php
    # Imports
    require 'classes/usuario_banco.php';
    require 'functions/mensagem_erro.php';

    # Variáveis
    $usuarioBanco = new UsuarioBanco();
    $filtro = null;
    $ordem = null;

    # Filtros
    if (isset($_GET["filtro"])) {
        $filtro = $_GET["filtro"];
    }
    
    if (isset($_GET["ordem"])) {
        $ordem = $_GET["ordem"];
    }
    
    $usuarios = $usuarioBanco->retornarTodosUsuarios($filtro, $ordem);

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
        <title>Página Inicial - Colorful</title>
        <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <script src="/js/bootstrap.bundle.min.js"></script>
        <script src="/js/exibir_modal.js"></script>
        <script src="/js/focar_formulario.js"></script>
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
            <form method="GET" class="mb-2">
                <div class="row g-2">
                    <div class="col-lg-7 col-md-6">
                        <input type="text" name="filtro" class="form-control" placeholder="Filtrar pelo nome..." value="<?= $filtro ?>">
                    </div>
                    <div class="col-md-4">
                        <select name="ordem" class="form-select">
                            <option value="ASC" <?= $ordem == "ASC" ? "selected" : null ?>>Ordem Crescente</option>
                            <option value="DESC" <?= $ordem == "DESC" ? "selected" : null ?>>Ordem Decrescente</option>
                        </select>
                    </div>
                    <div class="col-lg-1 col-md-2 d-flex">
                        <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center w-100 me-1" data-bs-toggle="tooltip" title="Aplicar">
                            <img src="/images/filtro.png" alt="Aplicar" class="img-fluid" width="15" height="15">
                        </button>
                        <a href="index.php" class="btn btn-secondary d-flex justify-content-center align-items-center w-100 ms-1" data-bs-toggle="tooltip" title="Restaurar">
                            <img src="/images/restaurar.png" alt="Restaurar" class="img-fluid" width="15" height="15">
                        </a>
                    </div>
                </div>
            </form>
            <div class="border rounded">
                <div class="list-group list-group-flush overflow-auto rounded" style="max-height: 300px;">
                    <?php if (count($usuarios) > 0): ?>
                        <?php foreach($usuarios as $usuario): ?>
                            <?php $cores = $usuarioBanco->retornarCoresAssociadas($usuario->id); ?>
                            <div class='list-group-item list-group-item-action d-flex justify-content-between align-items-center' data-bs-toggle='collapse' role="button" href='#<?= $usuario->id ?>' aria-expanded='false'>
                                <div>
                                    <div class='d-flex'>
                                        <span style='font-size: 35px;'>
                                            <?= count($cores) <= 0 ? "&#128546" : 
                                                (count($cores) == 1 ? "&#128578" : 
                                                (count($cores) == 2 ? "&#128516" : 
                                                (count($cores) == 3 ? "&#128512" : "&#128526")))
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
                    <?php else: ?>
                        <div class="list-group-item">Ops... nenhum amiguinho colorido por aqui! &#128546</div>
                    <?php endif; ?>
                </div>
            </div>
            <p class="text-body-secondary mt-2">Total: <?= count($usuarios) ?> usuário(s) encontrado(s).</p>
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
        <div class="modal fade" id="modalEditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tituloModalEditar" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tituloModalEditar">Editar Usuário</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditar" action="functions/editar_usuario.php" method="POST">
                            <p class="text-body-secondary">Preencha os campos abaixo para editar o usuário.</p>
                            <div class="mb-2">
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira o nome..." required>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">E-mail:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Insira o e-mail..." required>
                            </div>
                            <input id="idEditar" type="hidden" name="id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                        <button id="botaoCadastrar" type="submit" form="formEditar" class="btn btn-primary me-2">Editar</button>
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
                        <form id="formExcluir" action="functions/excluir_usuario.php" method="POST">
                            <input id="idExcluir" type="hidden" name="id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                        <button id="botaoExcluir" type="submit" form="formExcluir" class="btn btn-danger me-2">Excluir</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>