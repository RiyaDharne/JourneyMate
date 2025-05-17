<?php
// Sample products (Can be fetched from MySQL later)
$products = [
    ["name" => "Travel Bag", "price" => 1200, "image" => "Bag.webp", "category" => "Accessories"],
    ["name" => "Neck Pillow", "price" => 499, "image" => "pillow.webp", "category" => "Comfort"],
    ["name" => "Power Bank", "price" => 1500, "image" => "powerbank.webp", "category" => "Electronics"],
    ["name" => "Earphones", "price" => 899, "image" => "earphones.webp", "category" => "Electronics"],
    ["name" => "Water Bottle", "price" => 299, "image" => "bottle.webp", "category" => "Accessories"],
];

// Search & Category Filter
$search = isset($_GET['search']) ? strtolower($_GET['search']) : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

$filteredProducts = array_filter($products, function ($product) use ($search, $category) {
    $matchSearch = $search ? strpos(strtolower($product['name']), $search) !== false : true;
    $matchCategory = $category ? $product['category'] == $category : true;
    return $matchSearch && $matchCategory;
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatri Mall</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 0; padding: 0; }
        .navbar { background: #007bff; padding: 10px; color: white; font-size: 20px; }
        .container { max-width: 1000px; margin: auto; padding: 20px; }
        .search-bar { margin: 20px 0; display: flex; justify-content: center; gap: 10px; }
        .search-bar input, .search-bar select, .search-bar button { padding: 10px; font-size: 16px; }
        .product-grid { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
        .product { border: 1px solid #ddd; padding: 15px; border-radius: 10px; width: 200px; text-align: center; }
        .product img { width: 100px; height: 100px; }
        .btn { background-color: green; color: white; padding: 10px; border: none; cursor: pointer; }
        .btn:hover { background-color: darkgreen; }
        .footer { background: #333; color: white; padding: 10px; margin-top: 20px; }
    </style>
</head>
<body>

    <div class="navbar">🚆 Yatri Mall - Your Travel Shopping Partner</div>

    <div class="container">
        <!-- Search & Filter -->
        <form method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Search products..." value="<?= htmlspecialchars($search) ?>">
            <select name="category">
                <option value="">All Categories</option>
                <option value="Accessories" <?= $category == "Accessories" ? "selected" : "" ?>>Accessories</option>
                <option value="Comfort" <?= $category == "Comfort" ? "selected" : "" ?>>Comfort</option>
                <option value="Electronics" <?= $category == "Electronics" ? "selected" : "" ?>>Electronics</option>
            </select>
            <button type="submit">🔍 Search</button>
        </form>

        <!-- Product Listing -->
        <div class="product-grid">
            <?php if (count($filteredProducts) > 0): ?>
                <?php foreach ($filteredProducts as $product): ?>
                    <div class="product">
                        <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                        <h3><?= $product['name'] ?></h3>
                        <p>₹<?= $product['price'] ?></p>
                        <button class="btn">Buy Now</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        © 2025 Yatri Mall | All Rights Reserved | Contact: support@yatrimall.com
    </div>

</body>
</html>
