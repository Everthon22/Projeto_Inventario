<?php
session_start();
require 'config.php';

if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
    exit();
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=inventario', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
    exit();
}

$query = "SELECT * FROM item";
$stmt = $pdo->query($query);
$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Inventário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://i.redd.it/g0upkrt886a91.gif') no-repeat center center fixed;
            background-size: cover;
        }

        .inventory-container {
            background-color: #000;
            padding: 25px 45px;
            max-width: 600px;
            margin: 50px auto;
            overflow-y: auto;
            border-radius: 10px;
            border: 3px solid #222;
            text-align: center;
            color: white;
        }

        .inventory-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
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
            width: 100px;
            height: 140px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid white;
            border-radius: 8px;
            position: relative;
            padding: 5px;
        }

        .item-image {
            width: 70%;
            height: 70px;
            object-fit: contain;
        }

        .item-quantity {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 2px 5px;
            border-radius: 5px;
            font-size: 14px;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 4px;
            flex-wrap: wrap;
            margin-top: 6px;
        }

        .button-group form {
            display: inline-block;
        }

        .button-group .btn {
            font-size: 11px;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .btn-excluir {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn-excluir:hover {
            background-color: #b52a37;
        }

        .btn-editar {
            background-color: #28a745;
            color: white;
            border: none;
        }

        .btn-editar:hover {
            background-color: #1e7e34;
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
                        <img src="<?php echo htmlspecialchars($item['img_item']); ?>" alt="Item" class="item-image">
                        <span class="item-quantity"><?php echo $item['qtd_item']; ?></span>
                        <div class="button-group">
                            <form action="remover_item.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                <button type="submit" class="btn btn-excluir">Excluir</button>
                            </form>
                            <form action="editar_item.php" method="GET">
                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                <button type="submit" class="btn btn-editar">Editar</button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="text-center mt-3">
                <a href="cadastro.php" class="btn btn-primary">Adicionar Novo Item</a>
            </div>
        </div>
    </div>
</body>
</html>
