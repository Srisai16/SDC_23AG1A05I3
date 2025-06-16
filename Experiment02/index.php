<?php
require_once 'db.php';
session_start();

// Sample books data - in a real app you would fetch from database
$stmt = $pdo->query("SELECT * FROM books");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($books)) {
    // Insert sample books if none exist
    $sampleBooks = [
        ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'price' => 9.99, 'image' => 'gatsby.jpg', 'description' => 'A story of wealth, love, and the American Dream'],
        ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee', 'price' => 8.99, 'image' => 'mockingbird.jpg', 'description' => 'A powerful story of racial injustice'],
        ['title' => '1984', 'author' => 'George Orwell', 'price' => 7.99, 'image' => '1984.jpg', 'description' => 'A dystopian novel about totalitarianism'],
        ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen', 'price' => 6.99, 'image' => 'pride.jpg', 'description' => 'A romantic novel of manners']
    ];
    
    foreach ($sampleBooks as $book) {
        $stmt = $pdo->prepare("INSERT INTO books (title, author, price, image, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array_values($book));
    }
    
    // Refetch books
    $stmt = $pdo->query("SELECT * FROM books");
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>FBS eBooks Store</title>
    <style>
        .books-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        
        .book-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            transition: transform 0.3s;
        }
        
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .book-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .book-title {
            font-size: 1.2rem;
            margin: 10px 0 5px;
        }
        
        .book-author {
            color: #666;
            margin-bottom: 10px;
        }
        
        .book-price {
            font-weight: bold;
            color: #2c3e50;
            font-size: 1.1rem;
        }
        
        .add-to-cart {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }
        
        .add-to-cart:hover {
            background-color: #2980b9;
        }
        
        .welcome-message {
            text-align: center;
            margin: 20px 0;
            font-size: 1.2rem;
        }
        
        .logout-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
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
                <a href="index.php" class="active">Home</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="registration.php">Register</a>
                <?php endif; ?>
                <a href="cart.php">Cart</a>
            </div>
        </nav>

        <main>
            <?php if (isset($_SESSION['username'])): ?>
                <div class="welcome-message">
                    Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!
                    <form action="logout.php" method="POST" style="display: inline;">
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            <?php endif; ?>
            
            <div class="books-container">
                <?php foreach ($books as $book): ?>
                    <div class="book-card">
                        <img src="images/<?= htmlspecialchars($book['image']) ?>" alt="<?= htmlspecialchars($book['title']) ?>" class="book-image">
                        <h3 class="book-title"><?= htmlspecialchars($book['title']) ?></h3>
                        <p class="book-author">by <?= htmlspecialchars($book['author']) ?></p>
                        <p class="book-price">$<?= number_format($book['price'], 2) ?></p>
                        <p><?= htmlspecialchars($book['description']) ?></p>
                        
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                                <button type="submit" class="add-to-cart">Add to Cart</button>
                            </form>
                        <?php else: ?>
                            <a href="login.php" class="add-to-cart">Login to Purchase</a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>

        <footer>
            <p>&copy; 2024 FBS eBooks. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>