<?php
// Conexão com o banco de dados
require_once 'db.php'; // Arquivo de configuração do banco

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    try {
        // Validar se os campos foram preenchidos
        if (empty($nome) || empty($email)) {
            throw new Exception("Todos os campos são obrigatórios.");
        }

        // Inserir no banco de dados
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:nome, :email)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Redirecionar com mensagem de sucesso
        header("Location: cadastro_usuarios.php?sucesso=1");
        exit();
    } catch (Exception $e) {
        // Redirecionar com mensagem de erro
        $erro = urlencode($e->getMessage());
        header("Location: cadastro_usuarios.php?erro=$erro");
        exit();
    }
}
?>
