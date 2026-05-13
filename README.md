# Passeios turísticos

Aplicação Laravel com painel **Filament** para gestão de **passeios turísticos**, **ingresso especial** e **ingresso de serviços**, incluindo **selos** para impressão e páginas públicas de consulta via QR.

## Requisitos

- PHP **8.2+**
- Composer
- Base de dados (MySQL/MariaDB ou compatível com o driver configurado em `.env`)

## Instalação

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Configure `.env` (`APP_URL`, `DB_*`, etc.) e execute as migrações:

```bash
php artisan migrate
```

Se a base vier de um dump antigo e faltar colunas em `ingresso_servicos`:

```bash
php artisan migrate --path=database/migrations/2026_05_13_150000_add_numero_cadastro_and_lista_passageiros_to_ingresso_servicos_table.php
```

### Importação de SQL (opcional)

Existe um comando Artisan para importar dumps; consulte `php artisan list` e o ficheiro `app/Console/Commands/ImportSqlDumpCommand.php`.

### Importação de SQL (opcional) usando caminho relativo do arquivo
D:\fazenda\fazendaroot_tur_pmm (1).sql"

### Importação de SQL (opcional) usando caminho relativo local
php artisan db:import "D:\fazenda\fazendaroot_tur_pmm (1).sql"

### Importação de SQL (opcional) usando caminho relativo do arquivo intranet
php artisan db:import "fazendaroot_tur_pmm (1).sql"

## Painel administrativo

- URL típica: `/admin` (login Filament).
- Papéis de acesso: **Spatie Laravel Permission** (ex.: `super-admin` no painel).

## Selos e QR

### Páginas públicas (sem autenticação)

| Rota | Descrição |
|------|-----------|
| `GET /selo_turistico/{token}` | Consulta passeio turístico (`token` = `base64_encode(id)`). |
| `GET /selo_especial/{token}` | Consulta ingresso especial. |
| `GET /selo_servico/{token}` | Consulta ingresso de serviços. |

### Impressão (autenticado)

| Rota | Descrição |
|------|-----------|
| `GET /passeios-turisticos/selos/impressao?ids=1,2,3` | Selos de passeios. |
| `GET /ingresso-especial/selos/impressao?ids=...` | Selos ingresso especial. |
| `GET /ingresso-servicos/selos/impressao?ids=...` | Selos **serviços** (apenas registos com status **Liberado**). |

No Filament, use a ação em massa **“Emitir selo … (impressão)”** nos recursos correspondentes; ela redireciona para estas URLs.

### Recursos de impressão

Os layouts usam imagens em `public/img/` (ex.: logos PMM, governo, assinatura). Sem estes ficheiros, o selo aparece sem gráficos.

O QR dos selos de serviços é gerado em **SVG** (Simple QrCode), para evitar dependência de Imagick.

## Stack principal

- Laravel **11**
- Filament **3.3**
- `simplesoftwareio/simple-qrcode`
- `spatie/laravel-permission`

## Licença

Projeto derivado do esqueleto Laravel; o framework Laravel é [MIT](https://opensource.org/licenses/MIT).
