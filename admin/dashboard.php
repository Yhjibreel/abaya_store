<?php 
include 'db_connect.php';
include 'auth_check.php';
include 'admin_check.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

echo "Welcome to the Admin Dashboard, " . $_SESSION['username'];
?>

<?php include __DIR__ . '/header.php'; ?>

<div class="container-fluid p-4">
    <h2 class="mb-4">Dashboard Overview</h2>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <h2><?= 
                        $conn->query("SELECT COUNT(*) FROM products")->fetch_row()[0] 
                    ?></h2>
                    <a href="products/index.php" class="text-white">View Products</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
