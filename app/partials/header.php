<?php
require_once __DIR__ . '/../../bootstrap/config.php';
require_once __DIR__ . '/../../bootstrap/auth.php';
require_once __DIR__ . '/../../bootstrap/helpers.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Lab Maker</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/style.css">
</head>
<body>
  <div class="container">
    <div class="topbar">
      <div class="brand">
        <a href="<?= BASE_URL ?>/public/index.php">Lab Maker</a>
      </div>
      <div class="row">
        <?php if (is_admin()): ?>
          <a class="btn secondary" href="<?= BASE_URL ?>/app/admin/dashboard.php">Painel</a>
          <a class="btn secondary" href="<?= BASE_URL ?>/public/logout.php">Sair</a>
        <?php else: ?>
          <a class="btn secondary" href="<?= BASE_URL ?>/app/admin/login.php">Admin</a>
        <?php endif; ?>
      </div>
    </div>