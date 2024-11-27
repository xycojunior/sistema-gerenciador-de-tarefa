<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cadastro_usuarios.css">
</head>
<body>
    <nav>
        <div class="nav-left">
            <a href="gerenciamento_tarefas.php">Gerenciamento de Tarefas</a>
        </div>
        <div class="nav-right">
            <a href="cadastro_usuarios.php">Cadastro de Usuários</a>
            <a href="cadastro_tarefas.php">Cadastro de Tarefas</a>
            <a href="gerenciamento_tarefas.php">Gerenciamento de Tarefas</a>
        </div>
    </nav>

    <main>
        <h2>Cadastro de Usuários</h2>
        <div class="user-form-card">
            <?php if (isset($_GET['sucesso'])) : ?>
                <p class="success-message">Usuário cadastrado com sucesso!</p>
            <?php elseif (isset($_GET['erro'])) : ?>
                <p class="error-message">Erro ao cadastrar usuário: <?= htmlspecialchars($_GET['erro']); ?></p>
            <?php endif; ?>

            <form action="cadastrar_usuario.php" method="POST">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <button class="cadastrar" type="submit">Cadastrar</button>
            </form>
        </div>
    </main>
</body>
</html>
