<?php
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('SEU_CLIENT_ID');
$client->setClientSecret('SEU_CLIENT_SECRET');
$client->setRedirectUri('http://localhost/aurora/google_callback.php');
$client->addScope('email');
$client->addScope('profile');

$authUrl = $client->createAuthUrl();
header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));