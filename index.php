<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - E-commerce Website</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .product {
            width: 220px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            background: #fff;
            transition: transform 0.3s;
        }

        .product:hover {
            transform: scale(1.02);
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .product img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .rating {
            color: #f5c518;
            font-size: 16px;
            margin: 4px 0;
        }

        .description {
            font-size: 13px;
            color: #555;
            margin: 4px 0;
        }

        .payment-mode {
            font-size: 12px;
            color: #007b5e;
            margin-bottom: 8px;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            font-size: 28px;
        }

        form button {
            background-color: #28a745;
            border: none;
            padding: 8px 16px;
            color: white;
            cursor: pointer;
            border-radius: 4px;
        }

        form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <section id="featured-products">
        <h2>Featured Products</h2>
        <div class="product-grid">

        <?php
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="product">
                    <img src="'.$row["image"].'" alt="'.$row["name"].'">
                    <h3>'.$row["name"].'</h3>
                    <div class="rating">'.str_repeat("★", $row["rating"]).str_repeat("☆", 5 - $row["rating"]).'</div>
                    <p class="description">'.$row["description"].'</p>
                    <p><strong>₹'.$row["price"].'</strong></p>
                    <div class="payment-mode">UPI / Card / COD</div>
                    <form method="post" action="add_to_cart.php">
                        <input type="hidden" name="product_id" value="'.$row["id"].'">
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>';
            }
        } else {
            echo "<p>No products available.</p>";
        }
        ?>

        </div>
    </section>
</main>

<?php include 'footer.php'; ?>

<script>
    window.addEventListener("scroll", function () {
        const header = document.querySelector(".site-header");
        if (header) {
            header.classList.toggle("shrink", window.scrollY > 50);
        }
    });
</script>

</body>
</html>
