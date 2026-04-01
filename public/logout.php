<?php
require_once __DIR__ . '/../bootstrap/config.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
session_destroy();

header("Location: " . BASE_URL . "/public/index.php");
exit;