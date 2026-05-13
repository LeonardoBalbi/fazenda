<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IngressoServicosResource\Pages;
use App\Models\IngressoServicos;
use App\Support\SeloIngressoServico;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Collection;

class IngressoServicosResource extends Resource
{
    protected static ?string $model = IngressoServicos::class;
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationLabel = 'Ingresso Servicos';
    protected static ?string $modelLabel = 'Ingresso de Serviço';
    protected static ?string $pluralModelLabel = 'Ingressos de Serviços';
    protected static ?string $navigationGroup = 'Recursos';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informações')->schema([
                Grid::make(2)->schema([
                    Forms\Components\Select::make('status')->label('Status')->options(['Em análise'=>'Em Análise','liberado'=>'Liberado','recusado'=>'Recusado'])->default('Em análise')->native(false),
                    Forms\Components\TextInput::make('nome')->label('Nome/Empresa')->maxLength(255),
                ]),
                Grid::make(3)->schema([
                    Forms\Components\TextInput::make('cpf_cnpj')->label('CPF/CNPJ')->maxLength(20),
                    Forms\Components\TextInput::make('numero_cadastro_turismo')->label('Nº Cadastro Turismo (CADASTUR)')->maxLength(80),
                    Forms\Components\Select::make('motivo_visita')->label('Motivo')->options(['profissional' => 'Profissional', 'servico' => 'Serviço', 'manutencao' => 'Manutenção', 'outros' => 'Outros'])->native(false),
                ]),
            ]),
            Section::make('Veículo e Viagem')->schema([
                Grid::make(2)->schema([
                    Forms\Components\Select::make('transportadoras_id')
                        ->label('Transportadora')
                        ->relationship('transportadora', 'nome')
                        ->searchable()
                        ->preload(),
                ]),
                Grid::make(3)->schema([
                    Forms\Components\Select::make('tipo_veiculo')->label('Tipo Veículo')->options(['onibus'=>'Ônibus','micro_onibus'=>'Micro-ônibus','van'=>'Van','carro'=>'Carro'])->native(false),
                    Forms\Components\TextInput::make('marca_modelo_veiculo')->label('Marca / Modelo')->maxLength(255),
                    Forms\Components\TextInput::make('placa_veiculo')->label('Placa')->maxLength(10),
                ]),
                Grid::make(2)->schema([
                    Forms\Components\TextInput::make('renavam')->label('RENAVAM')->maxLength(20),
                    Forms\Components\TextInput::make('passageiros')->label('Passageiros')->numeric(),
                ]),
                Grid::make(2)->schema([
                    Forms\Components\TextInput::make('local_partida')->label('Local de Partida')->maxLength(255),
                    Forms\Components\TextInput::make('destino')->label('Destino')->maxLength(100),
                ]),
                Grid::make(2)->schema([
                    Forms\Components\DatePicker::make('data_chegada')->label('Data de Chegada')->native(false),
                    Forms\Components\DatePicker::make('data_saida')->label('Data de Saída')->native(false),
                ]),
                Grid::make(2)->schema([
                    Forms\Components\TimePicker::make('hora_chegada')->label('Hora chegada')->seconds(false),
                    Forms\Components\TimePicker::make('hora_saida')->label('Hora saída')->seconds(false),
                ]),
            ]),
            Section::make('Documentos')->schema([
                Forms\Components\Textarea::make('observacao')->label('Observação')->rows(3),
                Forms\Components\Textarea::make('lista_passageiros')->label('Lista de passageiros')->rows(5)->columnSpanFull(),
                Forms\Components\FileUpload::make('comprovante')->label('Comprovante')->disk('public')->directory('ingresso-servicos')->acceptedFileTypes(['image/jpeg','image/png','application/pdf']),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('nome')->label('Nome')->searchable()->limit(35),
                Tables\Columns\BadgeColumn::make('status')->colors(['warning'=>'Em análise','success'=>'liberado','danger'=>'recusado']),
                Tables\Columns\TextColumn::make('placa_veiculo')->label('Placa'),
                Tables\Columns\TextColumn::make('destino')->label('Destino'),
                Tables\Columns\TextColumn::make('data_chegada')->label('Chegada')->date('d/m/Y'),
            ])
            ->defaultSort('id','desc')
            ->actions([Tables\Actions\EditAction::make(),Tables\Actions\DeleteAction::make()])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('emitir_selos_impressao')
                        ->label('Emitir selo serviços (impressão)')
                        ->icon('heroicon-o-printer')
                        ->color('info')
                        ->requiresConfirmation()
                        ->modalHeading('Emitir selos de serviços para impressão')
                        ->modalDescription('Apenas registos com status Liberado. Abre página para impressão (Ctrl+P).')
                        ->action(function (Collection $records) {
                            $liberados = $records->filter(
                                fn (IngressoServicos $r): bool => SeloIngressoServico::isLiberado($r->status)
                            );

                            if ($liberados->isEmpty()) {
                                Notification::make()
                                    ->title('Nenhum ingresso liberado')
                                    ->danger()
                                    ->body('Selecione registos com status Liberado.')
                                    ->send();

                                return;
                            }

                            if ($liberados->count() !== $records->count()) {
                                Notification::make()
                                    ->title('Aviso')
                                    ->warning()
                                    ->body('Só entram na impressão os liberados ('.$liberados->count().' de '.$records->count().').')
                                    ->send();
                            }

                            $ids = $liberados->pluck('id')->sort()->values()->implode(',');

                            return redirect()->route('ingresso-servicos.selos.impressao', ['ids' => $ids]);
                        }),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->striped()
            ->searchPlaceholder('Pesquisar...');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListIngressoServicos::route('/'),
            'create' => Pages\CreateIngressoServicos::route('/create'),
            'edit'   => Pages\EditIngressoServicos::route('/{record}/edit'),
        ];
    }
}
