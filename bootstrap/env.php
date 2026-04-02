<?php
$GLOBALS['APP_ENV_VARS'] = [];

function env_load(string $filePath): void {
  if (!file_exists($filePath) || !is_readable($filePath)) return;

  $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  foreach ($lines as $line) {
    $line = trim($line);
    if ($line === '' || str_starts_with($line, '#')) continue;

    $pos = strpos($line, '=');
    if ($pos === false) continue;

    $key = trim(substr($line, 0, $pos));
    $value = trim(substr($line, $pos + 1));

    if (
      (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
      (str_starts_with($value, "'") && str_ends_with($value, "'"))
    ) {
      $value = substr($value, 1, -1);
    }

    $GLOBALS['APP_ENV_VARS'][$key] = $value;
  }
}

function env(string $key, $default = null) {
  if (isset($GLOBALS['APP_ENV_VARS'][$key])) {
    $val = $GLOBALS['APP_ENV_VARS'][$key];
  } else {
    $val = $_ENV[$key] ?? getenv($key);
  }

  if ($val === false || $val === null || $val === '') return $default;

  if ($val === 'true') return true;
  if ($val === 'false') return false;
  if (is_numeric($val)) return $val + 0;

  return $val;
}