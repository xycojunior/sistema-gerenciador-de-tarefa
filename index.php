<?php
// Conexão com o banco de dados
require_once 'db.php'; // Arquivo que contém a conexão com o banco

// Consultar tarefas no banco de dados
try {
    $query = $pdo->query("SELECT 
        t.id, 
        t.descricao, 
        t.setor, 
        t.prioridade, 
        t.status, 
        u.nome AS usuario 
    FROM tarefas t
    LEFT JOIN usuarios u ON t.usuario_id = u.id");

    $tarefas = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar tarefas: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Tarefas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <div class="nav-left">
            <h2>Gerenciamento de Tarefas</h2>
        </div>
        <div class="nav-right">
            <a href="cadastro_usuarios.php">Cadastro de Usuários</a>
            <a href="cadastro_tarefas.php">Cadastro de Tarefas</a>
            <a href="gerenciamento_tarefas.php">Gerenciamento de Tarefas</a>
        </div>
    </nav>

    <main>
        <h1>Tarefas</h1>
        <div class="tasks-container">
            <!-- Seção A Fazer -->
            <section>
                <h2>A Fazer</h2>
                <?php foreach ($tarefas as $tarefa) : ?>
                    <?php if ($tarefa['status'] === 'a fazer') : ?>
                        <div class="task-card">
                            <p><strong>Descrição:</strong> <?= htmlspecialchars($tarefa['descricao']); ?></p>
                            <p><strong>Setor:</strong> <?= htmlspecialchars($tarefa['setor']); ?></p>
                            <p><strong>Prioridade:</strong> <?= htmlspecialchars($tarefa['prioridade']); ?></p>
                            <p><strong>Vinculado a:</strong> <?= htmlspecialchars($tarefa['usuario'] ?? 'N/A'); ?></p>
                            <div class="card-actions">
                                <button onclick="location.href='editar_tarefa.php?id=<?= $tarefa['id']; ?>'">Editar</button>
                                <button onclick="location.href='excluir_tarefa.php?id=<?= $tarefa['id']; ?>'">Excluir</button>
                            </div>
                            <form action="alterar_status.php" method="POST">
                                <input type="hidden" name="id" value="<?= $tarefa['id']; ?>">
                                <label><input type="radio" name="status" value="a fazer" checked> A Fazer</label>
                                <label><input type="radio" name="status" value="fazendo"> Fazendo</label>
                                <label><input type="radio" name="status" value="pronto"> Pronto</label>
                                <button type="submit">Alterar Status</button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </section>

            <!-- Seção Fazendo -->
            <section>
                <h2>Fazendo</h2>
                <?php foreach ($tarefas as $tarefa) : ?>
                    <?php if ($tarefa['status'] === 'fazendo') : ?>
                        <div class="task-card">
                            <p><strong>Descrição:</strong> <?= htmlspecialchars($tarefa['descricao']); ?></p>
                            <p><strong>Setor:</strong> <?= htmlspecialchars($tarefa['setor']); ?></p>
                            <p><strong>Prioridade:</strong> <?= htmlspecialchars($tarefa['prioridade']); ?></p>
                            <p><strong>Vinculado a:</strong> <?= htmlspecialchars($tarefa['usuario'] ?? 'N/A'); ?></p>
                            <div class="card-actions">
                                <button onclick="location.href='editar_tarefa.php?id=<?= $tarefa['id']; ?>'">Editar</button>
                                <button onclick="location.href='excluir_tarefa.php?id=<?= $tarefa['id']; ?>'">Excluir</button>
                            </div>
                            <form action="alterar_status.php" method="POST">
                                <input type="hidden" name="id" value="<?= $tarefa['id']; ?>">
                                <label><input type="radio" name="status" value="a fazer"> A Fazer</label>
                                <label><input type="radio" name="status" value="fazendo" checked> Fazendo</label>
                                <label><input type="radio" name="status" value="pronto"> Pronto</label>
                                <button type="submit">Alterar Status</button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </section>

            <!-- Seção Pronto -->
            <section>
                <h2>Pronto</h2>
                <?php foreach ($tarefas as $tarefa) : ?>
                    <?php if ($tarefa['status'] === 'pronto') : ?>
                        <div class="task-card">
                            <p><strong>Descrição:</strong> <?= htmlspecialchars($tarefa['descricao']); ?></p>
                            <p><strong>Setor:</strong> <?= htmlspecialchars($tarefa['setor']); ?></p>
                            <p><strong>Prioridade:</strong> <?= htmlspecialchars($tarefa['prioridade']); ?></p>
                            <p><strong>Vinculado a:</strong> <?= htmlspecialchars($tarefa['usuario'] ?? 'N/A'); ?></p>
                            <div class="card-actions">
                                <button onclick="location.href='editar_tarefa.php?id=<?= $tarefa['id']; ?>'">Editar</button>
                                <button onclick="location.href='excluir_tarefa.php?id=<?= $tarefa['id']; ?>'">Excluir</button>
                            </div>
                            <form action="alterar_status.php" method="POST">
                                <input type="hidden" name="id" value="<?= $tarefa['id']; ?>">
                                <label><input type="radio" name="status" value="a fazer"> A Fazer</label>
                                <label><input type="radio" name="status" value="fazendo"> Fazendo</label>
                                <label><input type="radio" name="status" value="pronto" checked> Pronto</label>
                                <button type="submit">Alterar Status</button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </section>
        </div>
    </main>
</body>
</html>
