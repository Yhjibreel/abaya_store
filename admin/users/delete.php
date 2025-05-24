<?php
include '../db_connect.php';
include '../auth_check.php';
include '../admin_check.php';

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Delete the user
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User deleted successfully!";
    } else {
        $_SESSION['error'] = "Failed to delete user: " . $conn->error;
    }

    $stmt->close();
} else {
    $_SESSION['error'] = "Invalid user ID.";
}

header("Location: users.php");
exit();
