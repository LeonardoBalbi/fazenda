<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransportadorasResource\Pages;
use App\Models\Transportadoras;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\SelectFilter;

class TransportadorasResource extends Resource
{
    protected static ?string $model = Transportadoras::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Transportadoras';

    protected static ?string $modelLabel = 'Transportadora';

    protected static ?string $pluralModelLabel = 'Transportadoras';

    protected static ?string $navigationGroup = 'Recursos';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Dados da Empresa')
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
                                    'aprovado'   => 'Aprovado',
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
                                ->required()
                                ->maxLength(50),
                        ]),
                    ]),

                Section::make('Contato')
                    ->schema([
                        Grid::make(2)->schema([
                            Forms\Components\TextInput::make('telefone')
                                ->label('Telefone')
                                ->required()
                                ->maxLength(20),

                            Forms\Components\TextInput::make('email')
                                ->label('E-mail')
                                ->email()
                                ->required()
                                ->maxLength(255),
                        ]),
                    ]),

                Section::make('Endereço')
                    ->schema([
                        Grid::make(2)->schema([
                            Forms\Components\TextInput::make('cep')
                                ->label('CEP')
                                ->required()
                                ->maxLength(10),

                            Forms\Components\TextInput::make('endereco')
                                ->label('Endereço')
                                ->required()
                                ->maxLength(255),
                        ]),

                        Grid::make(3)->schema([
                            Forms\Components\TextInput::make('numero')
                                ->label('Número')
                                ->required()
                                ->maxLength(10),

                            Forms\Components\TextInput::make('complemento')
                                ->label('Complemento')
                                ->maxLength(100),

                            Forms\Components\TextInput::make('bairro')
                                ->label('Bairro')
                                ->required()
                                ->maxLength(100),
                        ]),

                        Grid::make(2)->schema([
                            Forms\Components\TextInput::make('cidade')
                                ->label('Cidade')
                                ->required()
                                ->maxLength(100),

                            Forms\Components\TextInput::make('estado')
                                ->label('Estado')
                                ->required()
                                ->maxLength(50),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->limit(40)
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('cpf_cnpj')
                    ->label('CNPJ/CPF')
                    ->searchable(),

                Tables\Columns\TextColumn::make('telefone')
                    ->label('Telefone'),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'Em análise',
                        'success' => 'aprovado',
                        'danger'  => 'recusado',
                    ]),

                Tables\Columns\TextColumn::make('cidade')
                    ->label('Cidade')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'Em análise' => 'Em Análise',
                        'aprovado'   => 'Aprovado',
                        'recusado'   => 'Recusado',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->striped()
            ->searchPlaceholder('Pesquisar...');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTransportadoras::route('/'),
            'create' => Pages\CreateTransportadoras::route('/create'),
            'edit'   => Pages\EditTransportadoras::route('/{record}/edit'),
        ];
    }
}
