
<?php
//modifique este codigo para conectar no seu banco !!!!!
$host = 'localhost';
$dbname = 'gerenciador_tarefas';
$user = 'root'; // Usuário padrão do Laragon
$password = ''; // Senha padrão do Laragon

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
