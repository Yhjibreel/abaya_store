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
<h2 class="mb-4">Add New Product</h2>

<form method="POST" action="save.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" class="form-control" name="name" required>
    </div>
    <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" name="description" required></textarea>
</div>


    <div class="mb-3">
        <label for="price" class="form-label">Price (₦)</label>
        <input type="number" step="0.01" class="form-control" name="price" required>
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" class="form-control" name="stock" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Product Image</label>
        <input type="file" class="form-control" name="image" accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-success">Add Product</button>
</form>

<?php include '../footer.php'; ?>
</body>
</html>
