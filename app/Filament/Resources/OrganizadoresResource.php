<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizadoresResource\Pages;
use App\Models\Organizadores;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\SelectFilter;

class OrganizadoresResource extends Resource
{
    protected static ?string $model = Organizadores::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Organizadores';

    protected static ?string $modelLabel = 'Organizador';

    protected static ?string $pluralModelLabel = 'Organizadores';

    protected static ?string $navigationGroup = 'Recursos';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Dados do Organizador')
                    ->schema([
                        Grid::make(2)->schema([
                            Forms\Components\Select::make('tipo_cadastro')
                                ->label('Tipo de Cadastro')
                                ->options([
                                    'Pessoa_juridica' => 'Pessoa Jurídica',
                                    'Pessoa_fisica'   => 'Pessoa Física',
                                ])
                                ->required()
                                ->native(false),

                            Forms\Components\Select::make('status')
                                ->label('Status')
                                ->options([
                                    'Em análise' => 'Em Análise',
                                    'liberado'   => 'Liberado',
                                    'regular'    => 'Regular',
                                    'recusado'   => 'Recusado',
                                ])
                                ->default('Em análise')
                                ->native(false),
                        ]),

                        Grid::make(2)->schema([
                            Forms\Components\TextInput::make('razao_social_nome')
                                ->label('Razão Social / Nome')
                                ->required()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('nome_fantasia')
                                ->label('Nome Fantasia')
                                ->maxLength(255),
                        ]),

                        Grid::make(3)->schema([
                            Forms\Components\TextInput::make('cnpj_cpf')
                                ->label('CNPJ / CPF')
                                ->required()
                                ->maxLength(20),

                            Forms\Components\TextInput::make('inscricao_municipal_numero')
                                ->label('Inscrição Municipal')
                                ->maxLength(50),

                            Forms\Components\TextInput::make('inscricao_estadual')
                                ->label('Inscrição Estadual')
                                ->maxLength(50),
                        ]),
                    ]),

                Section::make('Contato')
                    ->schema([
                        Grid::make(2)->schema([
                            Forms\Components\TextInput::make('telefone_celular')
                                ->label('Telefone Celular')
                                ->required()
                                ->maxLength(20),

                            Forms\Components\TextInput::make('telefone_fixo')
                                ->label('Telefone Fixo')
                                ->maxLength(20),
                        ]),

                        Grid::make(3)->schema([
                            Forms\Components\TextInput::make('nome_responsavel')
                                ->label('Nome do Responsável')
                                ->required()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('email_responsavel')
                                ->label('E-mail do Responsável')
                                ->email()
                                ->required()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('telefone_responsavel')
                                ->label('Telefone do Responsável')
                                ->required()
                                ->maxLength(20),
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
                            Forms\Components\TextInput::make('complemento')
                                ->label('Complemento')
                                ->maxLength(100),

                            Forms\Components\TextInput::make('bairro')
                                ->label('Bairro')
                                ->required()
                                ->maxLength(100),

                            Forms\Components\TextInput::make('municipio')
                                ->label('Município')
                                ->required()
                                ->maxLength(100),
                        ]),

                        Forms\Components\TextInput::make('estado')
                            ->label('Estado')
                            ->required()
                            ->maxLength(50),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),

                Tables\Columns\TextColumn::make('razao_social_nome')
                    ->label('Nome / Razão Social')
                    ->searchable()
                    ->limit(40)
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('nome_fantasia')
                    ->label('Nome Fantasia')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('cnpj_cpf')
                    ->label('CNPJ/CPF')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'Em análise',
                        'success' => fn ($state) => in_array($state, ['liberado', 'regular']),
                        'danger'  => 'recusado',
                    ]),

                Tables\Columns\TextColumn::make('municipio')
                    ->label('Município'),

                Tables\Columns\TextColumn::make('telefone_celular')
                    ->label('Telefone'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Em análise' => 'Em Análise',
                        'liberado'   => 'Liberado',
                        'regular'    => 'Regular',
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
            'index'  => Pages\ListOrganizadores::route('/'),
            'create' => Pages\CreateOrganizadores::route('/create'),
            'edit'   => Pages\EditOrganizadores::route('/{record}/edit'),
        ];
    }
}
