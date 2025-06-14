<?php
require_once 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    $userId = $_SESSION['user_id'];
    $bookId = $_POST['book_id'];
    
    // Check if book already in cart
    $stmt = $pdo->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND book_id = ?");
    $stmt->execute([$userId, $bookId]);
    $existingItem = $stmt->fetch();
    
    if ($existingItem) {
        // Update quantity
        $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity + 1 WHERE id = ?");
        $stmt->execute([$existingItem['id']]);
    } else {
        // Add new item
        $stmt = $pdo->prepare("INSERT INTO cart (user_id, book_id, quantity) VALUES (?, ?, 1)");
        $stmt->execute([$userId, $bookId]);
    }
    
    header('Location: cart.php');
    exit;
}

header('Location: index.php');
exit;
?>