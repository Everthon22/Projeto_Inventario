<?php
session_start();
require 'config.php';

if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
    exit();
}

// Lista de itens antigos com imagens locais
$item_data = [
    "Espada Mestre" => [
        "desc" => "Uma lâmina lendária capaz de repelir o mal.",
        "img" => "assets1/img1/espada_mestre.jpg"
    ],
    "Escudo Hyliano" => [
        "desc" => "Um escudo resistente com o emblema de Hyrule.",
        "img" => "assets1/img1/escudo.jpeg"
    ],
    "Poção de Vida" => [
        "desc" => "Restaura totalmente sua saúde.",
        "img" => "assets1/img1/porcao.png"
    ]
];

// Processa o formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['item'], $_POST['imagem'])) {
    $novo_item = trim($_POST['item']);
    $imagem_url = trim($_POST['imagem']);

    if (!empty($novo_item)) {
        // Carregar inventário existente
        $itens = file_exists(INVENTARIO_ARQUIVO) ? json_decode(file_get_contents(INVENTARIO_ARQUIVO), true) : [];

        $item_existe = false;

        foreach ($itens as &$item) {
            if ($item['name'] === $novo_item) {
                $item['quantidade'] += 1;
                $item_existe = true;
                break;
            }
        }

        // Se o item não existir, adiciona um novo
        if (!$item_existe) {
            $itens[] = [
                "name" => $novo_item,
                "image" => $item_data[$novo_item]['img'] ?? $imagem_url, // Usa a imagem local se for item antigo
                "desc" => $item_data[$novo_item]['desc'] ?? "Descrição não disponível.",
                "quantidade" => 1
            ];
        }

        file_put_contents(INVENTARIO_ARQUIVO, json_encode($itens));

        header('Location: inventario.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets1/css1/style1.css">
    <style>
        body {
            background: url('https://wallpapercat.com/w/full/6/3/1/904361-3840x2160-desktop-4k-legend-of-zelda-breath-of-the-wild-background-image.jpg');
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
                <label for="imagem" class="form-label text-light">URL da Imagem (Somente para novos itens)</label>
                <input type="url" id="imagem" name="imagem" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
            <a href="inventario.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>
