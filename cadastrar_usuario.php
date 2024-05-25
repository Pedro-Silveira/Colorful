<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastrar Usuário - Colorful</title>
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/bootstrap-icons.min.css">
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
                                <a class="nav-link active" href="index.php">Página Inicial</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="cadastrar_usuario.php">Cadastrar Usuário</a>
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
                            <form action="post_usuario.php" method="POST">
                                <div class="mb-2">
                                    <label for="nome" class="form-label">Nome:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira seu nome..." aria-describedby="nomeAjuda" required>
                                    <div id="nomeAjuda" class="form-text text-danger <?= $_GET['m'] == 1 ? 'd-flex' : 'd-none' ?> align-items-center">
                                        <img src="/images/alert.png" alt="Alerta" width="13" height="13" class="me-1">
                                        O nome inserido é inválido!
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="form-label">E-mail:</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Insira seu e-mail..." aria-describedby="emailAjuda" required>
                                    <div id="emailAjuda" class="form-text text-danger <?= $_GET['m'] == 2 ? 'd-flex' : 'd-none' ?> align-items-center">
                                        <img src="/images/alert.png" alt="Alerta" width="13" height="13" class="me-1">
                                        O e-mail inserido é inválido!
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary me-2">Cadastrar</button>
                                    <button type="reset" class="btn btn-secondary">Limpar</button>
                                </div>
                            </form>
                            <div class="alert alert-danger mt-4 <?= $_GET['m'] == 3 ? 'd-flex' : 'd-none' ?>" role="alert">
                                Houve um erro. Por favor, tente novamente!
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-none d-md-block">
                        <img src="images/users.jpg" class="rounded-end" width="100%" height="100%" alt="Imagem ilustrativa">
                    </div>
                </div>
            </div>
        </main>
        <footer class="mt-auto bg-white border-top d-flex justify-content-between p-2">
            <span class="text-dark">VersoTech &copy; <span id="ano">2024</span></span>
            <span class="text-dark">Desenvolvido por <a href="https://linkedin.com/in/pedroh-silveira" class="link-offset-2 link-underline link-underline-opacity-0 link-dark">Pedro Silveira <img src="/images/linkedin.png" alt="Logo" width="15" height="15" class="mb-1"></a></span>
        </footer>
    </body>
</html>