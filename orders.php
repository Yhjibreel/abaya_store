<?php
// Display all orders for logged-in user
$user_id = $_SESSION['user_id'];
$orders = $conn->query("SELECT * FROM orders WHERE user_id = $user_id ORDER BY order_date DESC");
// Display in a table with order details
?>