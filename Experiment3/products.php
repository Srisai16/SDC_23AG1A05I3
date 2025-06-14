<?php 
$pageTitle = "Browse Books";
include 'includes/header.php'; 
include 'includes/db.php';

// Get category filter if set
$category = isset($_GET['category']) ? $_GET['category'] : null;
$search = isset($_GET['search']) ? $_GET['search'] : null;

// Build SQL query
$sql = "SELECT * FROM products WHERE 1=1";
$params = [];

if($category) {
    $sql .= " AND category = ?";
    $params[] = $category;
}

if($search) {
    $sql .= " AND (title LIKE ? OR author LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

// Add sorting
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'title';
$order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

$validSorts = ['title', 'author', 'price', 'created_at'];
$sort = in_array($sort, $validSorts) ? $sort : 'title';
$order = $order === 'DESC' ? 'DESC' : 'ASC';

$sql .= " ORDER BY $sort $order";

// Execute query
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Filters</h5>
                </div>
                <div class="card-body">
                    <form method="GET">
                        <div class="mb-3">
                            <label class="form-label">Search</label>
                            <input type="text" name="search" class="form-control" value="<?php echo htmlspecialchars($search ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select">
                                <option value="">All Categories</option>
                                <option value="programming" <?php echo ($category == 'programming') ? 'selected' : ''; ?>>Programming</option>
                                <option value="business" <?php echo ($category == 'business') ? 'selected' : ''; ?>>Business</option>
                                <option value="self-help" <?php echo ($category == 'self-help') ? 'selected' : ''; ?>>Self-Help</option>
                                <option value="romance" <?php echo ($category == 'romance') ? 'selected' : ''; ?>>Romance</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sort By</label>
                            <select name="sort" class="form-select">
                                <option value="title" <?php echo ($sort == 'title') ? 'selected' : ''; ?>>Title</option>
                                <option value="author" <?php echo ($sort == 'author') ? 'selected' : ''; ?>>Author</option>
                                <option value="price" <?php echo ($sort == 'price') ? 'selected' : ''; ?>>Price</option>
                                <option value="created_at" <?php echo ($sort == 'created_at') ? 'selected' : ''; ?>>Newest</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Order</label>
                            <select name="order" class="form-select">
                                <option value="ASC" <?php echo ($order == 'ASC') ? 'selected' : ''; ?>>Ascending</option>
                                <option value="DESC" <?php echo ($order == 'DESC') ? 'selected' : ''; ?>>Descending</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        <a href="products.php" class="btn btn-outline-secondary w-100 mt-2">Reset</a>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">
                    <?php 
                    if($category) {
                        echo ucfirst($category) . " Books";
                    } elseif($search) {
                        echo "Search Results for '$search'";
                    } else {
                        echo "All Books";
                    }
                    ?>
                </h2>
                <span class="text-muted"><?php echo count($products); ?> items</span>
            </div>
            
            <?php if(empty($products)): ?>
                <div class="alert alert-info">
                    No books found matching your criteria.
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach($products as $product): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="images/books/<?php echo htmlspecialchars($product['image_path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['title']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($product['title']); ?></h5>
                                    <p class="text-muted">by <?php echo htmlspecialchars($product['author']); ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-bold text-primary">₹<?php echo number_format($product['price'], 2); ?></span>
                                            <?php if($product['original_price'] > $product['price']): ?>
                                                <span class="text-decoration-line-through text-muted ms-2">₹<?php echo number_format($product['original_price'], 2); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-outline-primary">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>