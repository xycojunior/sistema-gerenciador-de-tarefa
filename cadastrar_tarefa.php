<?php
// Conexão com o banco de dados
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = trim($_POST['descricao']);
    $setor = trim($_POST['setor']);
    $usuario_id = $_POST['usuario'];
    $prioridade = $_POST['prioridade'];

    try {
        // Validação básica
        if (empty($descricao) || empty($setor) || empty($usuario_id) || empty($prioridade)) {
            throw new Exception("Todos os campos são obrigatórios.");
        }

        // Inserir no banco de dados
        $stmt = $pdo->prepare("
            INSERT INTO tarefas (descricao, setor, usuario_id, prioridade, status)
            VALUES (:descricao, :setor, :usuario_id, :prioridade, 'a_fazer')
        ");
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':setor', $setor);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->bindParam(':prioridade', $prioridade);
        $stmt->execute();

        // Redirecionar com mensagem de sucesso
        header("Location: cadastro_tarefas.php?sucesso=1");
        exit();
    } catch (Exception $e) {
        // Redirecionar com mensagem de erro
        $erro = urlencode($e->getMessage());
        header("Location: cadastro_tarefas.php?erro=$erro");
        exit();
    }
}
?>
