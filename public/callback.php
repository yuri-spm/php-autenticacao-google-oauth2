<?php

require __DIR__ . '/../auth/GoogleAuth.php';


$clientId = "clientID";
$clientSecret = "clientSecret";
$redirectUri = "http://localhost/authenticator/public/callback.php"; 

$google = new GoogleAuth($clientId, $clientSecret, $redirectUri);


if (!isset($_GET['code'])) {
    die("Código de autenticação não fornecido pelo Google.");
}

$code = $_GET['code'];

if(empty($code)){
    die("Código de autenticação vazio.");
}


try {
    $tokenData = $google->getAccessToken($code);

    $accessToken = $tokenData['access_token'];

    $userInfo = $google->getUserInfo($accessToken);
} catch (Exception $e) {
    die("Erro ao autenticar com o Google: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Login Google - Sucesso!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow p-4">
            <h3 class="text-center mb-4">Login com Google realizado!</h3>

            <div class="text-center mb-3">
                <img src="<?= $userInfo['picture'] ?>" width="120" class="rounded-circle">
            </div>

            <h4><?= $userInfo['name'] ?></h4>
            <p><strong>Email:</strong> <?= $userInfo['email'] ?></p>

            <a href="login.php" class="btn btn-primary mt-3">Voltar ao Login</a>
        </div>
    </div>

</body>

</html>