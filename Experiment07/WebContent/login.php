<?php
require_once 'db.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    $errors = [];
    
    if (empty($username)) $errors['username'] = 'Username is required';
    if (empty($password)) $errors['password'] = 'Password is required';
    
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: index.php');
            exit;
        } else {
            $errors['general'] = 'Invalid username or password';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login to your FBS eBooks account">
    <link rel="stylesheet" href="./style.css">
    <title>Login - FBS eBooks Store</title>
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
                <a href="login.php" class="active">Login</a>
                <a href="registration.php">Register</a>
                <a href="cart.php">Cart</a>
            </div>
        </nav>

        <main>
            <div class="form-container">
                <h2 class="form-title">Login to Your Account</h2>
                
                <?php if (isset($errors['general'])): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($errors['general']) ?></div>
                <?php endif; ?>
                
                <form method="POST" class="login-form">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" 
                               value="<?= isset($username) ? htmlspecialchars($username) : '' ?>" required>
                        <?php if (isset($errors['username'])): ?>
                            <div class="error-message"><?= htmlspecialchars($errors['username']) ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                        <?php if (isset($errors['password'])): ?>
                            <div class="error-message"><?= htmlspecialchars($errors['password']) ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                    
                    <p class="text-center" style="margin-top: 1rem;">Don't have an account? <a href="registration.php">Register here</a></p>
                    <p class="text-center"><a href="#">Forgot password?</a></p>
                </form>
            </div>
        </main>

        <footer>
            <p>&copy; 2024 FBS eBooks. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>