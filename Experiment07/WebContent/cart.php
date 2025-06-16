<?php
require_once 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];

// Handle remove from cart
if (isset($_GET['remove']) && is_numeric($_GET['remove'])) {
    $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->execute([$_GET['remove'], $userId]);
    header('Location: cart.php');
    exit;
}

// Handle quantity update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    foreach ($_POST['quantities'] as $cartId => $quantity) {
        if (is_numeric($quantity) && $quantity > 0) {
            $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?");
            $stmt->execute([$quantity, $cartId, $userId]);
        }
    }
    header('Location: cart.php');
    exit;
}

// Get cart items with book details
$stmt = $pdo->prepare("SELECT c.id as cart_id, c.quantity, b.id as book_id, b.title, b.author, b.price, b.image 
                       FROM cart c 
                       JOIN books b ON c.book_id = b.id 
                       WHERE c.user_id = ?");
$stmt->execute([$userId]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
foreach ($cartItems as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Your Cart - FBS eBooks Store</title>
    <style>
        .cart-container {
            padding: 20px;
        }
        
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .cart-table th, .cart-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .cart-table th {
            background-color: #f8f9fa;
        }
        
        .cart-item-image {
            width: 80px;
            height: 100px;
            object-fit: cover;
        }
        
        .quantity-input {
            width: 50px;
            padding: 5px;
            text-align: center;
        }
        
        .remove-btn {
            color: #e74c3c;
            text-decoration: none;
        }
        
        .cart-summary {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
        
        .summary-box {
            border: 1px solid #ddd;
            padding: 20px;
            width: 300px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .checkout-btn {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            margin-top: 10px;
        }
        
        .checkout-btn:hover {
            background-color: #27ae60;
        }
        
        .empty-cart {
            text-align: center;
            padding: 50px;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="header-grid">
                <div class="logo-container">
                    <img src="images/fbslogo.jpg" alt="FBS Logo">
                    <h1>FBS - World's Best Online eBooks Store</h1>
                </div>
            </div>
        </header>

        <nav class="navbar">
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="logout.php">Logout</a>
                <a href="cart.php" class="active">Cart</a>
            </div>
        </nav>

        <main>
            <div class="cart-container">
                <h2>Your Shopping Cart</h2>
                
                <?php if (empty($cartItems)): ?>
                    <div class="empty-cart">
                        <p>Your cart is empty</p>
                        <a href="index.php" class="btn btn-primary">Continue Shopping</a>
                    </div>
                <?php else: ?>
                    <form method="POST" action="cart.php">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cartItems as $item): ?>
                                    <tr>
                                        <td>
                                            <img src="images/<?= htmlspecialchars($item['image']) ?>" 
                                                 alt="<?= htmlspecialchars($item['title']) ?>" 
                                                 class="cart-item-image">
                                            <?= htmlspecialchars($item['title']) ?><br>
                                            by <?= htmlspecialchars($item['author']) ?>
                                        </td>
                                        <td>$<?= number_format($item['price'], 2) ?></td>
                                        <td>
                                            <input type="number" name="quantities[<?= $item['cart_id'] ?>]" 
                                                   value="<?= $item['quantity'] ?>" min="1" class="quantity-input">
                                        </td>
                                        <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                        <td>
                                            <a href="cart.php?remove=<?= $item['cart_id'] ?>" class="remove-btn">Remove</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        
                        <button type="submit" name="update" class="btn btn-primary">Update Cart</button>
                    </form>
                    
                    <div class="cart-summary">
                        <div class="summary-box">
                            <div class="summary-row">
                                <strong>Subtotal:</strong>
                                <span>$<?= number_format($total, 2) ?></span>
                            </div>
                            <div class="summary-row">
                                <strong>Shipping:</strong>
                                <span>FREE</span>
                            </div>
                            <div class="summary-row">
                                <strong>Total:</strong>
                                <span>$<?= number_format($total, 2) ?></span>
                            </div>
                            <button class="checkout-btn">Proceed to Checkout</button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>

        <footer>
            <p>&copy; 2024 FBS eBooks. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>