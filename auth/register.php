<?php
require_once '../db_connect.php';
session_start();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $role = 'user'; // Getting the role from the form

    // Validate inputs
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // ✅ Add the role to the SQL query
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role); // Bind role to the query
            if ($stmt->execute()) {
                header("Location: login.php?signup=success");
                exit();
            } else {
                $error = "Signup failed. Please try again.";
            }
        } else {
            $error = "Database error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Abaya Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-left">
            <div>
                <h1>Join Us!</h1>
                <p>Create an account to manage your own abaya store..</p>
                <img src="../assets/images/register-illustration.svg" alt="Register Illustration" style="max-width: 300px;">
            </div>
        </div>
        
        <div class="auth-right">
            <div class="auth-card">
                <div class="auth-header">
                    <h2><i class="fas fa-user-plus"></i> Create Account</h2>
                </div>
                
                <?php if ($error): ?>
                <div class="error-message">
                    <?= $error ?>
                </div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                <div class="success-message">
                    <?= $success ?>
                </div>
                <?php endif; ?>
                
                <div class="auth-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="username"><i class="fas fa-user"></i> Username</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="password"><i class="fas fa-key"></i> Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        
                        <!-- Add a role selection field -->
                       

                        <button type="submit" class="btn-auth">Register</button>
                    </form>
                </div>
                
                <div class="auth-footer">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>