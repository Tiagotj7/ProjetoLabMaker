<?php
require_once __DIR__ . '/../../bootstrap/auth.php';
require_once __DIR__ . '/../../bootstrap/db.php';
require_once __DIR__ . '/../../bootstrap/helpers.php';
require_admin();

$stmt = $pdo->query("SELECT * FROM requests WHERE is_active=0 ORDER BY created_at DESC");
$items = $stmt->fetchAll();

require_once __DIR__ . '/../partials/header.php';
?>

<div class="card">
  <h2>Solicitações arquivadas</h2>
  <p style="color:var(--muted)">Itens com is_active=0.</p>

  <?php if (!$items): ?>
    <div class="notice">Nenhuma solicitação arquivada.</div>
  <?php else: ?>
    <?php foreach ($items as $it): ?>
      <div class="card">
        <div class="row" style="justify-content:space-between;align-items:center">
          <div>
            <strong>#<?= (int)$it['id'] ?></strong>
            <span class="badge <?= e(stage_badge_class((int)$it['stage'])) ?>">
              <?= e(stage_label((int)$it['stage'])) ?>
            </span>
            <div style="color:var(--muted);margin-top:6px">
              <?= e(mb_strimwidth($it['description'], 0, 120, '...')) ?>
            </div>
          </div>

          <div class="row">
            <a class="btn secondary" href="<?= BASE_URL ?>/app/admin/request_view.php?id=<?= (int)$it['id'] ?>">Detalhes</a>

            <form method="post" action="<?= BASE_URL ?>/app/admin/requests_restore.php" onsubmit="return confirm('Restaurar esta solicitação?  (is_active=1)');">
              <input type="hidden" name="id" value="<?= (int)$it['id'] ?>">
              <button class="btn" type="submit">Restaurar</button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <a class="btn secondary" href="<?= BASE_URL ?>/app/admin/dashboard.php">Voltar</a>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>