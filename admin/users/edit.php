<?php
include '../db_connect.php';
include '../auth_check.php';
include '../admin_check.php';

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Fetch user details
    $stmt = $conn->prepare("SELECT id, username, email, role FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        $_SESSION['error'] = "User not found.";
        header("Location: update_user.php");
        exit();
    }
    $stmt->close();
} else {
    $_SESSION['error'] = "Invalid user ID.";
    header("Location: update_user.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);

    // Update user details
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $email, $role, $user_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User updated successfully!";
        header("Location: update_user.php");
    } else {
        $_SESSION['error'] = "Failed to update user: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>
    <?php include '../header.php'; ?>

    <div class="container">
        <h2>Edit User</h2>

        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }

        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        ?>

<form method="POST" action="update_user.php">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-control" name="role" required>
            <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update User</button>
</form>

    </div>

    <!-- Add your footer here -->
</body>
</html>
