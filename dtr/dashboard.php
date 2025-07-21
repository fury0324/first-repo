<?php
session_start();

if (!isset($_SESSION['role'])) {
  header("Location: login.php");
  exit();
}

if ($_SESSION['role'] === 'admin') {
  header("Location: admin/dashboard.php");
  exit();
} else {
  header("Location: users/dashboard.php");
  exit();
}
?>
