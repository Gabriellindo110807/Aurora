<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'conexao.php';

$client = new Google_Client();
$client->setClientId('SEU_CLIENT_ID');
$client->setClientSecret('SEU_CLIENT_SECRET');
$client->setRedirectUri('http://localhost/aurora/google_callback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();

    $email = $google_account_info->email;
    $nome = $google_account_info->name;

    // Verificar se o usuário já existe
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 0) {
        // Se não existir, criar novo
        $cpf = '000.000.000-00'; // Placeholder
        $senha_hash = password_hash(uniqid(), PASSWORD_DEFAULT); // Senha aleatória

        $insert = $conexao->prepare("INSERT INTO usuarios (nome, cpf, email, senha) VALUES (?, ?, ?, ?)");
        $insert->bind_param("ssss", $nome, $cpf, $email, $senha_hash);
        $insert->execute();
    }

    $_SESSION['usuario_id'] = $email;
    $_SESSION['nome'] = $nome;

    header("Location: carrinho.html");
    exit;
} else {
    echo "Erro ao autenticar com o Google.";
}
