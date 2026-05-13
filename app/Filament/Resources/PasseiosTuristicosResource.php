<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PasseiosTuristicosResource\Pages;
use App\Models\PasseiosTuristicos;
use App\Support\SeloTurismo;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class PasseiosTuristicosResource extends Resource
{
    protected static ?string $model = PasseiosTuristicos::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationLabel = 'Passeios Turísticos';

    protected static ?string $modelLabel = 'Passeio Turístico';

    protected static ?string $pluralModelLabel = 'Passeios Turísticos';

    protected static ?string $navigationGroup = 'Recursos';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações Gerais')
                    ->schema([
                        Grid::make(2)->schema([
                            Forms\Components\Select::make('status')
                                ->label('Status')
                                ->options(PasseiosTuristicos::statusOptions())
                                ->default('aguardando')
                                ->required()
                                ->native(false),

                            Forms\Components\Select::make('motivo_visita')
                                ->label('Motivo da Visita')
                                ->options(PasseiosTuristicos::motivoVisitaOptions())
                                ->required()
                                ->native(false),
                        ]),

                        Grid::make(2)->schema([
                            Forms\Components\TextInput::make('local_partida')
                                ->label('Local de Partida')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Ex: RIO DE JANEIRO'),

                            Forms\Components\Select::make('destino')
                                ->label('Destino')
                                ->options(PasseiosTuristicos::destinoOptions())
                                ->required()
                                ->native(false),
                        ]),
                    ])
                    ->columns(1),

                Section::make('Transportadora & Organizador')
                    ->schema([
                        Grid::make(2)->schema([
                            Forms\Components\Select::make('transportadoras_id')
                                ->label('Transportadora')
                                ->relationship('transportadora', 'nome')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->createOptionForm([
                                    Forms\Components\TextInput::make('nome')->required(),
                                    Forms\Components\TextInput::make('cpf_cnpj')->required(),
                                    Forms\Components\TextInput::make('numero_cadastro_turismo')->required(),
                                    Forms\Components\TextInput::make('telefone')->required(),
                                    Forms\Components\TextInput::make('email')->email()->required(),
                                    Forms\Components\TextInput::make('endereco')->required(),
                                    Forms\Components\TextInput::make('numero')->required(),
                                    Forms\Components\TextInput::make('bairro')->required(),
                                    Forms\Components\TextInput::make('cidade')->required(),
                                    Forms\Components\TextInput::make('estado')->required(),
                                    Forms\Components\TextInput::make('cep')->required(),
                                ]),

                            Forms\Components\Select::make('organizador_id')
                                ->label('Agência / Organizador')
                                ->relationship('organizador', 'razao_social_nome')
                                ->searchable()
                                ->preload()
                                ->required(),
                        ]),
                    ]),

                Section::make('Veículo')
                    ->schema([
                        Grid::make(3)->schema([
                            Forms\Components\Select::make('tipo_veiculo')
                                ->label('Tipo de Veículo')
                                ->options(PasseiosTuristicos::tipoVeiculoOptions())
                                ->required()
                                ->native(false),

                            Forms\Components\TextInput::make('marca_modelo_veiculo')
                                ->label('Marca/Modelo')
                                ->required()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('placa_veiculo')
                                ->label('Placa do Veículo')
                                ->required()
                                ->maxLength(10)
                                ->placeholder('ABC1D23'),
                        ]),

                        Grid::make(2)->schema([
                            Forms\Components\TextInput::make('renavam')
                                ->label('RENAVAM')
                                ->maxLength(20),

                            Forms\Components\TextInput::make('passageiros')
                                ->label('Nº de Passageiros')
                                ->numeric()
                                ->required()
                                ->minValue(1),
                        ]),
                    ]),

                Section::make('Datas e Horários')
                    ->schema([
                        Grid::make(2)->schema([
                            Forms\Components\DatePicker::make('data_chegada')
                                ->label('Data de Chegada')
                                ->required()
                                ->native(false),

                            Forms\Components\TimePicker::make('hora_chegada')
                                ->label('Hora de Chegada')
                                ->seconds(false),
                        ]),

                        Grid::make(2)->schema([
                            Forms\Components\DatePicker::make('data_saida')
                                ->label('Data de Saída')
                                ->required()
                                ->native(false),

                            Forms\Components\TimePicker::make('hora_saida')
                                ->label('Hora de Saída')
                                ->seconds(false),
                        ]),
                    ]),

                Section::make('Observações e Documentos')
                    ->schema([
                        Forms\Components\Textarea::make('observacao')
                            ->label('Observação')
                            ->rows(3)
                            ->maxLength(500),

                        Forms\Components\FileUpload::make('comprovante')
                            ->label('Comprovante')
                            ->disk('public')
                            ->directory('comprovantes')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'application/pdf'])
                            ->maxSize(5120),

                        Forms\Components\Textarea::make('lista_passageiros')
                            ->label('Lista de Passageiros')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable()
                    ->color('primary')
                    ->weight('bold'),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'aguardando',
                        'info' => 'em análise',
                        'success' => 'liberado',
                        'danger' => 'recusado',
                    ])
                    ->formatStateUsing(fn (string $state): string => match (strtolower($state)) {
                        'aguardando' => 'AGUARDANDO',
                        'em análise', 'em analise' => 'EM ANÁLISE',
                        'liberado' => 'LIBERADO',
                        'recusado' => 'RECUSADO',
                        default => strtoupper($state),
                    }),

                Tables\Columns\TextColumn::make('tipo_veiculo')
                    ->label('Tipo Veículo')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'onibus' => 'ônibus',
                        'micro_onibus' => 'micro_ônibus',
                        'van' => 'van',
                        default => $state ?? '—',
                    }),

                Tables\Columns\TextColumn::make('placa_veiculo')
                    ->label('Placa do Veículo')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('organizador.razao_social_nome')
                    ->label('Agência')
                    ->searchable()
                    ->limit(40)
                    ->color('primary')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('data_chegada')
                    ->label('Data do Ingresso')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('destino')
                    ->label('Destino')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'jacareí' => 'Conceição de Jacareí',
                        'itacuruca' => 'Itacuruça',
                        'mangaratiba' => 'Mangaratiba',
                        'muriqui' => 'Muriqui',
                        'praia_Grande' => 'Praia Grande',
                        default => ucfirst($state ?? '—'),
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('passageiros')
                    ->label('Passageiros')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(PasseiosTuristicos::statusOptions())
                    ->native(false),

                SelectFilter::make('tipo_veiculo')
                    ->label('Tipo de Veículo')
                    ->options(PasseiosTuristicos::tipoVeiculoOptions())
                    ->native(false),

                SelectFilter::make('destino')
                    ->label('Destino')
                    ->options(PasseiosTuristicos::destinoOptions())
                    ->native(false),

                Filter::make('data_chegada')
                    ->form([
                        Forms\Components\DatePicker::make('data_de')->label('Data de')->native(false),
                        Forms\Components\DatePicker::make('data_ate')->label('Data até')->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['data_de'], fn (Builder $q, $date): Builder => $q->whereDate('data_chegada', '>=', $date))
                            ->when($data['data_ate'], fn (Builder $q, $date): Builder => $q->whereDate('data_chegada', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('liberar')
                    ->label('Liberar')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (PasseiosTuristicos $record): void {
                        $record->update([
                            'status' => 'liberado',
                            'alterado_por' => auth()->id(),
                        ]);
                    })
                    ->visible(fn (PasseiosTuristicos $record): bool => $record->status !== 'liberado'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('emitir_selos_impressao')
                        ->label('Emitir selo (impressão)')
                        ->icon('heroicon-o-printer')
                        ->color('info')
                        ->requiresConfirmation()
                        ->modalHeading('Emitir selos para impressão')
                        ->modalDescription('Será aberta uma página com o layout do selo para cada passeio selecionado que esteja com status Liberado. Use Ctrl+P para imprimir.')
                        ->action(function (Collection $records) {
                            $liberados = $records->filter(
                                fn (PasseiosTuristicos $r): bool => SeloTurismo::isLiberado($r->status)
                            );

                            if ($liberados->isEmpty()) {
                                Notification::make()
                                    ->title('Nenhum passeio liberado')
                                    ->danger()
                                    ->body('Selecione pelo menos um registo com status Liberado.')
                                    ->send();

                                return;
                            }

                            if ($liberados->count() !== $records->count()) {
                                Notification::make()
                                    ->title('Aviso')
                                    ->warning()
                                    ->body('Só entram na impressão os passeios com status Liberado ('.$liberados->count().' de '.$records->count().').')
                                    ->send();
                            }

                            $ids = $liberados->pluck('id')->sort()->values()->implode(',');

                            return redirect()->route('passeios.selos.impressao', ['ids' => $ids]);
                        }),
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('liberar_selecionados')
                        ->label('Liberar Selecionados')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records): void {
                            $records->each(fn ($r) => $r->update([
                                'status' => 'liberado',
                                'alterado_por' => auth()->id(),
                            ]));
                        }),
                ]),
            ])
            ->striped()
            ->searchPlaceholder('Pesquisar...');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPasseiosTuristicos::route('/'),
            'create' => Pages\CreatePasseiosTuristicos::route('/create'),
            'view' => Pages\ViewPasseiosTuristicos::route('/{record}'),
            'edit' => Pages\EditPasseiosTuristicos::route('/{record}/edit'),
        ];
    }
}
