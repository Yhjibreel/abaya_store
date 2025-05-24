<?php
include '../db_connect.php';
include '../auth_check.php';
include '../admin_check.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $description = trim($_POST['description']);
    $stock = intval($_POST['stock']); // 👈 stock input

    // Update query with stock
    $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, description = ?, stock = ? WHERE id = ?");
    $stmt->bind_param("sdsii", $name, $price, $description, $stock, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Product updated successfully!";
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Error updating product: " . $conn->error;
        header("Location: edit.php?id=" . $id);
    }

    $stmt->close();
} else {
    header("Location: index.php");
    exit();
}
