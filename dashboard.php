<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<link rel="stylesheet" href="style.css">
<form>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <p>This is your dashboard.</p>
    <a href="logout.php"><button type="button">Logout</button></a>
</form>
