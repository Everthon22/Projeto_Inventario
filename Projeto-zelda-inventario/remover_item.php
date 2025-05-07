<?php
session_start();
require 'config.php';

if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_item = $_POST['id'] ?? null;

    if ($id_item) {
        $stmt = $pdo->prepare("DELETE FROM item WHERE id = ?");
        $stmt->execute([$id_item]);
    }

    header('Location: inventario.php');
    exit();
}
