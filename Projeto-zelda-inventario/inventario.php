<?php
session_start();
require 'config.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
    exit();
}

// Conexão com o banco de dados
try {
    $pdo = new PDO('mysql:host=localhost;dbname=inventario', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
    exit();
}

// Recuperar itens do banco
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

        /* Novo estilo para o botão de excluir */
        .btn-excluir {
            font-size: 12px; /* Tamanho menor */
            padding: 5px 10px; /* Botão menor */
            background-color: transparent; /* Fundo transparente */
            border: 1px solid #dc3545; /* Cor da borda */
            color: #dc3545; /* Cor do texto (vermelho) */
            border-radius: 5px; /* Borda arredondada */
        }

        .btn-excluir:hover {
            background-color: rgba(220, 53, 69, 0.1); /* Cor de fundo ao passar o mouse */
            color: #fff; /* Cor do texto ao passar o mouse */
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
                        <form action="remover_item.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                            <button type="submit" class="btn btn-excluir">Excluir</button>
                        </form>
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
