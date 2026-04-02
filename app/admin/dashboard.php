<?php
require_once __DIR__ . '/../../bootstrap/auth.php';
require_admin();
require_once __DIR__ . '/../partials/header.php';
?>

<div class="card">
  <h2>Painel do Administrador</h2>
  <p style="color:var(--muted)">Olá, <?= e($_SESSION['admin_name'] ?? 'Admin') ?>.</p>

  <div class="grid">

    <div class="card">
      <h3>Controle de horários</h3>
      <p style="color:var(--muted)">Inserir, editar/remover e ocultar horários (0/1).</p>
      <a class="btn" href="<?= BASE_URL ?>/app/admin/slots.php">Gerenciar</a>
    </div>

    <div class="card">
      <h3>Ver reservas</h3>
      <p style="color:var(--muted)">Visualizar quem reservou os horários.</p>
      <a class="btn" href="<?= BASE_URL ?>/app/admin/bookings.php">Abrir</a>
    </div>

    <div class="card">
      <h3>Gerenciar solicitações</h3>
      <p style="color:var(--muted)">Atualizar etapas do Kanban e arquivar (0/1).</p>
      <a class="btn" href="<?= BASE_URL ?>/app/admin/requests.php">Abrir</a>
    </div>

    <div class="card">
      <h3>Solicitações arquivadas</h3>
      <p style="color:var(--muted)">Visualizar e restaurar itens (is_active=0).</p>
      <a class="btn" href="<?= BASE_URL ?>/app/admin/requests_archived.php">Abrir</a>
    </div>

  </div>

</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>