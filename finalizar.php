<?php
session_start();
include("conexao.php");

if (!isset($_SESSION['usuario_id'])) {
    echo "Você precisa estar logado para finalizar a compra.";
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$pagamento = $_POST['pagamento'];

$sql = "INSERT INTO pedidos (usuario_id, forma_pagamento, data_pedido) VALUES (?, ?, NOW())";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("is", $usuario_id, $pagamento);

if ($stmt->execute()) {
    echo "<h2>Pedido finalizado com sucesso!</h2>";
    echo "<p>Forma de pagamento: <strong>" . htmlspecialchars($pagamento) . "</strong></p>";
    echo "<a href='index.html'>Voltar ao início</a>";
} else {
    echo "Erro ao finalizar pedido: " . $conexao->error;
}

$stmt->close();
$conexao->close();
?>