<?php
require_once __DIR__ . '/../../bootstrap/db.php';
require_once __DIR__ . '/../../bootstrap/helpers.php';
require_once __DIR__ . '/../partials/header.php';

$error = $success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $requesterName = trim($_POST['requester_name'] ?? '');
  $requesterPhone = trim($_POST['requester_phone'] ?? '');
  $description = trim($_POST['description'] ?? '');
  $technicalSpecs = trim($_POST['technical_specs'] ?? '');

  if ($requesterName === '' || $requesterPhone === '' || $description === '') {
    $error = "Informe nome, celular e descrição.";
  } else {
    $attachmentPath = null;

    if (!empty($_FILES['attachment']['name'])) {
      ensure_upload_dir();

      $ext = strtolower(pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION));
      $allowed = ['pdf','png','jpg','jpeg','doc','docx','zip'];

      if (!in_array($ext, $allowed, true)) {
        $error = "Tipo de anexo não permitido.";
      } else {
        $fileName = 'attachment_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $dest = UPLOAD_DIR . '/' . $fileName;

        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $dest)) {
          $attachmentPath = UPLOAD_URL . '/' . $fileName;
        } else {
          $error = "Falha ao enviar anexo.";
        }
      }
    }

    if (!$error) {
      $stmt = $pdo->prepare("
        INSERT INTO requests(requester_name, requester_phone, description, technical_specs, attachment_path, stage, is_active)
        VALUES (?,?,?,?,?,0,1)
      ");
      $stmt->execute([
        $requesterName,
        $requesterPhone,
        $description,
        $technicalSpecs !== '' ? $technicalSpecs : null,
        $attachmentPath
      ]);
      $success = "Solicitação criada. Você pode acompanhar no Kanban.";
    }
  }
}
?>

<div class="card">
  <h2>Nova solicitação</h2>

  <?php if ($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?>
  <?php if ($success): ?><div class="notice"><?= e($success) ?></div><?php endif; ?>

  <form method="post" enctype="multipart/form-data" class="card">
    <label>Nome</label>
    <input name="requester_name" required>

    <label>Celular</label>
    <input name="requester_phone" required inputmode="tel">

    <label>Descrição da solicitação</label>
    <textarea name="description" required rows="4"></textarea>

    <label>Especificações técnicas (se necessário)</label>
    <textarea name="technical_specs" rows="3"></textarea>

    <label>Anexo</label>
    <input type="file" name="attachment">
    <small class="help">Permitidos: pdf, png, jpg, doc, docx, zip</small>

    <button class="btn" type="submit">Enviar</button>
    <a class="btn secondary" href="<?= BASE_URL ?>/app/public/request_home.php">Voltar</a>
  </form>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>