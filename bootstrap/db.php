<?php
require_once __DIR__ . '/config.php';

try {
  $dsn = "mysql:host=" . DB_HOST . ";port=3306;dbname=" . DB_NAME . ";charset=utf8mb4";
  $pdo = new PDO(
    $dsn,
    DB_USER,
    DB_PASS,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ]
  );
} catch (Exception $e) {
  die("Erro ao conectar no banco: " . $e->getMessage());
}