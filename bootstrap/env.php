<?php
// Carregador simples de .env (KEY=VALUE)
// Compatível com InfinityFree (sem composer)

function env_load(string $filePath): void {
  if (!file_exists($filePath) || !is_readable($filePath)) {
    return;
  }

  $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  foreach ($lines as $line) {
    $line = trim($line);

    // ignora comentários
    if ($line === '' || str_starts_with($line, '#')) {
      continue;
    }

    // KEY=VALUE
    $pos = strpos($line, '=');
    if ($pos === false) continue;

    $key = trim(substr($line, 0, $pos));
    $value = trim(substr($line, $pos + 1));

    // remove aspas
    if ((str_starts_with($value, '"') && str_ends_with($value, '"')) ||
        (str_starts_with($value, "'") && str_ends_with($value, "'"))) {
      $value = substr($value, 1, -1);
    }

    // não sobrescreve se já existir
    if (getenv($key) === false) {
      putenv("$key=$value");
      $_ENV[$key] = $value;
    }
  }
}

function env(string $key, $default = null) {
  $val = getenv($key);
  if ($val === false || $val === null || $val === '') return $default;

  // normalizações úteis
  if ($val === 'true') return true;
  if ($val === 'false') return false;
  if (is_numeric($val)) return $val + 0;

  return $val;
}