<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($usuario === USUARIO && $senha === SENHA) {
        $_SESSION['logado'] = true;
        header('Location: inventario.php');
        exit();
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://giffiles.alphacoders.com/476/47687.gif') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2);
            text-align: center;
            width: 100%;
            max-width: 350px;
        }
        .form-control, .btn {
            border-radius: 5px;
        }
        .btn-primary {
            background: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-light">Login</h2>
        <?php if (isset($erro)) { ?>
            <p class="text-danger"><?php echo $erro; ?></p>
        <?php } ?>
        <form method="POST">
            <div class="mb-3">
                <input type="text" name="usuario" class="form-control" placeholder="Usuário" required>
            </div>
            <div class="mb-3">
                <input type="password" name="senha" class="form-control" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
</body>
</html>
