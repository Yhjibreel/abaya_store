<?php
require_once 'auth_check.php';

if ($_SESSION['role'] !== 'admin') {
    $_SESSION['error'] = "You don't have permission to access this page";
    header('Location: ../index.php');
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();
?>