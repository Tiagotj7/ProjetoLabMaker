<?php
// Ajuste para seu InfinityFree
define('DB_HOST', 'sqlXXX.infinityfree.com');
define('DB_NAME', 'if0_XXXXXXX_labmaker');
define('DB_USER', 'if0_XXXXXXX');
define('DB_PASS', 'SUA_SENHA');

// Se seu site for: https://seudominio.com/labmaker
define('BASE_URL', '/labmaker');

// Uploads
define('UPLOAD_DIR', __DIR__ . '/../public/uploads');
define('UPLOAD_URL', 'public/uploads'); // caminho relativo a BASE_URL (usaremos BASE_URL/UPLOAD_URL/arquivo)