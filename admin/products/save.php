<?php
include '../db_connect.php';
include '../auth_check.php';
include '../admin_check.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $description = trim($_POST['description']);
    $stock = intval($_POST['stock']);

    $image_path = ''; // Changed from $image

    // Check if image was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetDir = _DIR_ . '/../../images/'; // Adjusted to the correct path
        $targetPath = $targetDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image_path = $imageName;
        } else {
            $_SESSION['error'] = "Failed to upload image.";
            header("Location: add.php");
            exit();
        }
    }

    // Insert into DB using correct column name: image_path
    $stmt = $conn->prepare("INSERT INTO products (name, price, description, stock, image_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsis", $name, $price, $description, $stock, $image_path);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Product added successfully!";
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Failed to add product: " . $conn->error;
        header("Location: add.php");
    }

    $stmt->close();
} else {
    header("Location: index.php");
    exit();
}