<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgenciasExternasResource\Pages;
use App\Models\AgenciasExternas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\SelectFilter;

class AgenciasExternasResource extends Resource
{
    protected static ?string $model = AgenciasExternas::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationLabel = 'Agências Externas';

    protected static ?string $modelLabel = 'Agência Externa';

    protected static ?string $pluralModelLabel = 'Agências Externas';

    protected static ?string $navigationGroup = 'Recursos';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Dados da Agência')
                    ->schema([
                        Grid::make(2)->schema([
                            Forms\Components\TextInput::make('nome')
                                ->label('Nome / Razão Social')
                                ->required()
                                ->maxLength(255),

                            Forms\Components\Select::make('status')
                                ->label('Status')
                                ->options([
                                    'Em análise' => 'Em Análise',
                                    'liberado'   => 'Liberado',
                                    'recusado'   => 'Recusado',
                                ])
                                ->default('Em análise')
                                ->native(false),
                        ]),

                        Grid::make(2)->schema([
                            Forms\Components\TextInput::make('cpf_cnpj')
                                ->label('CPF / CNPJ')
                                ->required()
                                ->maxLength(20),

                            Forms\Components\TextInput::make('numero_cadastro_turismo')
                                ->label('Nº Cadastro Turismo')
                                ->maxLength(50),
                        ]),
                    ]),

                Section::make('Viagem')
                    ->schema([
                        Grid::make(2)->schema([
                            Forms\Components\Select::make('motivo_visita')
                                ->label('Motivo da Visita')
                                ->options([
                                    'turistico'    => 'Turístico',
                                    'educacional'  => 'Educacional',
                                    'religioso'    => 'Religioso',
                                    'profissional' => 'Profissional',
                                    'evento'       => 'Evento',
                                    'outros'       => 'Outros',
                                ])
                                ->native(false),

                            Forms\Components\Select::make('transportadoras_id')
                                ->label('Transportadora')
                                ->relationship('transportadora', 'nome')
                                ->searchable()
                                ->preload(),
                        ]),

                        Grid::make(2)->schema([
                            Forms\Components\TextInput::make('local_partida')
                                ->label('Local de Partida')
                                ->maxLength(255),

                            Forms\Components\Select::make('destino')
                                ->label('Destino')
                                ->options([
                                    'jacareí'     => 'Conceição de Jacareí',
                                    'itacuruca'   => 'Itacuruça',
                                    'mangaratiba' => 'Mangaratiba',
                                    'muriqui'     => 'Muriqui',
                                ])
                                ->native(false),
                        ]),

                        Grid::make(3)->schema([
                            Forms\Components\Select::make('tipo_veiculo')
                                ->label('Tipo de Veículo')
                                ->options([
                                    'onibus'       => 'Ônibus',
                                    'micro_onibus' => 'Micro-ônibus',
                                    'van'          => 'Van',
                                ])
                                ->native(false),

                            Forms\Components\TextInput::make('placa_veiculo')
                                ->label('Placa do Veículo')
                                ->maxLength(10),

                            Forms\Components\TextInput::make('passageiros')
                                ->label('Nº de Passageiros')
                                ->numeric(),
                        ]),

                        Grid::make(2)->schema([
                            Forms\Components\DatePicker::make('data_chegada')
                                ->label('Data de Chegada')
                                ->native(false),

                            Forms\Components\DatePicker::make('data_saida')
                                ->label('Data de Saída')
                                ->native(false),
                        ]),
                    ]),

                Section::make('Endereço')
                    ->schema([
                        Grid::make(2)->schema([
                            Forms\Components\TextInput::make('endereco')
                                ->label('Endereço')
                                ->maxLength(255),

                            Forms\Components\TextInput::make('cep')
                                ->label('CEP')
                                ->maxLength(10),
                        ]),

                        Grid::make(3)->schema([
                            Forms\Components\TextInput::make('bairro')->label('Bairro')->maxLength(100),
                            Forms\Components\TextInput::make('cidade')->label('Cidade')->maxLength(100),
                            Forms\Components\TextInput::make('estado')->label('Estado')->maxLength(50),
                        ]),

                        Grid::make(2)->schema([
                            Forms\Components\TextInput::make('telefone')->label('Telefone')->maxLength(20),
                            Forms\Components\TextInput::make('email')->label('E-mail')->email()->maxLength(255),
                        ]),
                    ]),

                Section::make('Documentos')
                    ->schema([
                        Forms\Components\Textarea::make('observacao')->label('Observação')->rows(3),
                        Forms\Components\FileUpload::make('comprovante')
                            ->label('Comprovante de Ida')
                            ->disk('public')
                            ->directory('agencias')
                            ->acceptedFileTypes(['image/jpeg','image/png','application/pdf']),
                        Forms\Components\FileUpload::make('comprovante_retorno')
                            ->label('Comprovante de Retorno')
                            ->disk('public')
                            ->directory('agencias')
                            ->acceptedFileTypes(['image/jpeg','image/png','application/pdf']),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('nome')->label('Nome')->searchable()->limit(35)->weight('bold'),
                Tables\Columns\BadgeColumn::make('status')->colors([
                    'warning' => 'Em análise',
                    'success' => 'liberado',
                    'danger'  => 'recusado',
                ]),
                Tables\Columns\TextColumn::make('placa_veiculo')->label('Placa'),
                Tables\Columns\TextColumn::make('destino')->label('Destino'),
                Tables\Columns\TextColumn::make('data_chegada')->label('Chegada')->date('d/m/Y')->sortable(),
                Tables\Columns\TextColumn::make('data_saida')->label('Saída')->date('d/m/Y')->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options(['Em análise' => 'Em Análise', 'liberado' => 'Liberado', 'recusado' => 'Recusado']),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->striped()
            ->searchPlaceholder('Pesquisar...');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAgenciasExternas::route('/'),
            'create' => Pages\CreateAgenciasExternas::route('/create'),
            'edit'   => Pages\EditAgenciasExternas::route('/{record}/edit'),
        ];
    }
}
