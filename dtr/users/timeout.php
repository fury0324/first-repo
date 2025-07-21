<?php
session_start();
require '../db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "❌ Unauthorized access.";
    exit;
}

$uid = $_SESSION['user_id'];
$lat = isset($_POST['lat']) ? floatval($_POST['lat']) : null;
$lng = isset($_POST['lng']) ? floatval($_POST['lng']) : null;

if ($lat === null || $lng === null) {
    echo "❌ Invalid location data.";
    exit;
}

// Optional: Check if user is within the allowed radius
// You can fetch target location here and compare distance
// (If you want this feature, I can help you add that logic too)

// Insert into the database
$stmt = $conn->prepare("INSERT INTO dtr_logs (user_id, action, latitude, longitude) VALUES (?, 'time_out', ?, ?)");
$stmt->bind_param("idd", $uid, $lat, $lng);

if ($stmt->execute()) {
    echo "✅ Time Out logged.";
} else {
    echo "❌ Failed to log Time Out: " . $stmt->error;
}
