<?php
session_start();
require 'config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega o ID do item a ser excluído
    $id_item = $_POST['id'] ?? null;

    if ($id_item) {
        // Preparar a query para excluir o item
        $stmt = $pdo->prepare("DELETE FROM item WHERE id = ?");
        $stmt->execute([$id_item]);
    }

    // Redireciona de volta para a página de inventário
    header('Location: inventario.php');
    exit();
}
