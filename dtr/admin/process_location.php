<?php
require '../db.php';
$n = $_POST['name'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$r = $_POST['radius'];

$stmt = $conn->prepare("INSERT INTO locations (name, latitude, longitude, radius) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sddi", $n, $lat, $lng, $r);
$stmt->execute();
header("Location: dashboard.php");
?>
