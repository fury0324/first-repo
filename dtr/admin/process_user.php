<?php
require '../db.php';
$name = $_POST['name'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];

$stmt = $conn->prepare("INSERT INTO users (name, username, password, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $username, $password, $role);
$stmt->execute();
header("Location: dashboard.php");
?>
