<?php
require_once __DIR__ . '/../../bootstrap/auth.php';
require_once __DIR__ . '/../../bootstrap/db.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header("Location: " . BASE_URL . "/app/admin/dashboard.php");
  exit;
}

$id = (int)($_POST['id'] ?? 0);
$stmt = $pdo->prepare("UPDATE requests SET is_active=1 WHERE id=?");
$stmt->execute([$id]);

header("Location: " . BASE_URL . "/app/admin/requests_archived.php");
exit;