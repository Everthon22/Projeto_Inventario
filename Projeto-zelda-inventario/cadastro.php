<?php
session_start();
require 'config.php';

if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['item'], $_POST['imagem'])) {
    $nome_item = trim($_POST['item']);
    $imagem_url = trim($_POST['imagem']);

    if (!empty($nome_item)) {
        $stmt = $pdo->prepare("SELECT * FROM item WHERE nome_item = ?");
        $stmt->execute([$nome_item]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            $pdo->prepare("UPDATE item SET qtd_item = qtd_item + 1 WHERE id = ?")->execute([$item['id']]);
        } else {
            $img_blob = file_get_contents($imagem_url);
            $stmt = $pdo->prepare("INSERT INTO item (nome_item, qtd_item, img_item) VALUES (?, 1, ?)");
            $stmt->bindParam(1, $nome_item);
            $stmt->bindParam(2, $img_blob, PDO::PARAM_LOB);
            $stmt->execute();
        }

        header('Location: inventario.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://wallpapercat.com/w/full/6/3/1/904361-3840x2160-desktop-4k-legend-of-zelda-breath-of-the-wild-background-image.jpg') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center text-light">Adicionar Novo Item</h2>
        <form method="POST" action="cadastro.php">
            <div class="mb-3">
                <label for="item" class="form-label text-light">Nome do Item</label>
                <input type="text" id="item" name="item" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="imagem" class="form-label text-light">URL da Imagem</label>
                <input type="url" id="imagem" name="imagem" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
            <a href="inventario.php" class="btn btn-secondary">Ver Inventário</a>
        </form>
    </div>
</body>
</html>
