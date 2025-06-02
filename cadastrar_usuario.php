<?php
include("conexao.php");

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome, cpf, email, senha) VALUES (?, ?, ?, ?)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("ssss", $nome, $cpf, $email, $senha);

if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso! <a href='login.html'>Entrar</a>";
} else {
    echo "Erro ao cadastrar: " . $conexao->error;
}

$stmt->close();
$conexao->close();
?>