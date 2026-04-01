<?php

function e(string $value): string {
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function stage_label(int $stage): string {
  return match ($stage) {
    0 => 'Recebido',
    1 => 'Análise',
    2 => 'Fazendo',
    3 => 'Concluído',
    default => 'Recebido',
  };
}

function stage_badge_class(int $stage): string {
  return match ($stage) {
    0 => 'b0',
    1 => 'b1',
    2 => 'b2',
    3 => 'b3',
    default => 'b0',
  };
}

function ensure_upload_dir(): void {
  if (!is_dir(UPLOAD_DIR)) {
    @mkdir(UPLOAD_DIR, 0755, true);
  }
}