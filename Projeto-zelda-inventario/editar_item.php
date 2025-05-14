<?php
session_start();
require 'config.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID do item não fornecido.";
    exit();
}

// Conexão com o banco
try {
    $pdo = new PDO('mysql:host=localhost;dbname=inventario', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
    exit();
}

// Buscar o item no banco
$stmt = $pdo->prepare("SELECT * FROM item WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    echo "Item não encontrado.";
    exit();
}

// Atualizar o item
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome_item']);
    $imagem = trim($_POST['img_item']);
    $quantidade = intval($_POST['qtd_item']);

    $update = $pdo->prepare("UPDATE item SET nome_item = ?, img_item = ?, qtd_item = ? WHERE id = ?");
    $update->execute([$nome, $imagem, $quantidade, $id]);

    header("Location: inventario.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://i.redd.it/g0upkrt886a91.gif');
            background-size: cover;
            color: white;
        }
        .form-container {
            background: rgba(0,0,0,0.8);
            max-width: 500px;
            margin: 60px auto;
            padding: 30px;
            border-radius: 10px;
        }
        label {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="text-center">Editar Item</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nome_item" class="form-label">Nome do Item</label>
                <input type="text" class="form-control" name="nome_item" id="nome_item" value="<?php echo htmlspecialchars($item['nome_item']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="img_item" class="form-label">URL da Imagem</label>
                <input type="text" class="form-control" name="img_item" id="img_item" value="<?php echo htmlspecialchars($item['img_item']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="qtd_item" class="form-label">Quantidade</label>
                <input type="number" class="form-control" name="qtd_item" id="qtd_item" value="<?php echo $item['qtd_item']; ?>" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-warning">Salvar Alterações</button>
                <a href="inventario.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
