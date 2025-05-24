<?php
include '../db_connect.php';
include '../auth_check.php';
include '../admin_check.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User added successfully!";
        header("Location: index.php");  // Redirect to the user list after successful insertion
    } else {
        $_SESSION['error'] = "Failed to add user: " . $conn->error;
        header("Location: add_user.php");  // Redirect back to the add form if failed
    }

    $stmt->close();
} else {
    header("Location: index.php");  // Redirect if the form wasn't submitted properly
    exit();
}
