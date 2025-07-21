<?php
session_start();
if ($_SESSION['role'] !== 'admin') exit("Unauthorized.");
?>

<h2>Admin Dashboard</h2>
<ul>
  <li><a href="add_location.php">📍 Set Tagged Location</a></li>
  <li><a href="add_user.php">➕ Add User</a></li>
  <li><a href="users.php">👥 View Users</a></li>
  <li><a href="../logout.php">🚪 Logout</a></li>
</ul>
