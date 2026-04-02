<?php
require_once __DIR__ . '/../../bootstrap/auth.php';
require_once __DIR__ . '/../../bootstrap/db.php';
require_once __DIR__ . '/../../bootstrap/helpers.php';
require_admin();

$dateFilter = $_GET['date'] ?? date('Y-m-d');

// Lista todos os slots do dia + se tem booking ativo, traz dados do solicitante
$stmt = $pdo->prepare("
  SELECT
    ts.id AS slot_id,
    ts.date,
    ts.start_time,
    ts.end_time,
    ts.is_available,
    b.id AS booking_id,
    b.requester_name,
    b.requester_phone,
    b.people_count,
    b.is_active AS booking_is_active,
    b.created_at AS booked_at
  FROM time_slots ts
  LEFT JOIN bookings b
    ON b.time_slot_id = ts.id
   AND b.is_active = 1
  WHERE ts.date = ?
  ORDER BY ts.start_time
");
$stmt->execute([$dateFilter]);
$rows = $stmt->fetchAll();

require_once __DIR__ . '/../partials/header.php';
?>

<div class="card">
  <h2>Reservas do Lab Maker</h2>
  <p style="color:var(--muted)">Visualize quem reservou cada horário.</p>

  <form method="get" class="card">
    <label>Filtrar por data</label>
    <input type="date" name="date" value="<?= e($dateFilter) ?>">
    <button class="btn" type="submit">Filtrar</button>
  </form>

  <?php if (!$rows): ?>
    <div class="notice">Nenhum horário cadastrado para esta data.</div>
  <?php else: ?>
    <?php foreach ($rows as $r): ?>
      <div class="card">
        <div class="row" style="justify-content:space-between;align-items:flex-start">
          <div>
            <strong><?= e(substr($r['start_time'],0,5)) ?> - <?= e(substr($r['end_time'],0,5)) ?></strong><br>
            <span style="color:var(--muted)">Slot disponível (0/1): <?= (int)$r['is_available'] ?></span>
          </div>

          <div style="min-width:240px">
            <?php if ($r['booking_id']): ?>
              <span class="badge b3">Reservado</span>
              <div style="margin-top:8px;color:var(--muted)">
                <strong>Nome:</strong> <?= e($r['requester_name']) ?><br>
                <strong>Celular:</strong> <?= e($r['requester_phone']) ?><br>
                <strong>Pessoas:</strong> <?= (int)$r['people_count'] ?><br>
                <strong>Reservado em:</strong> <?= e($r['booked_at']) ?>
              </div>
            <?php else: ?>
              <span class="badge b0">Livre</span>
              <div style="margin-top:8px;color:var(--muted)">Nenhuma reserva neste horário.</div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <a class="btn secondary" href="<?= BASE_URL ?>/app/admin/dashboard.php">Voltar</a>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>