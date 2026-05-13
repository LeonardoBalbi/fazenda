<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selo especial #{{ $registo->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; background: #f0f0f0; }
        .card { max-width: 480px; margin: 0 auto; background: #005BAC; color: #fff; padding: 1.5rem; border-radius: 8px; }
        .bar { height: 8px; border-radius: 4px; margin-bottom: 1rem; background: #808080; }
        h1 { font-size: 1.25rem; margin: 0 0 0.5rem; }
        dl { margin: 0; }
        dt { font-size: 0.75rem; opacity: 0.85; margin-top: 0.75rem; }
        dd { margin: 0.15rem 0 0; font-weight: bold; }
    </style>
</head>
<body>
    <div class="card">
        <div class="bar"></div>
        <h1>Ingresso especial #{{ $registo->id }}</h1>
        <dl>
            <dt>Status</dt>
            <dd>{{ strtoupper($registo->status) }}</dd>
            <dt>Destino</dt>
            <dd>{{ strtoupper((string) ($registo->destino ?? '')) }}</dd>
            <dt>Transportadora</dt>
            <dd>{{ optional($registo->transportadora)->nome ?? '—' }}</dd>
            <dt>Placa</dt>
            <dd>{{ $registo->placa_veiculo }}</dd>
        </dl>
    </div>
</body>
</html>
