<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit();
}
require 'db.php';

// Fetch active location from DB
$location = null;
$sql = "SELECT * FROM locations LIMIT 1";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $location = $result->fetch_assoc();
}
?>
