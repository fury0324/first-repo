<?php
require '../db.php';
$result = $conn->query("SELECT * FROM users");
echo "<h2>User List</h2><ul>";
while ($row = $result->fetch_assoc()) {
  echo "<li>{$row['name']} - {$row['role']}</li>";
}
echo "</ul><a href='dashboard.php'>Back</a>";
?>
