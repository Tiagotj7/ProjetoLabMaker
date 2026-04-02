<?php
require_once __DIR__ . '/../../bootstrap/auth.php';
require_admin();
require_once __DIR__ . '/../partials/header.php';
?>

<div class="card">
  <h2>Painel do Administrador</h2>
  <p style="color:var(--muted)">Olá, <?= e($_SESSION['admin_name'] ?? 'Admin') ?>.</p>

  <div class="grid">
    <a class="card" href="<?= BASE_URL ?>/app/admin/slots.php">
      <h3>Controle de horários</h3>
      <p style="color:var(--muted)">Inserir, editar/remover e ocultar horários (0/1).</p>
      <span class="btn">Gerenciar</span>
    </a>

    <a class="card" href="<?= BASE_URL ?>/app/admin/requests.php">
      <h3>Gerenciar solicitações</h3>
      <p style="color:var(--muted)">Atualizar etapas do Kanban e arquivar (0/1).</p>
      <span class="btn">Abrir</span>
    </a>

    <a class="card" href="<?= BASE_URL ?>/app/admin/bookings.php">
      <h3>Ver reservas</h3>
      <p style="color:var(--muted)">Visualizar quem reservou os horários.</p>
      <span class="btn">Abrir</span>
    </a>

    <a class="card" href="<?= BASE_URL ?>/app/admin/requests_archived.php">
      <h3>Solicitações arquivadas</h3>
      <p style="color:var(--muted)">Visualizar e restaurar itens (is_active=0).</p>
      <span class="btn">Abrir</span>
    </a>

  </div>

  <a class="btn secondary" href="<?= BASE_URL ?>/public/logout.php">Sair</a>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>