<?php 
include  'db_connect.php';
include  'auth_check.php';
include  'admin_check.php';

;

// Check if the user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Redirect to the login page if not an admin
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
        
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <h2><?= 
                        $conn->query("SELECT COUNT(*) FROM orders")->fetch_row()[0] 
                    ?></h2>
                    <a href="orders/index.php" class="text-white">View Orders</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <h2><?= 
                        $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0] 
                    ?></h2>
                    <a href=admin/users/index.php" class="text-white">View Users</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5 class="card-title">Pending Orders</h5>
                    <h2><?= 
                        $conn->query("SELECT COUNT(*) FROM orders WHERE status='pending'")->fetch_row()[0] 
                    ?></h2>
                    <a href="orders/index.php?filter=pending" class="text-dark">View Pending</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Orders</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = $conn->query("
                                SELECT o.order_id, u.username, SUM(p.price * oi.quantity) as total, 
                                o.status, o.order_date 
                                FROM orders o
                                JOIN order_items oi ON o.order_id = oi.order_id
                                JOIN products p ON oi.product_id = p.id
                                JOIN users u ON o.user_id = u.id
                                GROUP BY o.order_id
                                ORDER BY o.order_date DESC
                                LIMIT 5
                            ");
                            
                            while($order = $orders->fetch_assoc()):
                            ?>
                            <tr>
                                <td>#<?= $order['order_id'] ?></td>
                                <td><?= htmlspecialchars($order['username']) ?></td>
                                <td>₦<?= number_format($order['total'], 2) ?></td>
                                <td>
                                    <span class="badge bg-<?= 
                                        $order['status'] == 'pending' ? 'warning' : 
                                        ($order['status'] == 'shipped' ? 'info' : 'success') 
                                    ?>">
                                        <?= ucfirst($order['status']) ?>
                                    </span>
                                </td>
                                <td><?= date('M d, Y', strtotime($order['order_date'])) ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="products/add.php" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i> Add New Product
                        </a>
                        <a href="categories/index.php" class="btn btn-secondary">
                            <i class="fas fa-tags me-2"></i> Manage Categories
                        </a>
                        <a href="orders/index.php" class="btn btn-success">
                            <i class="fas fa-shopping-cart me-2"></i> Process Orders
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5>System Info</h5>
                </div>
                <div class="card-body">
                    <p><strong>PHP Version:</strong> <?= phpversion() ?></p>
                    <p><strong>MySQL Version:</strong> <?= $conn->server_info ?></p>
                    <p><strong>Last Login:</strong> <?= 
                        date('M d, Y H:i', $_SESSION['last_login'] ?? time()) 
                    ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>