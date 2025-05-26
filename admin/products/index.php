<?php
include '../db_connect.php';
include '../auth_check.php';
include '../admin_check.php';
include '../header.php'; // includes the sidebar as well
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
<h2 class="mb-4">All Products</h2>

<a href="add.php" class="btn btn-primary mb-3">+ Add New Product</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price (₦)</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= number_format($row['price'], 2) ?></td>
            <td><?= $row['stock'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php include '../footer.php'; ?>
</body>
</html>
