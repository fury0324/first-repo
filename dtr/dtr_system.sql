CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  username VARCHAR(50) UNIQUE,
  password VARCHAR(255),
  role ENUM('admin', 'technician') NOT NULL
);

-- Insert default admin user (username: steve, password: admin)
INSERT INTO users (name, username, password, role)
VALUES (
  'Default Admin',
  'steve',
  '$2y$10$F.8f3wO0CDTf8SrkBmm3M.nktFKhFZ4QrljvY34ER1i3sZZTdQeQS',  -- hashed 'admin'
  'admin'
);

-- Location table (admin-defined)
CREATE TABLE IF NOT EXISTS locations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  latitude DOUBLE,
  longitude DOUBLE,
  radius INT
);

-- DTR Logs
CREATE TABLE IF NOT EXISTS dtr_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  action ENUM('time_in', 'time_out'),
  log_time DATETIME DEFAULT CURRENT_TIMESTAMP,
  latitude DOUBLE,
  longitude DOUBLE,
  FOREIGN KEY (user_id) REFERENCES users(id)
);
