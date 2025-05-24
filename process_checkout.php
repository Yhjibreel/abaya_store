<?php
session_start();
include  'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['cart'])) {
    // Validate inputs
    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['address'])) {
        die("All fields are required");
    }

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);

    // Start transaction
    $conn->begin_transaction();

    try {
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $stmt = $conn->prepare("INSERT INTO orders (product_id, quantity, customer_name, customer_email, customer_address) 
                                  VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iisss", $product_id, $quantity, $name, $email, $address);
            $stmt->execute();
            $stmt->close();
        }
        
        $conn->commit();
        unset($_SESSION['cart']);
        header('Location: thank_you.php');
        exit();
        
    } catch (Exception $e) {
        $conn->rollback();
        die("Error processing order: " . $e->getMessage());
    }
}
?>