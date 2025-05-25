<?php
require_once '../db_connect.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Both fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $sql = "SELECT id, username, email, password, role FROM users WHERE email = ? AND role = 'user'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $username, $emailconn, $hashedPassword, $role);
        $stmt->fetch();

        if ($stmt->num_rows > 0 && password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $emailconn;
            $_SESSION['role'] = $role;

            header("Location: ../index.php");
            exit();
        } else {
            $error = "Invalid user credentials.";
        }
    }
}
?>

<!-- Used same HTML but change title to "User Login" and heading texts -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Abaya Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-left">
            <div>
                <h1>Welcome Back!</h1>
                <p>Login to manage your abaya store.</p>
                <img src="../assets/images/login-illustration.svg" alt="Login Illustration" style="max-width: 300px;">
            </div>
        </div>
        
        <div class="auth-right">
            <div class="auth-card">
                <div class="auth-header">
                    <h2><i class="fas fa-sign-in-alt"></i> Login</h2>
                </div>

                <?php if ($error): ?>
                <div class="error-message">
                    <?= $error ?>
                </div>
                <?php endif; ?>

                <div class="auth-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="password"><i class="fas fa-key"></i> Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn-auth">Login</button>
                    </form>
                </div>
                
                <div class="auth-footer">
                    <p>Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
