# Lab Maker – Agendamentos e Solicitações (PHP + MySQL)

Sistema mobile-first para **agendamento do espaço Lab Maker** e **abertura/acompanhamento de solicitações** em **Kanban**.

- **Código/arquivos em inglês**
- **Interface (textos) em português**
- Compatível com hospedagem **InfinityFree** (PHP + MySQL)
- Perfis separados: **Solicitante** (público) e **Administrador** (login)

---

## Funcionalidades

### Solicitante (Público)
- Tela inicial com 2 módulos:
  - **Agendamentos**
  - **Solicitações**
- **Agendamentos**
  - Seleciona data
  - Visualiza horários disponíveis
  - Realiza cadastro rápido (nome, celular, quantidade de pessoas) e confirma
- **Solicitações**
  - Criar nova solicitação (com anexo opcional)
  - Acompanhar solicitações em **Kanban** (Recebido → Análise → Fazendo → Concluído)

### Administrador
- Login de administrador
- **Controle de horários (time slots)**
  - Criar e remover horários
  - Alternar disponibilidade (`is_available` 0/1)
- **Kanban das solicitações**
  - Mover etapa (0..3)
  - Arquivar/restaurar via `is_active` (0/1)
  - Visualizar detalhes do que foi solicitado
- **Visualizar reservas**
  - Ver quem reservou cada horário por data (nome, celular, pessoas)

---

## Status e Regras no Banco (0/1)

O sistema usa campos `TINYINT(1)` como flags:

- `admins.is_active`  
  - `1` ativo | `0` inativo
- `time_slots.is_available`  
  - `1` aparece para o solicitante | `0` oculto
- `bookings.is_active`  
  - `1` reserva válida | `0` cancelada (se implementar cancelamento)
- `requests.is_active`  
  - `1` aparece no Kanban | `0` arquivada

Kanban (etapas):
- `requests.stage`:  
  - `0` Recebido  
  - `1` Análise  
  - `2` Fazendo  
  - `3` Concluído  

---

## Heurísticas de Nielsen (aplicação no sistema)

1. **Visibilidade do status**: mensagens de sucesso/erro e badges de etapa.
2. **Compatível com o mundo real**: termos claros (“Agendar”, “Solicitações”, “Concluído”).
3. **Controle e liberdade**: botões “Voltar”, admin pode mover etapas e arquivar/restaurar.
4. **Consistência e padrões**: layout e componentes reutilizados, etapas fixas.
5. **Prevenção de erros**: validação de campos e verificação de horário já reservado.
6. **Reconhecimento**: Kanban por colunas e ações evidentes.
7. **Eficiência**: filtros por data e mudança rápida de status.
8. **Minimalismo**: formulários curtos e foco no essencial (mobile-first).
9. **Mensagens claras**: feedback objetivo (“Horário indisponível”, “Senha incorreta”).
10. **Ajuda**: dicas pequenas em campos e fluxos simples.

---