CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1
);

CREATE TABLE time_slots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date DATE NOT NULL,
  start_time TIME NOT NULL,
  end_time TIME NOT NULL,
  is_available TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  time_slot_id INT NOT NULL,
  requester_name VARCHAR(120) NOT NULL,
  requester_phone VARCHAR(30) NOT NULL,
  people_count INT NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_bookings_time_slot FOREIGN KEY (time_slot_id) REFERENCES time_slots(id)
);

CREATE TABLE requests (
  id INT AUTO_INCREMENT PRIMARY KEY,
  requester_name VARCHAR(120) NOT NULL,
  requester_phone VARCHAR(30) NOT NULL,
  description TEXT NOT NULL,
  technical_specs TEXT NULL,
  attachment_path VARCHAR(255) NULL,
  stage TINYINT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admins(name,email,password_hash,is_active)
VALUES ('Admin', 'admin@lab.com', '$2y$10$COLE_O_HASH', 1);