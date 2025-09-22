<?php
session_start();
require_once 'phpqrcode/qrlib.php'; // Include QR code library
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        #qr_section {
            text-align: center;
            margin: 20px 0;
        }
        #qr_section img {
            width: 220px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <h2>Checkout Summary</h2>

    <?php
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
        echo "<p>Your cart is empty. <a href='index.php'>Go shopping</a>.</p>";
    } else {
        $total = 0;
        echo "<ul>";
        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
            echo "<li><strong>{$item['name']}</strong> — ₹{$item['price']} × {$item['quantity']} = ₹$subtotal</li>";
        }
        echo "</ul>";
        echo "<h3>Total to Pay: ₹$total</h3>";

        // Prepare UPI QR Data
        $upi_id = "9673155623-2@ybl";
        $name = "Sagar Sonawane";
        $note = "E-Commerce Order";

        $upi_data = "upi://pay?pa=$upi_id&pn=" . urlencode($name) .
                    "&am=" . number_format($total, 2, '.', '') .
                    "&cu=INR&tn=" . urlencode($note);

        // Generate and store QR code
        $qr_temp = 'generated_qr.png';
        QRcode::png($upi_data, $qr_temp, 'H', 6);
    ?>

    <form method="post" action="place_order.php">
        <h3>Select Payment Method:</h3>
        <label><input type="radio" name="payment" value="COD" checked> Cash on Delivery</label><br>
        <label><input type="radio" name="payment" value="UPI"> UPI Payment (Scan QR)</label>

        <div id="qr_section" style="display: none;">
            <h4>📱 Scan this QR to Pay ₹<?= $total ?></h4>
            <img src="<?= $qr_temp ?>" alt="UPI QR Code">
            <p>After payment, click <strong>Place Order</strong>.</p>
        </div>

        <button type="submit">✅ Place Order</button>
    </form>

    <?php } ?>
</main>

<?php include 'footer.php'; ?>

<script>
    const radios = document.querySelectorAll('input[name="payment"]');
    const qr = document.getElementById('qr_section');

    radios.forEach(r => {
        r.addEventListener('change', () => {
            qr.style.display = (r.value === 'UPI' && r.checked) ? 'block' : 'none';
        });
    });
</script>

</body>
</html>
