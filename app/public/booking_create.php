<?php
require_once __DIR__ . '/../../bootstrap/db.php';
require_once __DIR__ . '/../../bootstrap/helpers.php';
require_once __DIR__ . '/../partials/header.php';

$slotId = (int)($_GET['slot_id'] ?? 0);
$error = $success = null;

$stmt = $pdo->prepare("SELECT * FROM time_slots WHERE id=? AND is_available=1");
$stmt->execute([$slotId]);
$slot = $stmt->fetch();

if (!$slot) {
  echo "<div class='error'>Horário inválido ou indisponível.</div>";
  echo "<a class='btn secondary' href='".BASE_URL."/app/public/booking.php'>Voltar</a>";
  require_once __DIR__ . '/../partials/footer.php';
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $requesterName = trim($_POST['requester_name'] ?? '');
  $requesterPhone = trim($_POST['requester_phone'] ?? '');
  $peopleCount = (int)($_POST['people_count'] ?? 0);

  if ($requesterName === '' || $requesterPhone === '' || $peopleCount <= 0) {
    $error = "Preencha nome, celular e quantidade de pessoas.";
  } else {
    $chk = $pdo->prepare("SELECT id FROM bookings WHERE time_slot_id=? AND is_active=1");
    $chk->execute([$slotId]);

    if ($chk->fetch()) {
      $error = "Esse horário acabou de ser reservado. Escolha outro.";
    } else {
      $ins = $pdo->prepare("
        INSERT INTO bookings(time_slot_id, requester_name, requester_phone, people_count, is_active)
        VALUES (?,?,?,?,1)
      ");
      $ins->execute([$slotId, $requesterName, $requesterPhone, $peopleCount]);
      $success = "Agendamento registrado com sucesso.";
    }
  }
}
?>

<div class="card">
  <h2>Solicitar agendamento</h2>

  <div class="notice">
    <strong>Data:</strong> <?= e($slot['date']) ?> |
    <strong>Horário:</strong> <?= e(substr($slot['start_time'],0,5)) ?> - <?= e(substr($slot['end_time'],0,5)) ?>
  </div>

  <?php if ($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?>
  <?php if ($success): ?><div class="notice"><?= e($success) ?></div><?php endif; ?>

  <form method="post" class="card">
    <label>Nome</label>
    <input name="requester_name" required>

    <label>Celular</label>
    <input name="requester_phone" required inputmode="tel" placeholder="(xx) xxxxx-xxxx">

    <label>Quantidade de pessoas</label>
    <input type="number" name="people_count" min="1" required>

    <button class="btn" type="submit">Confirmar</button>
    <a class="btn secondary" href="<?= BASE_URL ?>/app/public/booking.php?date=<?= e($slot['date']) ?>">Voltar</a>
  </form>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>