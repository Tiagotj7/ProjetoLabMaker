<?php
require_once __DIR__ . '/env.php';

// InfinityFree: use env.ini
env_load(__DIR__ . '/../env.ini');

define('BASE_URL', rtrim((string) env('APP_BASE_URL', ''), '/'));

define('DB_HOST', (string) env('DB_HOST', ''));
define('DB_NAME', (string) env('DB_NAME', ''));
define('DB_USER', (string) env('DB_USER', ''));
define('DB_PASS', (string) env('DB_PASS', ''));

define('UPLOAD_DIR', __DIR__ . '/../public/uploads');
define('UPLOAD_URL', 'public/uploads');

date_default_timezone_set('America/Sao_Paulo');