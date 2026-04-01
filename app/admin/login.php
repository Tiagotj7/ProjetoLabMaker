<?php
require_once __DIR__ . '/../../bootstrap/db.php';
require_once __DIR__ . '/../../bootstrap/auth.php';
require_once __DIR__ . '/../partials/header.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  $stmt = $pdo->prepare("SELECT * FROM admins WHERE email=? AND is_active=1");
  $stmt->execute([$email]);
  $admin = $stmt->fetch();

  if ($admin && password_verify($password, $admin['password_hash'])) {
    $_SESSION['admin_id'] = (int)$admin['id'];
    $_SESSION['admin_name'] = $admin['name'];
    header("Location: " . BASE_URL . "/app/admin/dashboard.php");
    exit;
  }

  $error = "Credenciais inválidas ou usuário inativo.";
}
?>

<div class="card">
  <h2>Login do Administrador</h2>

  <?php if ($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?>

  <form method="post" class="card">
    <label>E-mail</label>
    <input name="email" type="email" required>

    <label>Senha</label>
    <input name="password" type="password" required>

    <button class="btn" type="submit">Entrar</button>
    <a class="btn secondary" href="<?= BASE_URL ?>/public/index.php">Voltar</a>
  </form>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>