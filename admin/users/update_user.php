<?php
include '../db_connect.php';
include '../auth_check.php';
include '../admin_check.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted user data
    $id = intval($_POST['id']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);

    // Update user in the database
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $email, $role, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User updated successfully!";
        header("Location: index.php");  // Redirect back to the users page after successful update
    } else {
        $_SESSION['error'] = "Failed to update user: " . $conn->error;
        header("Location: edit_user.php?id=" . $id);  // Redirect back to the edit form if failed
    }

    $stmt->close();
} else {
    header("Location: users.php");  // Redirect if the form wasn't submitted properly
    exit();
}
?>
