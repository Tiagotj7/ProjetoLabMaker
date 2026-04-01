<?php
require_once __DIR__ . '/env.php';

// tenta carregar .env na raiz do projeto
env_load(__DIR__ . '/../.env');

// Se o InfinityFree bloquear ".env", troque para:
# env_load(__DIR__ . '/../env.ini');

date_default_timezone_set(env('TIMEZONE', 'America/Sao_Paulo'));

define('APP_NAME', env('APP_NAME', 'Lab Maker'));
define('APP_ENV', env('APP_ENV', 'production'));
define('APP_DEBUG', (int) env('APP_DEBUG', 0));
define('BASE_URL', env('APP_BASE_URL', ''));

define('DB_HOST', env('DB_HOST', 'localhost'));
define('DB_NAME', env('DB_NAME', ''));
define('DB_USER', env('DB_USER', ''));
define('DB_PASS', env('DB_PASS', ''));

// Uploads (dir físico e url)
define('UPLOAD_DIR', __DIR__ . '/../' . trim(env('UPLOAD_DIR', 'public/uploads'), '/'));
define('UPLOAD_URL', trim(env('UPLOAD_DIR', 'public/uploads'), '/'));
