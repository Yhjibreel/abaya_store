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
<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();
?>

<h2 class="mb-4">Edit Product</h2>

<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    
    <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Price (₦)</label>
        <input type="number" step="0.01" class="form-control" name="price" value="<?= $product['price'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" class="form-control" name="stock" value="<?= $product['stock'] ?>" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Update Product</button>
</form>
<?php include '../footer.php'; ?>
</body>
</html>