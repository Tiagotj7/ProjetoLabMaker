<?php
require_once __DIR__ . '/../../bootstrap/db.php';
require_once __DIR__ . '/../partials/header.php';

$date = $_GET['date'] ?? date('Y-m-d');

$stmt = $pdo->prepare("
  SELECT ts.*
  FROM time_slots ts
  LEFT JOIN bookings b ON b.time_slot_id = ts.id AND b.is_active=1
  WHERE ts.is_available=1
    AND ts.date = ?
    AND b.id IS NULL
  ORDER BY ts.start_time
");
$stmt->execute([$date]);
$slots = $stmt->fetchAll();
?>

<div class="card">
  <h2>Agendamentos</h2>

  <form method="get" class="card">
    <label for="date">Selecione a data</label>
    <input id="date" type="date" name="date" value="<?= e($date) ?>">
    <button class="btn" type="submit">Ver horários</button>
    <small class="help">Mostrando apenas horários disponíveis.</small>
  </form>

  <?php if (!$slots): ?>
    <div class="notice">Nenhum horário disponível nesta data.</div>
  <?php else: ?>
    <?php foreach ($slots as $s): ?>
      <div class="card">
        <div class="row" style="justify-content:space-between;align-items:center">
          <div>
            <strong><?= e($s['date']) ?></strong><br>
            <span style="color:var(--muted)">
              <?= e(substr($s['start_time'], 0, 5)) ?> - <?= e(substr($s['end_time'], 0, 5)) ?>
            </span>
          </div>
          <a class="btn" href="<?= BASE_URL ?>/app/public/booking_create.php?slot_id=<?= (int)$s['id'] ?>">Agendar</a>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <a class="btn secondary" href="<?= BASE_URL ?>/public/index.php">Voltar</a>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>