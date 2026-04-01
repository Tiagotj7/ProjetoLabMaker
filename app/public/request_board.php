<?php
require_once __DIR__ . '/../../bootstrap/db.php';
require_once __DIR__ . '/../../bootstrap/helpers.php';
require_once __DIR__ . '/../partials/header.php';

$stmt = $pdo->query("SELECT * FROM requests WHERE is_active=1 ORDER BY created_at DESC");
$items = $stmt->fetchAll();

$grouped = [0=>[], 1=>[], 2=>[], 3=>[]];
foreach ($items as $it) {
  $grouped[(int)$it['stage']][] = $it;
}
?>

<div class="card">
  <h2>Kanban de Solicitações</h2>

  <div class="kanban">
    <?php for ($stage=0; $stage<=3; $stage++): ?>
      <div class="col">
        <h3><?= e(stage_label($stage)) ?></h3>

        <?php foreach ($grouped[$stage] as $it): ?>
          <div class="kcard">
            <div class="row" style="justify-content:space-between;align-items:center">
              <strong>#<?= (int)$it['id'] ?></strong>
              <span class="badge <?= e(stage_badge_class($stage)) ?>"><?= e(stage_label($stage)) ?></span>
            </div>

            <div style="color:var(--muted);margin-top:6px">
              <?= e(mb_strimwidth($it['description'], 0, 110, '...')) ?>
            </div>

            <?php if (!empty($it['attachment_path'])): ?>
              <div style="margin-top:8px">
                <a href="<?= BASE_URL ?>/<?= e($it['attachment_path']) ?>" target="_blank">Ver anexo</a>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endfor; ?>
  </div>

  <a class="btn secondary" href="<?= BASE_URL ?>/app/public/request_home.php">Voltar</a>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>