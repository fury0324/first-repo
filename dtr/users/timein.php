<?php
session_start();
require '../db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "❌ Unauthorized access.";
    exit;
}

$uid = $_SESSION['user_id'];
$lat = isset($_POST['lat']) ? floatval($_POST['lat']) : null;
$lng = isset($_POST['lng']) ? floatval($_POST['lng']) : null;

// Basic validation
if ($lat === null || $lng === null) {
    echo "❌ Invalid location data.";
    exit;
}

// Prepare and execute the insert
$stmt = $conn->prepare("INSERT INTO dtr_logs (user_id, action, latitude, longitude) VALUES (?, 'time_in', ?, ?)");
$stmt->bind_param("idd", $uid, $lat, $lng);

if ($stmt->execute()) {
    echo "✅ Time In logged.";
} else {
    echo "❌ Failed to log Time In: " . $stmt->error;
}
