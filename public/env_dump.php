<?php
require_once __DIR__ . '/../bootstrap/config.php';
var_dump(DB_HOST, DB_NAME, DB_USER);
echo "<pre>";
var_dump($GLOBALS['APP_ENV_VARS'] ?? null);
echo "</pre>";