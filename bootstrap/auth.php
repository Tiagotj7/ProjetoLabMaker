<?php
require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

function is_admin(): bool {
  return isset($_SESSION['admin_id']) && (int)$_SESSION['admin_id'] > 0;
}

function require_admin(): void {
  if (!is_admin()) {
    header("Location: " . BASE_URL . "/app/admin/login.php");
    exit;
  }
}