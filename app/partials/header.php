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

  <link rel="apple-touch-icon" sizes="180x180" href="public/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="public/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="public/img/favicon-16x16.png">
  <link rel="manifest" href="public/img/site.webmanifest">

</head>

<link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/style.css">
<script defer src="<?= BASE_URL ?>/public/assets/theme.js"></script>
<meta name="color-scheme" content="dark light">

<body>
  <div class="container">
    <div class="topbar">
      <div class="brand">
        <a href="<?= BASE_URL ?>/public/index.php">Lab Maker</a>
      </div>
      <div class="row">
        <div class="theme-toggle" aria-label="Alternar tema">
          <label class="theme-switch" title="Alternar tema claro/escuro">
            <input id="themeToggle" type="checkbox" aria-label="Alternar tema claro/escuro">
            <span class="moon">🌙</span> <!--  --- IGNORE --->
            <span class="slider"></span>
            <span class="sun">☀️</span> <!-- --- IGNORE --->
          </label>
        </div>
        <?php if (is_admin()): ?>
          <a class="btn secondary" href="<?= BASE_URL ?>/app/admin/dashboard.php">Painel</a>
          <a class="btn secondary" href="<?= BASE_URL ?>/public/logout.php">Sair</a>
        <?php else: ?>
          <a class="btn secondary" href="<?= BASE_URL ?>/app/admin/login.php">Admin</a>
        <?php endif; ?>
      </div>
    </div>