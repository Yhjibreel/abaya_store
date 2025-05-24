<?php
include '../db_connect.php';
include '../auth_check.php';
include '../admin_check.php';

// Fetch all registered users from the database
$query = "SELECT id, username, email, role, created_at FROM users";
$result = $conn->query($query);

if (!$result) {
    $_SESSION['error'] = "Failed to fetch users: " . $conn->error;
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>
    <?php include '../header.php'; ?>

    <div class="container">
        <h2>Registered Users</h2>
        <a href="add_user.php" class="btn btn-primary mb-3">+ Add New User</a>

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

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registered On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td><?php echo $user['created_at']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php include '../footer.php'; ?>
</body>
</html>
