<?php
session_start();
require 'config.php';

if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
    exit();
}

// Lista de itens fixos com imagens locais
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

// Carregar inventário salvo
$itens = file_exists(INVENTARIO_ARQUIVO) ? json_decode(file_get_contents(INVENTARIO_ARQUIVO), true) : [];

// Criar um array associativo para evitar duplicatas
$inventario_assoc = [];
foreach ($itens as $item) {
    $inventario_assoc[$item['name']] = $item;
}

// Garantir que os itens fixos estejam no inventário sem duplicação
foreach ($item_data as $nome => $info) {
    if (!isset($inventario_assoc[$nome])) {
        $inventario_assoc[$nome] = [
            "name" => $nome,
            "image" => $info['img'],
            "desc" => $info['desc'],
            "quantidade" => 1
        ];
    }
}

// Converter de volta para lista de itens
$itens = array_values($inventario_assoc);

// Responder com JSON para AJAX
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['json'])) {
    header('Content-Type: application/json');
    echo json_encode($itens);
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Inventário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets1/css1/style1.css">
    <style>
        body {
            background: url('https://i.redd.it/g0upkrt886a91.gif');
            background-size: cover;
        }
        .inventory-container {
            background-color: #000;
            padding: 25px 45px;
            min-height: 300px;
            max-width: 450px;
            margin: 50px auto;
            overflow-y: auto;
            border-radius: 10px;
            border: 3px solid #222;
            text-align: center;
        }
        .inventory-grid {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            background: rgba(13, 26, 15, 0.8);
            padding: 10px;
            border-radius: 5px;
            min-height: 150px;
        }
        .inventory-item {
            width: 80px;
            height: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid white;
            border-radius: 8px;
            position: relative;
        }
        .item-image {
            width: 70%;
            height: auto;
            object-fit: contain;
        }
        .item-quantity {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 2px 5px;
            border-radius: 5px;
            font-size: 14px;
        }
        .inventory-title {
            color: white;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="inventory-container">
            <div class="inventory-title">Inventário</div>
            <div class="inventory-grid">
                <?php foreach ($itens as $item) { ?>
                    <div class="inventory-item">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="Item" class="item-image">
                        <span class="item-quantity"><?php echo $item['quantidade']; ?></span>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="cadastro.php" class="btn btn-primary">Adicionar Novo Item</a>
        </div>
    </div>
</body>
</html>
