<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selos turísticos — impressão</title>
    <style>
        @media print {
            .selo-page { page-break-after: always; }
            .selo-page:last-child { page-break-after: auto; }
        }
        body {
            background-color: rgb(112, 121, 37);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 95vh;
            margin: 0;
            padding: 16px 0;
            font-family: Arial, sans-serif;
        }
        .dados { position: absolute; margin-top: -28px; }
        .form-container {
            width: 1065px;
            height: 700px;
            background-color: #005BAC;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-left: -30px;
            box-sizing: border-box;
            position: relative;
        }
        table {
            margin-top: 200px;
            margin-left: 220px;
            width: 70%;
            height: 70%;
            border-collapse: collapse;
        }
        td { padding: 10px; vertical-align: top; }
        label {
            display: block;
            margin-bottom: 4px;
            color: white;
            font-weight: bold;
            font-size: 15px;
        }
        input, textarea {
            width: 100%;
            padding: 5px;
            border: none;
            border-radius: 4px;
            background-color: white;
            font-weight: bold;
            color: #050505;
            box-sizing: border-box;
        }
        .label-container {
            position: absolute;
            top: 660px;
            width: 650px;
            height: 150px;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-left: 20px;
            text-align: center;
            transform: rotate(-90deg);
            transform-origin: center;
        }
        .label-container span {
            position: absolute;
            writing-mode: vertical-rl;
            text-orientation: upright;
            width: 620px;
            margin: 12px;
            height: 125px;
            color: white;
            background-color: #A6CE39;
        }
        .turismo { font-size: 3rem; display: inline; }
        .turismo_t2 {
            font-size: 13px;
            z-index: 1;
            position: relative;
            top: -70px;
            font-style: italic;
            font-weight: bold;
        }
        .Nguia {
            height: 8px;
            position: absolute;
            width: 95px;
            right: 40px;
            margin-bottom: 12px;
            padding: 8px;
            top: 152px;
            z-index: 1;
        }
        .ngl { top: 130px; position: absolute; right: 54px; color: yellow; }
        .logo {
            position: absolute;
            top: -85px;
            width: 350px;
            height: 350px;
            right: 35%;
            text-align: center;
            background-image: url('{{ asset('img/logo_pmm_branco.png') }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
        .selo {
            margin: 10px;
            top: -15px;
            width: 150px;
            height: 150px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            background-image: url('{{ asset('img/logo_governo_1.png') }}');
            right: 20px;
            position: absolute;
        }
        .container_qr {
            width: 120px;
            height: 119px;
            background-size: contain;
            background-repeat: no-repeat;
            background-color: #f0f0f0;
            right: 17px;
            top: 440px;
            padding: 10px;
            position: absolute;
        }
        .qr {
            width: 117px;
            height: 117px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            right: 0px;
            top: 0px;
            padding: 10px;
            border: 1px solid rgb(15, 15, 15);
            position: absolute;
        }
        .qr img { width: 100%; height: 100%; }
        .qr svg { width: 100%; height: 100%; display: block; }
        .assinatura {
            position: absolute;
            bottom: 20px;
            left: 350px;
            width: 260px;
            height: 90px;
            z-index: 1;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            background-image: url('{{ asset('img/assinatura_secretario.png') }}');
        }
        .assinatura p {
            position: absolute;
            color: white;
            font-size: 12px;
            margin-top: 45px;
            text-align: center;
            left: 40px;
        }
        .l_data_emisao { font-size: 15px; margin-left: -35px; width: 195px; margin-top: -1px; }
        .data_emissao {
            margin-top: 0px;
            width: 150px;
            font-size: 15px;
            text-align: center;
            height: 25px;
            margin-left: -35px;
            line-height: 25px;
        }
        .l_transportadora { margin-top: -4px; font-size: 15px; margin-left: -42px; }
        .transportadora {
            width: 380px;
            font-size: 15px;
            text-align: center;
            min-height: 25px;
            max-height: 50px;
            margin-left: -40px;
            line-height: 25px;
        }
        .l_cpf { font-size: 15px; margin-top: -4px; margin-left: -4px; }
        .cpf {
            font-size: 15px;
            width: 250px;
            margin-left: -4px;
            text-align: center;
            height: 25px;
            line-height: 25px;
        }
        .lmv { font-size: 15px; margin-left: -215px; }
        .mv {
            width: 200px;
            margin-left: -215px;
            height: 25px;
            font-size: 15px;
            text-align: center;
            line-height: 25px;
        }
        .lplaca { font-size: 15px; margin-left: -350px; }
        .placa {
            width: 150px;
            margin-left: -352px;
            height: 25px;
            font-size: 15px;
            text-align: center;
            line-height: 25px;
        }
        .lrenavan { font-size: 15px; width: 120px; margin-left: -446px; }
        .renavan {
            width: 180px;
            margin-left: -446px;
            height: 25px;
            font-size: 15px;
            text-align: center;
            line-height: 25px;
        }
        .l_cadastrur { font-size: 15px; margin-left: -250px; width: 130px; }
        .cadastrur {
            margin-left: -250px;
            width: 200px;
            height: 25px;
            font-size: 15px;
            text-align: center;
            line-height: 25px;
        }
        .l_ORGANIZADOR { font-size: 15px; margin-left: -35px; }
        .ORGANIZADOR {
            margin-left: -35px;
            width: 670px;
            height: 30px;
            text-align: center;
            font-size: 15px;
            line-height: 28px;
        }
        .l_destino { font-size: 15px; margin-left: 116px; }
        .destino {
            margin-top: 2px;
            width: 150px;
            height: 30px;
            margin-left: 100px;
            text-align: center;
            font-size: 15px;
            line-height: 25px;
        }
        .l_data_entrada { margin-left: -35px; font-size: 15px; }
        .data_entrada {
            height: 25px;
            text-align: center;
            width: 140px;
            font-size: 15px;
            margin-left: -35px;
            line-height: 25px;
        }
        .l_data_saida { font-size: 15px; margin-left: -55px; }
        .data_saida {
            height: 25px;
            text-align: center;
            width: 140px;
            font-size: 15px;
            margin-left: -55px;
            line-height: 25px;
        }
        .l_horario_permanencia { font-size: 15px; margin-left: -250px; }
        .horario_permanencia_1 {
            height: 25px;
            margin-top: 12px;
            width: 100px;
            font-size: 15px;
            margin-left: -265px;
            text-align: center;
            line-height: 25px;
        }
        .horario_permanencia_2 {
            height: 25px;
            font-size: 15px;
            width: 100px;
            text-align: center;
            line-height: 25px;
        }
        .l_obs { margin-left: -35px; font-size: 15px; margin-top: -10px; }
        .obs {
            font-size: 15px;
            height: 25px;
            width: 690px;
            margin-top: 1px;
            margin-left: -35px;
        }
        .l_visto { margin-left: -325px; font-size: 15px; }
        .visto {
            margin-left: -325px;
            width: 135px;
            text-align: center;
            min-height: 25px;
            max-height: 50px;
            font-size: 15px;
            line-height: 25px;
        }
        .n_autorizacao {
            height: 52px;
            margin-left: -185px;
            text-align: center;
            margin-top: 15px;
            font-size: 40px;
            width: 180px;
        }
        .l_autorizacao {
            font-size: 15px;
            z-index: 1;
            margin-top: 8px;
            margin-left: -185px;
        }
        .container {
            position: absolute;
            color: white;
            padding: 5px;
            top: 25px;
            display: flex;
            align-items: center;
            width: 30px;
            left: 590px;
            margin-top: 590px;
        }
        .reclamacoes {
            position: absolute;
            padding: 10px;
            height: 2%;
            font-weight: bold;
            font-size: 1.1em;
            margin-right: 100px;
            white-space: nowrap;
        }
        .divider {
            position: absolute;
            margin-top: -12px;
            height: 60px;
            width: 3px;
            border-left: 2px solid white;
            left: 160px;
            z-index: 1;
        }
        .contact-info { display: flex; flex-direction: column; }
        .contact-info span {
            top: 1px;
            position: absolute;
            font-size: 1em;
            color: white;
            text-decoration: none;
            left: 175px;
            width: 150px;
        }
        .contact-info a {
            top: 20px;
            position: absolute;
            left: 165px;
            color: #f0f0f0;
        }
        .fundo {
            position: absolute;
            margin-top: 700px;
            width: 1200px;
            height: 100px;
            color: black;
            text-align: center;
            font-size: 8px;
            margin-left: -60px;
        }
    </style>
</head>
<body>
@foreach ($passeios as $selo)
    <div class="selo-page">
        @include('passeios.partials.selo-turismo', ['selo' => $selo, 'dataEmissao' => $dataEmissao])
    </div>
@endforeach
</body>
</html>
