<?php
session_start();
include 'db.php';  // connect to database

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    header("Location: cart.php");
    exit();
}

// Prepare order data
$total = 0;
$orderItems = [];

foreach ($_SESSION['cart'] as $item) {
    $subtotal = $item['price'] * $item['quantity'];
    $total += $subtotal;
    $orderItems[] = "{$item['name']} × {$item['quantity']} = ₹$subtotal";
}

$orderText = implode("\n", $orderItems);

// Save to `orders` table
$stmt = $conn->prepare("INSERT INTO orders (items, total) VALUES (?, ?)");
$stmt->bind_param("si", $orderText, $total);
$stmt->execute();
$order_id = $stmt->insert_id;
$stmt->close();

// Clear cart
$_SESSION['cart'] = [];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Placed</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <h2>🎉 Order Placed Successfully!</h2>
    <p>Your Order ID is: <strong>#<?= $order_id ?></strong></p>
    <p>Thank you for shopping with us.</p>
    <a href="track_order.php"><button>Track Your Order</button></a>
    <a href="index.php"><button>Back to Home</button></a>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
