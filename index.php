<?php session_start(); include  'db_connect.php';



// Check if the user is logged in as a user
if ($_SESSION['role'] !== 'user') {
    header("Location: ../auth/login.php");
    exit();
}

echo "Welcome, " . $_SESSION['username'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abaya Shop</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Luxury Abayas</h1>
    
   
    
    <!-- Logout Link (Only if the user is logged in) -->
    <?php if (isset($_SESSION['username'])): ?>
        <a href="../authlogout.php" class="logout-link">Logout</a>
    <?php else: ?>
        <a href="login.php" class="login-link">Loging</a>
    <?php endif; ?>
</header>

    <div class="product-grid">
        <?php
        $result = $conn->query("SELECT * FROM products LIMIT 10");
        while($row = $result->fetch_assoc()):
        ?>
        <div class="product-card">
            <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['name']; ?>">
            <h3><?php echo $row['name']; ?></h3>
            <p><?php echo $row['description']; ?></p>
            <p class="price">₦<?php echo $row['price']; ?></p>
            <form action="add_to_cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <input type="number" name="quantity" value="1" min="1">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
        <?php endwhile; ?>
    </div>

  <footer style="background-color: #222; color: #fff; padding: 20px 0; text-align: center; font-size: 14px;">
    <div style="max-width: 1200px; margin: auto;">
        <p style="margin: 5px 0;">&copy; 2025 <strong>Abaya Shop</strong>. All rights reserved.</p>
        <p style="margin: 5px 0;">
            <a href="../index.php" style="color: #f0c040; text-decoration: none; margin: 0 10px;">Home</a> |
            <a href="../about.php" style="color: #f0c040; text-decoration: none; margin: 0 10px;">About</a> |
            <a href="../contact.php" style="color: #f0c040; text-decoration: none; margin: 0 10px;">Contact</a>
        </p>
        <p style="margin: 5px 0;">Crafted with 💛 by the Abaya Shop Team</p>
    </div>
</footer>

</body>
</html>
