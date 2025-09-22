<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - E-commerce Website</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <section>
        <h2>All Products</h2>
        <div class="product-grid">
            <!-- Add all your products similarly -->
            <div class="product">
                <img src="assets/product1.jpg" alt="Product 1 - Stylish T-shirt">
                <h3>Product 1</h3>
                <p>$10.00</p>
                <button type="button">Add to Cart</button>
            </div>
            <div class="product">
                <img src="assets/product2.jpg" alt="Product 2 - Wireless Headphones">
                <h3>Product 2</h3>
                <p>$20.00</p>
                <button type="button">Add to Cart</button>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
