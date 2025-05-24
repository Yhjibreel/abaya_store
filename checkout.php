<?php session_start(); include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        button.remove-btn {
    background-color: #e3342f;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
}

button.remove-btn:hover {
    background-color: #cc1f1a;
}

    </style>
</head>
<body>
    <header>
        <h1>Checkout</h1>
        <a href="index.php" class="cart-link">Continue Shopping</a>
    </header>

    <div class="checkout-container">
        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <div class="cart-items">
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $product_id => $quantity):
                    $product = $conn->query("SELECT * FROM products WHERE id = $product_id")->fetch_assoc();
                    $subtotal = $product['price'] * $quantity;
                    $total += $subtotal;
                ?>
                <div class="cart-item">
                    <img src="<?php echo $product['image_path']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p>Quantity: <?php echo $quantity; ?></p>
                    <p>Subtotal: ₦<?php echo number_format($subtotal, 2); ?></p>

                    <form action="remove_from_cart.php" method="post" style="margin-top: 10px;">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <button type="submit" style="background-color: red; color: white; padding: 5px 10px; border: none; border-radius: 5px;">Remove</button>
    </form>
                </div>
                <?php endforeach; ?>
                <div class="total">
                    <h3>Total: ₦<?php echo number_format($total, 2); ?></h3>
                </div>
            </div>

            <form action="process_checkout.php" method="post">
                <h2>Customer Information</h2>
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="address" placeholder="Shipping Address" required></textarea>
                <button type="submit">Complete Purchase</button>
            </form>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
</body>
</html>