<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Tarefas</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cadastro_tarefas.css">
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
        <h2>Cadastro de Tarefas</h2>
        <div class="task-form-card">
            <?php
            // Conectar ao banco de dados
            require_once 'db.php';

            try {
                // Obter usuários do banco
                $stmt = $pdo->query("SELECT id, nome FROM usuarios");
                $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                die("Erro ao buscar usuários: " . $e->getMessage());
            }
            ?>

            <?php if (isset($_GET['sucesso'])) : ?>
                <p class="success-message">Tarefa cadastrada com sucesso!</p>
            <?php elseif (isset($_GET['erro'])) : ?>
                <p class="error-message">Erro ao cadastrar tarefa: <?= htmlspecialchars($_GET['erro']); ?></p>
            <?php endif; ?>

            <form action="cadastrar_tarefa.php" method="POST">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" rows="4" required></textarea>

                <label for="setor">Setor</label>
                <input type="text" id="setor" name="setor" required>

                <label for="usuario">Usuário</label>
                <select id="usuario" name="usuario" required>
                    <option value="" disabled selected>Selecione um usuário</option>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <option value="<?= $usuario['id']; ?>"><?= htmlspecialchars($usuario['nome']); ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="prioridade">Prioridade</label>
                <select id="prioridade" name="prioridade" required>
                    <option value="" disabled selected>Selecione a prioridade</option>
                    <option value="baixa">Baixa</option>
                    <option value="media">Média</option>
                    <option value="alta">Alta</option>
                </select>

                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </main>
</body>
</html>
