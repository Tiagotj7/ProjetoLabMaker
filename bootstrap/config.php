<?php
require_once __DIR__ . '/env.php';

// Tenta carregar .env (se não existir, segue com defaults)
env_load(__DIR__ . '/../.env');
// Alternativa:
// env_load(__DIR__ . '/../env.ini');

$baseUrl = rtrim((string) env('APP_BASE_URL', ''), '/');
define('BASE_URL', $baseUrl);

// Banco (sem isso não funciona; mas se faltar, vai falhar de forma controlada)
define('DB_HOST', (string) env('DB_HOST', 'localhost'));
define('DB_NAME', (string) env('DB_NAME', ''));
define('DB_USER', (string) env('DB_USER', ''));
define('DB_PASS', (string) env('DB_PASS', ''));

// Uploads (defaults)
define('UPLOAD_DIR', __DIR__ . '/../public/uploads');
define('UPLOAD_URL', 'public/uploads');

// Timezone fixa (sem depender de .env)
date_default_timezone_set('America/Sao_Paulo');