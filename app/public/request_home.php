<?php
require_once __DIR__ . '/../partials/header.php';
?>

<div class="card">
  <h2>Solicitações</h2>

  <div class="grid">
    <a class="card" href="<?= BASE_URL ?>/app/public/request_board.php">
      <h3>Acompanhar solicitações</h3>
      <p style="color:var(--muted)">Visualização em Kanban por etapas.</p>
      <span class="btn">Abrir Kanban</span>
    </a>

    <a class="card" href="<?= BASE_URL ?>/app/public/request_create.php">
      <h3>Criar nova solicitação</h3>
      <p style="color:var(--muted)">Formulário simples com anexos.</p>
      <span class="btn">Criar</span>
    </a>
  </div>

  <a class="btn secondary" href="<?= BASE_URL ?>/public/index.php">Voltar</a>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>