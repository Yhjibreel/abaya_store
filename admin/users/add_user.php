<?php
include '../db_connect.php';
include '../auth_check.php';
include '../admin_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<?php include '../header.php'; ?>
<form method="POST" action="save_user.php">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-control" name="role" required>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Add User</button>
</form>

</body>
</html>
