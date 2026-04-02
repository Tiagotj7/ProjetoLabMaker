<?php
require_once __DIR__ . '/../app/partials/header.php';
require_once __DIR__ . '/../bootstrap/config.php';
?>

<div class="card">
  <h2>Bem-vindo</h2>
  <p style="color:var(--muted)">Escolha uma opção:</p>

  <div class="grid">

    <div class="card">
      <h3>Agendamentos</h3>
      <p style="color:var(--muted)">Alocação do espaço Lab Maker (datas e horários).</p>
      <a class="btn" href="<?= BASE_URL ?>/app/public/booking.php">Ver horários</a>
    </div>

    <div class="card">
      <h3>Solicitações</h3>
      <p style="color:var(--muted)">Criar e acompanhar solicitações em Kanban.</p>
      <a class="btn" href="<?= BASE_URL ?>/app/public/request_home.php">Acessar</a>
    </div>

  </div>
</div>

<?php require_once __DIR__ . '/../app/partials/footer.php'; ?>