<?php
// Env loader sem putenv() (InfinityFree pode bloquear/limitar putenv)
// Lê KEY=VALUE e guarda em memória (array global).
$GLOBALS['APP_ENV_VARS'] = [];

function env_load(string $filePath): void {
  if (!file_exists($filePath) || !is_readable($filePath)) {
    return;
  }

  $lines = file($filePath, FILE_IGNORE_NEW_LINES);
  if (!$lines) return;

  foreach ($lines as $line) {
    $line = trim($line);

    if ($line === '' || str_starts_with($line, '#') || str_starts_with($line, ';')) {
      continue;
    }

    $pos = strpos($line, '=');
    if ($pos === false) continue;

    $key = trim(substr($line, 0, $pos));
    $value = trim(substr($line, $pos + 1));

    // remove aspas
    if (
      (strlen($value) >= 2 && $value[0] === '"' && $value[strlen($value)-1] === '"') ||
      (strlen($value) >= 2 && $value[0] === "'" && $value[strlen($value)-1] === "'")
    ) {
      $value = substr($value, 1, -1);
    }

    $GLOBALS['APP_ENV_VARS'][$key] = $value;
  }
}

function env(string $key, $default = null) {
  if (array_key_exists($key, $GLOBALS['APP_ENV_VARS'])) {
    $val = $GLOBALS['APP_ENV_VARS'][$key];
  } else {
    // fallback (se algum host preencher getenv/$_ENV)
    $val = $_ENV[$key] ?? getenv($key);
  }

  if ($val === false || $val === null || $val === '') return $default;

  if ($val === 'true') return true;
  if ($val === 'false') return false;
  if (is_numeric($val)) return $val + 0;

  return $val;
}