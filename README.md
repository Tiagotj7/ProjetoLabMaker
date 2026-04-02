```md
# Lab Maker (PHP + MySQL)

Sistema simples para **Agendamentos** do Lab Maker e **Solicitações** com Kanban.  
**Arquivos/código em inglês** e **textos da interface em português**.

## Requisitos
- PHP + MySQL (InfinityFree)
- Pasta `public/uploads/` com permissão de escrita

## Instalação (InfinityFree)
1. Envie o projeto para `htdocs/`
2. Crie o banco MySQL no painel e importe `database.sql`
3. Crie `env.ini` em `htdocs/env.ini`:

```ini
APP_BASE_URL=""
DB_HOST=sqlXXX.infinityfree.com
DB_NAME=if0_XXXXXXX_labmaker
DB_USER=if0_XXXXXXX
DB_PASS=SUA_SENHA
```

> Se o projeto estiver em subpasta, use `APP_BASE_URL="/subpasta"`.

## Admin (login)
A tabela `admins.password_hash` precisa ser gerada com `password_hash()`.

1. Crie temporariamente `public/make_hash.php`:
```php
<?php
echo password_hash("admin", PASSWORD_DEFAULT);
```

2. Copie o hash gerado e atualize no banco:
```sql
ALTER TABLE admins MODIFY password_hash VARCHAR(255) NOT NULL;

UPDATE admins
SET password_hash='COLE_O_HASH_AQUI', is_active=1
WHERE email='admin@lab.com';
```

3. Apague `public/make_hash.php`

## Status no banco
- Flags `0/1`: `is_active`, `is_available`
- Kanban: `requests.stage`
  - `0` Recebido
  - `1` Análise
  - `2` Fazendo
  - `3` Concluído

## Arquivados
Solicitações arquivadas ficam em `requests.is_active = 0`.
```