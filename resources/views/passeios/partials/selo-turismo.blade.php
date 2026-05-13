@php
    use App\Support\SeloTurismo;
    use Carbon\Carbon;
    use SimpleSoftwareIO\QrCode\Facades\QrCode;

    $corFundo = SeloTurismo::corFundoParaDestino($selo->destino);
    $link = url('/selo_turistico/' . base64_encode((string) $selo->id));
    $nomeVisto = strtoupper(optional($selo->alteradoPor)->name ?? '');
@endphp
<div class="form-container">
    <div class="label-container">
        <span style="background-color: {{ $corFundo }};">
            <p class="turismo">TURISMO LEGAL</p>
            <p class="turismo_t2">RESPEITE AS LEIS DE TRÂNSITO. PARADA SOMENTE PARA EMBARQUE E DESEMBARQUE.</p>
        </span>
    </div>
    <div class="logo"></div>
    <div>
        <div class="selo"></div>
        <div class="container_qr">
            <div class="qr">
                {!! QrCode::size(100)->margin(1)->generate($link) !!}
            </div>
        </div>
    </div>
    <div class="dados">
        <table>
            <tr>
                <td>
                    <label class="l_data_emisao" for="data-emissao-{{ $selo->id }}">DATA EMISSÃO:</label>
                    <input class="data_emissao" type="text" id="data-emissao-{{ $selo->id }}" value="{{ $dataEmissao->format('d/m/Y') }}" readonly>
                </td>
                <td>
                    <label class="l_transportadora" for="transportadora-{{ $selo->id }}">TRANSPORTADORA:</label>
                    <input class="transportadora" type="text" id="transportadora-{{ $selo->id }}" value="{{ strtoupper(optional($selo->transportadora)->nome ?? '') }}" readonly>
                </td>
                <td>
                    <label class="l_cpf" for="cnpj-cpf-{{ $selo->id }}">CNPJ / CPF:</label>
                    <input class="cpf" type="text" id="cnpj-cpf-{{ $selo->id }}" value="{{ optional($selo->transportadora)->cpf_cnpj ?? '' }}" readonly>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <label for="modelo-veiculo-{{ $selo->id }}" class="lmv">MODELO DO VEÍCULO:</label>
                    <input type="text" class="mv" id="modelo-veiculo-{{ $selo->id }}" value="{{ $selo->marca_modelo_veiculo }}" readonly>
                </td>
                <td>
                    <label for="placa-{{ $selo->id }}" class="lplaca">PLACA:</label>
                    <input type="text" class="placa" id="placa-{{ $selo->id }}" value="{{ $selo->placa_veiculo }}" readonly>
                </td>
                <td>
                    <label for="renavam-{{ $selo->id }}" class="lrenavan">RENAVAM:</label>
                    <input type="text" class="renavan" id="renavam-{{ $selo->id }}" value="{{ $selo->renavam }}" readonly>
                </td>
                <td>
                    <label class="l_cadastrur" for="cadastur-{{ $selo->id }}">CADASTUR:</label>
                    <input class="cadastrur" type="text" id="cadastur-{{ $selo->id }}" value="{{ optional($selo->transportadora)->numero_cadastro_turismo ?? '' }}" readonly>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label class="l_ORGANIZADOR" for="organizador-{{ $selo->id }}">ORGANIZADOR(A):</label>
                    <input class="ORGANIZADOR" type="text" id="organizador-{{ $selo->id }}" value="{{ strtoupper(optional($selo->organizador)->razao_social_nome ?? '') }}" readonly>
                </td>
                <td colspan="2">
                    <label class="l_destino" for="destino-{{ $selo->id }}">DESTINO:</label>
                    <input class="destino" type="text" id="destino-{{ $selo->id }}" value="{{ strtoupper($selo->destino ?? '') }}" readonly>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="l_data_entrada" for="data-entrada-{{ $selo->id }}">DATA CHEGADA:</label>
                    <input class="data_entrada" type="text" id="data-entrada-{{ $selo->id }}" value="{{ $selo->data_chegada ? Carbon::parse($selo->data_chegada)->format('d/m/Y') : '' }}" readonly>
                </td>
                <td>
                    <label class="l_data_saida" for="data-saida-{{ $selo->id }}">DATA SAÍDA:</label>
                    <input class="data_saida" type="text" id="data-saida-{{ $selo->id }}" value="{{ $selo->data_saida ? Carbon::parse($selo->data_saida)->format('d/m/Y') : '' }}" readonly>
                </td>
                <td colspan="2">
                    <label class="l_horario_permanencia" for="horario-permanencia-{{ $selo->id }}">HORÁRIO PERMANÊNCIA:</label>
                    <input class="horario_permanencia_1" type="text" id="horario-permanencia-{{ $selo->id }}" value="{{ $selo->hora_chegada }}" readonly>
                    <input class="horario_permanencia_2" type="text" value="{{ $selo->hora_saida }}" readonly>
                </td>
                <td>
                    <label class="l_visto" for="visto-{{ $selo->id }}">VISTO:</label>
                    <input class="visto" type="text" id="visto-{{ $selo->id }}" value="{{ $nomeVisto }}" readonly>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label class="l_obs" for="observacoes-{{ $selo->id }}">OBSERVAÇÕES:</label>
                    <textarea id="observacoes-{{ $selo->id }}" class="obs" name="observacoes" rows="3" readonly>{{ $selo->observacao }}</textarea>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label class="l_obs" for="lista-passageiros-{{ $selo->id }}">LISTA DE PASSAGEIROS:</label>
                    <textarea id="lista-passageiros-{{ $selo->id }}" class="obs" name="lista_passageiros" rows="6" readonly>{{ $selo->lista_passageiros_sanitized }}</textarea>
                </td>
            </tr>
        </table>
    </div>
    <div class="container">
        <div class="reclamacoes">RECLAMAÇÕES:</div>
        <div class="divider"></div>
        <div class="contact-info">
            <span>(21) 2789-6000</span>
            <a href="mailto:ouvidoria.pmm@mangaratiba.rj.gov.br">ouvidoria.pmm@mangaratiba.rj.gov.br</a>
        </div>
    </div>
    <span class="assinatura">
        <label class="l_autorizacao" for="numero-guia-{{ $selo->id }}">Nº DA AUTORIZAÇÂO:</label>
        <input class="n_autorizacao" type="text" id="numero-guia-{{ $selo->id }}" value="{{ SeloTurismo::mascararId($selo->id) }}" readonly>
        <p>Secretaria Municipal De Fazenda</p>
    </span>
    <div class="fundo">
        <h1>Obs: Esta licença não isenta o veículo do cumprimento da legislação de trânsito, estando sujeito à fiscalização dos órgãos competentes.</h1>
    </div>
</div>
