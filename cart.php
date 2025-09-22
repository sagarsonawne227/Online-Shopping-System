<?php
session_start();

// Handle quantity update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['action'], $_POST['product_id'])) {
        $product_id = (int)$_POST['product_id'];
        foreach ($_SESSION['cart'] as $key => &$item) {
            if ($item['id'] == $product_id) {
                if ($_POST['action'] === 'increase') {
                    $item['quantity']++;
                } elseif ($_POST['action'] === 'decrease') {
                    $item['quantity']--;
                    if ($item['quantity'] <= 0) {
                        unset($_SESSION['cart'][$key]);
                    }
                } elseif ($_POST['action'] === 'remove') {
                    unset($_SESSION['cart'][$key]);
                }
                break;
            }
        }
        // Re-index array
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
    header("Location: cart.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <h2>Your Shopping Cart</h2>

    <?php
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
        echo "<p>No items in cart.</p>";
    } else {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
            echo "
            <div class='product'>
                <img src='{$item['image']}' width='100'><br>
                <strong>{$item['name']}</strong><br>
                ₹{$item['price']} × {$item['quantity']} = ₹{$subtotal}<br><br>
                <form method='post' style='display:inline'>
                    <input type='hidden' name='product_id' value='{$item['id']}'>
                    <input type='hidden' name='action' value='decrease'>
                    <button type='submit'>−</button>
                </form>
                <form method='post' style='display:inline'>
                    <input type='hidden' name='product_id' value='{$item['id']}'>
                    <input type='hidden' name='action' value='increase'>
                    <button type='submit'>+</button>
                </form>
                <form method='post' style='display:inline'>
                    <input type='hidden' name='product_id' value='{$item['id']}'>
                    <input type='hidden' name='action' value='remove'>
                    <button type='submit'>🗑️ Remove</button>
                </form>
            </div><br><hr>";
        }

        echo "<h3>Total: ₹$total</h3>";
        echo "<a href='checkout.php'><button>Proceed to Checkout</button></a>";

    }
    ?>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
