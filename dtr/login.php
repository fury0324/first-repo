<?php session_start(); ?>
<form method="POST">
  <input name="username" required placeholder="Username"><br>
  <input name="password" type="password" required placeholder="Password"><br>
  <button name="login">Login</button>
</form>

<?php
require 'db.php';

if (isset($_POST['login'])) {
  $u = trim($_POST['username']);
  $p = $_POST['password'];

  // Prepare SQL
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param("s", $u);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if user exists
  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Password verification
    if (password_verify($p, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['username'] = $user['username'];
      header("Location: dashboard.php");
      exit();
    } else {
      echo "<p style='color:red;'>❌ Incorrect password</p>";
    }
  } else {
    echo "<p style='color:red;'>❌ User not found</p>";
  }

  $stmt->close();
  
  if (password_verify($p, $user['password'])) {
    echo "✅ Password matched"; // Debug
    // your session/login code
} else {
    echo "❌ Password mismatch: <br>Entered: $p <br>Hashed: " . $user['password'];
}

}
?>
