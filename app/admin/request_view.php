<?php
require_once __DIR__ . '/../../bootstrap/auth.php';
require_once __DIR__ . '/../../bootstrap/db.php';
require_once __DIR__ . '/../../bootstrap/helpers.php';
require_admin();

$requestId = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM requests WHERE id=?");
$stmt->execute([$requestId]);
$req = $stmt->fetch();

require_once __DIR__ . '/../partials/header.php';

if (!$req): ?>
  <div class="error">Solicitação não encontrada.</div>
  <a class="btn secondary" href="<?= BASE_URL ?>/app/admin/requests.php">Voltar</a>
<?php
require_once __DIR__ . '/../partials/footer.php';
exit;
endif;
?>

<div class="card">
  <h2>Detalhes da Solicitação #<?= (int)$req['id'] ?></h2>

  <div class="card">
    <div class="row" style="justify-content:space-between;align-items:center">
      <div>
        <strong>Status:</strong>
        <span class="badge <?= e(stage_badge_class((int)$req['stage'])) ?>">
          <?= e(stage_label((int)$req['stage'])) ?>
        </span>
      </div>
      <div style="color:var(--muted)">
        <strong>Ativa (0/1):</strong> <?= (int)$req['is_active'] ?>
      </div>
    </div>

    <hr>

    <div style="color:var(--muted)">
      <strong>Solicitante:</strong> <?= e($req['requester_name']) ?><br>
      <strong>Celular:</strong> <?= e($req['requester_phone']) ?><br>
      <strong>Criado em:</strong> <?= e($req['created_at']) ?>
    </div>

    <hr>

    <div>
      <strong>Descrição</strong>
      <div style="margin-top:6px;color:var(--muted);white-space:pre-wrap"><?= e($req['description']) ?></div>
    </div>

    <div style="margin-top:12px">
      <strong>Especificações técnicas</strong>
      <div style="margin-top:6px;color:var(--muted);white-space:pre-wrap">
        <?= e($req['technical_specs'] ?? '—') ?>
      </div>
    </div>

    <div style="margin-top:12px">
      <strong>Anexo</strong><br>
      <?php if (!empty($req['attachment_path'])): ?>
        <a href="<?= BASE_URL ?>/<?= e($req['attachment_path']) ?>" target="_blank">Abrir anexo</a>
      <?php else: ?>
        <span style="color:var(--muted)">—</span>
      <?php endif; ?>
    </div>
  </div>

  <a class="btn secondary" href="<?= BASE_URL ?>/app/admin/requests.php">Voltar</a>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>