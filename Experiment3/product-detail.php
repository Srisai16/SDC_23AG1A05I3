<?php 
$pageTitle = "Product Detail";
include 'includes/header.php'; 
include 'includes/db.php';

// Check if product ID is provided
if(!isset($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$productId = $_GET['id'];

// Get product details
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$productId]);
$product = $stmt->fetch();

if(!$product) {
    header("Location: products.php");
    exit();
}

// Handle add to cart
if(isset($_POST['add_to_cart']) && isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $quantity = $_POST['quantity'] ?? 1;
    
    // Check if item already in cart
    $stmt = $pdo->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$userId, $productId]);
    $cartItem = $stmt->fetch();
    
    if($cartItem) {
        // Update quantity
        $newQuantity = $cartItem['quantity'] + $quantity;
        $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        $stmt->execute([$newQuantity, $cartItem['id']]);
    } else {
        // Add new item
        $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $productId, $quantity]);
    }
    
    header("Location: cart.php");
    exit();
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="images/books/<?php echo htmlspecialchars($product['image_path']); ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($product['title']); ?>">
        </div>
        <div class="col-md-6">
            <h1><?php echo htmlspecialchars($product['title']); ?></h1>
            <p class="text-muted">by <?php echo htmlspecialchars($product['author']); ?></p>
            
            <div class="d-flex align-items-center mb-3">
                <div class="rating me-3">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star-half-alt text-warning"></i>
                </div>
                <a href="#reviews" class="text-primary">124 customer reviews</a>
            </div>
            
            <hr>
            
            <div class="mb-4">
                <h3 class="text-primary">₹<?php echo number_format($product['price'], 2); ?></h3>
                <?php if($product['original_price'] > $product['price']): ?>
                    <span class="text-decoration-line-through text-muted">₹<?php echo number_format($product['original_price'], 2); ?></span>
                    <span class="badge bg-danger ms-2">Save ₹<?php echo number_format($product['original_price'] - $product['price'], 2); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="mb-4">
                <p><?php echo htmlspecialchars($product['description']); ?></p>
            </div>
            
            <div class="mb-4">
                <h5>Details</h5>
                <ul>
                    <li>Format: eBook (PDF, EPUB, MOBI)</li>
                    <li>File Size: 2.5 MB</li>
                    <li>Print Length: 320 pages</li>
                </ul>
            </div>
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <form method="POST" class="mt-4">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <select class="form-select" id="quantity" name="quantity">
                                <?php for($i = 1; $i <= 10; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-9 d-flex align-items-end">
                            <button type="submit" name="add_to_cart" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </form>
            <?php else: ?>
                <div class="alert alert-info mt-4">
                    Please <a href="login.php" class="alert-link">login</a> to add items to your cart.
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="row mt-5" id="reviews">
        <div class="col-12">
            <h3>Customer Reviews</h3>
            <hr>
            
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <h2 class="mb-0">4.7</h2>
                            <div class="rating mb-2">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                            </div>
                            <small class="text-muted">124 global ratings</small>
                        </div>
                        <div