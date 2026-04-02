<?php
require_once __DIR__ . '/../../bootstrap/auth.php';
require_once __DIR__ . '/../../bootstrap/db.php';
require_once __DIR__ . '/../../bootstrap/helpers.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int)($_POST['id'] ?? 0);

  if (isset($_POST['toggle_active'])) {
    $stmt = $pdo->prepare("UPDATE requests SET is_active = IF(is_active=1,0,1) WHERE id=?");
    $stmt->execute([$id]);
  } else {
    $stage = (int)($_POST['stage'] ?? 0);
    if ($stage < 0) $stage = 0;
    if ($stage > 3) $stage = 3;

    $stmt = $pdo->prepare("UPDATE requests SET stage=? WHERE id=?");
    $stmt->execute([$stage, $id]);
  }
}

$stmt = $pdo->query("SELECT * FROM requests WHERE is_active=1 ORDER BY created_at DESC");
$items = $stmt->fetchAll();

$grouped = [0=>[], 1=>[], 2=>[], 3=>[]];
foreach ($items as $it) $grouped[(int)$it['stage']][] = $it;

require_once __DIR__ . '/../partials/header.php';
?>

<div class="card">
  <h2>Gerenciar Solicitações (Kanban)</h2>

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

            <div class="row" style="margin-top:10px">
              <form method="post">
                <input type="hidden" name="id" value="<?= (int)$it['id'] ?>">
                <label style="margin:0 0 6px">Mover para</label>
                <select name="stage">
                  <option value="0" <?= (int)$it['stage']===0?'selected':'' ?>>Recebido</option>
                  <option value="1" <?= (int)$it['stage']===1?'selected':'' ?>>Análise</option>
                  <option value="2" <?= (int)$it['stage']===2?'selected':'' ?>>Fazendo</option>
                  <option value="3" <?= (int)$it['stage']===3?'selected':'' ?>>Concluído</option>
                </select>
                <button class="btn" type="submit">Atualizar</button>
              </form>

              <form method="post" onsubmit="return confirm('Arquivar solicitação? (is_active=0)');">
                <input type="hidden" name="id" value="<?= (int)$it['id'] ?>">
                <input type="hidden" name="toggle_active" value="1">
                <button class="btn secondary" type="submit">Arquivar (0/1)</button>
              </form>

              <a class="btn secondary" href="<?= BASE_URL ?>/app/admin/request_view.php?id=<?= (int)$it['id'] ?>">Detalhes</a>

            </div>

            <?php if (!empty($it['attachment_path'])): ?>
              <div style="margin-top:8px">
                <a href="<?= BASE_URL ?>/<?= e($it['attachment_path']) ?>" target="_blank">Ver anexo</a>
              </div>
            <?php endif; ?>

            <hr>
            <div style="color:var(--muted);font-size:.9rem">
              <strong>Solicitante:</strong> <?= e($it['requester_name']) ?> |
              <strong>Celular:</strong> <?= e($it['requester_phone']) ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endfor; ?>
  </div>

  <a class="btn secondary" href="<?= BASE_URL ?>/app/admin/dashboard.php">Voltar</a>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>