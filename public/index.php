<?php

require __DIR__ . '/../auth/GoogleAuth.php';


$clientId = "clientID";
$clientSecret = "clientSecret";
$redirectUri = "http://localhost/authenticator/public/callback.php"; 

$google = new GoogleAuth($clientId, $clientSecret, $redirectUri);


$googleUrl = $google->getAuthUrl();

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f2f4f7;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .btn-google {
            background: #fff;
            border: 1px solid #ddd;
        }

        .btn-google:hover {
            background: #f5f5f5;
        }

        .google-icon {
            width: 20px;
            margin-right: 8px;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow p-4" style="width: 420px;">

            <h3 class="text-center mb-4">Autenticação</h3>

            <!-- Botão Google REAL -->
            <a href="<?= $googleUrl ?>" class="btn btn-google w-100 mb-3">
                <img src="https://developers.google.com/identity/images/g-logo.png" class="google-icon">
                Entrar com Google
            </a>

            <div class="text-center text-muted mb-3">ou</div>

            <!-- Login normal -->
            <form>
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>

        </div>
    </div>

</body>

</html>
