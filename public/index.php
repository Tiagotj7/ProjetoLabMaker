<?php
require_once __DIR__ . '/../app/partials/header.php';
require_once __DIR__ . '/../bootstrap/config.php';
?>

<div class="card">
  <h2>Bem-vindo</h2>
  <p style="color:var(--muted)">Escolha uma opção:</p>

  <div class="grid">
    <a class="card" href="<?= BASE_URL ?>/app/public/booking.php">
      <h3>Agendamentos</h3>
      <p style="color:var(--muted)">Alocação do espaço Lab Maker (datas e horários).</p>
      <span class="btn">Ver horários</span>
    </a>

    <a class="card" href="<?= BASE_URL ?>/app/public/request_home.php">
      <h3>Solicitações</h3>
      <p style="color:var(--muted)">Criar e acompanhar solicitações em Kanban.</p>
      <span class="btn">Acessar</span>
    </a>
  </div>
</div>

<?php require_once __DIR__ . '/../app/partials/footer.php'; ?>