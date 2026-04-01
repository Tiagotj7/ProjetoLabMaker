<?php
require_once __DIR__ . '/../../bootstrap/auth.php';
require_once __DIR__ . '/../../bootstrap/db.php';
require_once __DIR__ . '/../../bootstrap/helpers.php';
require_admin();

$error = $success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? '';

  if ($action === 'create') {
    $date = $_POST['date'] ?? '';
    $startTime = $_POST['start_time'] ?? '';
    $endTime = $_POST['end_time'] ?? '';

    if (!$date || !$startTime || !$endTime) {
      $error = "Informe data e horários.";
    } else {
      $stmt = $pdo->prepare("INSERT INTO time_slots(date,start_time,end_time,is_available) VALUES (?,?,?,1)");
      $stmt->execute([$date, $startTime, $endTime]);
      $success = "Horário criado.";
    }
  }

  if ($action === 'toggle') {
    $id = (int)($_POST['id'] ?? 0);
    $stmt = $pdo->prepare("UPDATE time_slots SET is_available = IF(is_available=1,0,1) WHERE id=?");
    $stmt->execute([$id]);
    $success = "Disponibilidade atualizada (0/1).";
  }

  if ($action === 'delete') {
    $id = (int)($_POST['id'] ?? 0);
    $stmt = $pdo->prepare("DELETE FROM time_slots WHERE id=?");
    $stmt->execute([$id]);
    $success = "Horário removido.";
  }
}

$dateFilter = $_GET['date'] ?? date('Y-m-d');
$stmt = $pdo->prepare("SELECT * FROM time_slots WHERE date=? ORDER BY start_time");
$stmt->execute([$dateFilter]);
$slots = $stmt->fetchAll();

require_once __DIR__ . '/../partials/header.php';
?>

<div class="card">
  <h2>Controle de horários</h2>

  <?php if ($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?>
  <?php if ($success): ?><div class="notice"><?= e($success) ?></div><?php endif; ?>

  <form method="get" class="card">
    <label>Filtrar por data</label>
    <input type="date" name="date" value="<?= e($dateFilter) ?>">
    <button class="btn" type="submit">Filtrar</button>
  </form>

  <form method="post" class="card">
    <input type="hidden" name="action" value="create">
    <h3>Novo horário</h3>

    <label>Data</label>
    <input type="date" name="date" required value="<?= e($dateFilter) ?>">

    <label>Hora início</label>
    <input type="time" name="start_time" required>

    <label>Hora fim</label>
    <input type="time" name="end_time" required>

    <button class="btn" type="submit">Adicionar</button>
  </form>

  <div class="card">
    <h3>Horários do dia</h3>

    <?php if (!$slots): ?>
      <div class="notice">Nenhum horário cadastrado.</div>
    <?php endif; ?>

    <?php foreach ($slots as $s): ?>
      <div class="card">
        <div class="row" style="justify-content:space-between;align-items:center">
          <div>
            <strong><?= e(substr($s['start_time'],0,5)) ?> - <?= e(substr($s['end_time'],0,5)) ?></strong><br>
            <span style="color:var(--muted)">disponível: <?= (int)$s['is_available'] ?></span>
          </div>

          <div class="row">
            <form method="post">
              <input type="hidden" name="action" value="toggle">
              <input type="hidden" name="id" value="<?= (int)$s['id'] ?>">
              <button class="btn secondary" type="submit">Alternar (0/1)</button>
            </form>

            <form method="post" onsubmit="return confirm('Remover horário?');">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?= (int)$s['id'] ?>">
              <button class="btn" style="background:var(--danger)" type="submit">Remover</button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <a class="btn secondary" href="<?= BASE_URL ?>/app/admin/dashboard.php">Voltar</a>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>