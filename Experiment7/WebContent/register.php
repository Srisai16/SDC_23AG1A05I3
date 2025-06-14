<?php
require_once 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    
    // Validate inputs
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = $_POST['gender'];
    $languages = isset($_POST['languages']) ? implode(',', $_POST['languages']) : '';
    $address = trim($_POST['address']);
    
    // Validation checks
    if (empty($username)) $errors['username'] = 'Username is required';
    if (empty($password)) $errors['password'] = 'Password is required';
    if (empty($email)) $errors['email'] = 'Email is required';
    if (empty($phone)) $errors['phone'] = 'Phone is required';
    if (empty($gender)) $errors['gender'] = 'Gender is required';
    if (empty($languages)) $errors['languages'] = 'At least one language is required';
    if (empty($address)) $errors['address'] = 'Address is required';
    
    if (strlen($username) < 6) $errors['username'] = 'Username must be at least 6 characters';
    if (strlen($password) < 8) $errors['password'] = 'Password must be at least 8 characters';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Invalid email format';
    if (!preg_match('/^\d{10}$/', $phone)) $errors['phone'] = 'Phone must be 10 digits';
    
    // Check if username or email exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->fetch()) $errors['general'] = 'Username or email already exists';
    
    if (empty($errors)) {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email, phone, gender, languages, address) 
                              VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$username, $hashedPassword, $email, $phone, $gender, $languages, $address]);
        
        $_SESSION['success'] = 'Registration successful! Please login.';
        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Create your FBS eBooks account">
    <link rel="stylesheet" href="./style.css">
    <title>Register - FBS eBooks Store</title>
    <style>
        /* Your existing registration styles here */
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Your existing header and nav -->
        
        <main>
            <div class="form-container">
                <h2 class="form-title">Create Your Account</h2>
                
                <?php if (isset($errors['general'])): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($errors['general']) ?></div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
                
                <form method="POST" id="registrationForm" class="login-form">
                    <!-- Your existing form fields with PHP value preservation -->
                    <!-- Example for username field: -->
                    <div class="form-group">
                        <label for="username" class="required-field">Username</label>
                        <input type="text" id="username" name="username" class="form-control" 
                               value="<?= isset($username) ? htmlspecialchars($username) : '' ?>" required>
                        <?php if (isset($errors['username'])): ?>
                            <div class="error-message"><?= htmlspecialchars($errors['username']) ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Other form fields similarly -->
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Register</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                    
                    <p class="text-center" style="margin-top: 1rem;">Already have an account? <a href="login.php">Login here</a></p>
                </form>
            </div>
        </main>

        <!-- Your existing footer -->
    </div>

    <script>
        // Your existing JavaScript validation
    </script>
</body>
</html>