<?php
include '../db_connect.php';
include '../auth_check.php';
include '../admin_check.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Optional: First check if product exists
    $check = $conn->query("SELECT * FROM products WHERE id = $id");
    if ($check->num_rows === 0) {
        // Product not found
        header("Location: index.php?error=ProductNotFound");
        exit();
    }

    // Proceed to delete
    $sql = "DELETE FROM products WHERE id = $id";
    if ($conn->query($sql)) {
        header("Location: index.php?success=ProductDeleted");
        exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }
} else {
    header("Location: index.php?error=InvalidID");
    exit();
}
?>