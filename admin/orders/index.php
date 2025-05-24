<?php
include '../db_connect.php';
include '../auth_check.php';
include '../admin_check.php';

// Optional filter
$statusFilter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Base query
$sql = "
    SELECT o.order_id, u.username, SUM(p.price * oi.quantity) AS total, 
           o.status, o.order_date 
    FROM orders o
    JOIN users u ON o.user_id = u.id
    JOIN order_items oi ON o.order_id = oi.order_id
    JOIN products p ON oi.product_id = p.id
";

// Add status filter if provided
if (!empty($statusFilter)) {
    $sql .= " WHERE o.status = '" . $conn->real_escape_string($statusFilter) . "'";
}

$sql .= " GROUP BY o.order_id ORDER BY o.order_date DESC";

$orders = $conn->query($sql);
?>

<?php include __DIR__ . '/../header.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>
<div class="container-fluid p-4">
    <h2>All Orders</h2>

    <!-- Optional filter buttons -->
    <div class="mb-3">
        <a href="index.php" class="btn btn-outline-primary btn-sm">All</a>
        <a href="index.php?filter=pending" class="btn btn-outline-warning btn-sm">Pending</a>
        <a href="index.php?filter=shipped" class="btn btn-outline-info btn-sm">Shipped</a>
        <a href="index.php?filter=delivered" class="btn btn-outline-success btn-sm">Delivered</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Total (₦)</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($orders && $orders->num_rows > 0): ?>
            <?php while($order = $orders->fetch_assoc()): ?>
                <tr>
                    <td>#<?= $order['order_id'] ?></td>
                    <td><?= htmlspecialchars($order['username']) ?></td>
                    <td><?= number_format($order['total'], 2) ?></td>
                    <td>
                        <span class="badge bg-<?= 
                            $order['status'] == 'pending' ? 'warning' : 
                            ($order['status'] == 'shipped' ? 'info' : 'success') 
                        ?>">
                            <?= ucfirst($order['status']) ?>
                        </span>
                    </td>
                    <td><?= date('M d, Y H:i', strtotime($order['order_date'])) ?></td>
                    <td>
                        <a href="view.php?id=<?= $order['order_id'] ?>" class="btn btn-sm btn-primary">View</a>
                        <a href="edit.php?id=<?= $order['order_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete.php?id=<?= $order['order_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this order?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6" class="text-center">No orders found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../footer.php'; ?>
 
</body>
</html>

