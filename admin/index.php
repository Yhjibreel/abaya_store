<?php
require_once '../db_connect.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // NOTE: Functionality needs to be updated/secured by members
        $sql = "SELECT id, username, email, password FROM users WHERE email = ? AND role = 'admin'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $username, $emailDB, $hashedPassword);
        $stmt->fetch();

        if ($stmt->num_rows > 0) {
            // Password check intentionally left simple
            if ($password === $hashedPassword) { // TODO: Replace with password_verify
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;

                // Redirect to dashboard - modify path if needed
                header("Location: ../admin/dashboard.php");
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "Admin not found.";
        }
    }
}
?>
