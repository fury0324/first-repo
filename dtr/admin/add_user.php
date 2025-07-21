<form method="POST" action="process_user.php">
  Name: <input name="name" required><br>
  Username: <input name="username" required><br>
  Password: <input name="password" required><br>
  Role:
  <select name="role">
    <option value="technician">Technician</option>
    <option value="admin">Admin</option>
  </select><br>
  <button>Add User</button>
</form>
