<?php
session_start();
require 'config.php';

if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome_item'] ?? '';
    $quantidade = intval($_POST['qtd_item'] ?? 1);
    $img_url = $_POST['img_item'] ?? '';

    if ($nome && $quantidade && $img_url) {
        try {
            $stmt = $pdo->prepare("SELECT id, qtd_item FROM item WHERE LOWER(nome_item) = LOWER(?)");
            $stmt->execute([$nome]);
            $itemExistente = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($itemExistente) {
                $novaQtd = $itemExistente['qtd_item'] + $quantidade;
                $stmt = $pdo->prepare("UPDATE item SET qtd_item = ? WHERE id = ?");
                $stmt->execute([$novaQtd, $itemExistente['id']]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO item (nome_item, qtd_item, img_item) VALUES (?, ?, ?)");
                $stmt->execute([$nome, $quantidade, $img_url]);
            }

            header('Location: inventario.php');
            exit();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar item: " . $e->getMessage();
        }
    } else {
        echo "Todos os campos são obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://i.redd.it/g0upkrt886a91.gif') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 10px;
            color: white;
            max-width: 400px;
            width: 100%;
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
    <div class="form-container">
        <h2 class="text-center">Cadastrar Novo Item</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nome_item" class="form-label">Nome do Item</label>
                <input type="text" name="nome_item" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="qtd_item" class="form-label">Quantidade</label>
                <input type="number" name="qtd_item" class="form-control" required min="1">
            </div>
            <div class="mb-3">
                <label for="img_item" class="form-label">URL da Imagem</label>
                <input type="text" name="img_item" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
        </form>
        <div class="text-center mt-3">
            <a href="inventario.php" class="btn btn-light">Voltar para o Inventário</a>
        </div>
    </div>
</body>
</html>
