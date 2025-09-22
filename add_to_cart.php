<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["product_id"])) {
    $product_id = (int)$_POST["product_id"];

    // Fetch product details from DB
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();

    if ($product) {
        $item = [
            "id" => $product["id"],
            "name" => $product["name"],
            "price" => $product["price"],
            "image" => $product["image"],
            "quantity" => 1
        ];

        // Check if cart is already created
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        }

        $found = false;

        // Check if product already in cart
        foreach ($_SESSION["cart"] as &$cart_item) {
            if ($cart_item["id"] == $product_id) {
                $cart_item["quantity"] += 1;
                $found = true;
                break;
            }
        }

        // If not found, add new product to cart
        if (!$found) {
            $_SESSION["cart"][] = $item;
        }

        header("Location: cart.php");
        exit();
    } else {
        echo "Product not found!";
    }
} else {
    echo "Invalid request!";
}
?>
