<?php
include 'db.php';
$orderDetails = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = (int)$_POST['order_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($order = $result->fetch_assoc()) {
        $orderDetails = "
            <h3>Order ID: #{$order['id']}</h3>
            <p>Date: {$order['order_date']}</p>
            <pre>{$order['items']}</pre>
            <strong>Total: ₹{$order['total']}</strong>
        ";
    } else {
        $orderDetails = "<p>❌ Order not found. Please check the ID.</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Track Order</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <h2>Track Your Order</h2>
    <form method="post">
        <label>Enter Order ID:</label>
        <input type="number" name="order_id" required>
        <button type="submit">Track</button>
    </form>

    <div style="margin-top: 20px;">
        <?= $orderDetails ?>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
