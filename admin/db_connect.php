<?php
$host = "localhost";
$user = "root";
$password = "";
$connname = "abayastore";

$conn = new mysqli($host, $user, $password, $connname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>