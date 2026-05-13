<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IngressoEspecialResource\Pages;
use App\Models\IngressoEspecial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class IngressoEspecialResource extends Resource
{
    protected static ?string $model = IngressoEspecial::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'Ingresso Especiais';

    protected static ?string $modelLabel = 'Ingresso Especial';

    protected static ?string $pluralModelLabel = 'Ingressos Especiais';

    protected static ?string $navigationGroup = 'Recursos';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informações')->schema([
                Grid::make(2)->schema([
                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options(['Em análise'=>'Em Análise','liberado'=>'Liberado','recusado'=>'Recusado'])
                        ->default('Em análise')->native(false),
                    Forms\Components\TextInput::make('organizador_esp')->label('Organizador')->maxLength(255),
                ]),
                Grid::make(3)->schema([
                    Forms\Components\TextInput::make('cpf_cnpj')->label('CPF/CNPJ')->maxLength(20),
                    Forms\Components\TextInput::make('numero_cadastro_turismo')->label('Nº Cadastro Turismo')->maxLength(50),
                    Forms\Components\Select::make('motivo_visita')->label('Motivo')->options(['turistico'=>'Turístico','religioso'=>'Religioso','profissional'=>'Profissional','outros'=>'Outros'])->native(false),
                ]),
            ]),
            Section::make('Veículo e Viagem')->schema([
                Grid::make(3)->schema([
                    Forms\Components\Select::make('tipo_veiculo')->label('Tipo Veículo')->options(['onibus'=>'Ônibus','micro_onibus'=>'Micro-ônibus','van'=>'Van'])->native(false),
                    Forms\Components\TextInput::make('placa_veiculo')->label('Placa')->maxLength(10),
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
            ]),
            Section::make('Endereço')->schema([
                Grid::make(2)->schema([
                    Forms\Components\TextInput::make('endereco')->label('Endereço')->maxLength(255),
                    Forms\Components\TextInput::make('cep')->label('CEP')->maxLength(10),
                ]),
                Grid::make(3)->schema([
                    Forms\Components\TextInput::make('bairro')->label('Bairro')->maxLength(100),
                    Forms\Components\TextInput::make('cidade')->label('Cidade')->maxLength(100),
                    Forms\Components\TextInput::make('estado')->label('Estado')->maxLength(50),
                ]),
                Forms\Components\TextInput::make('telefone')->label('Telefone')->maxLength(20),
            ]),
            Section::make('Documentos')->schema([
                Forms\Components\Textarea::make('observacao')->label('Observação')->rows(3),
                Forms\Components\FileUpload::make('comprovante')->label('Comprovante')->disk('public')->directory('ingresso-especial')->acceptedFileTypes(['image/jpeg','image/png','application/pdf']),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('organizador_esp')->label('Organizador')->searchable()->limit(35),
                Tables\Columns\BadgeColumn::make('status')->colors(['warning'=>'Em análise','success'=>'liberado','danger'=>'recusado']),
                Tables\Columns\TextColumn::make('placa_veiculo')->label('Placa'),
                Tables\Columns\TextColumn::make('destino')->label('Destino'),
                Tables\Columns\TextColumn::make('data_chegada')->label('Chegada')->date('d/m/Y'),
                Tables\Columns\TextColumn::make('data_saida')->label('Saída')->date('d/m/Y'),
            ])
            ->defaultSort('id','desc')
            ->actions([Tables\Actions\EditAction::make(),Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->striped()
            ->searchPlaceholder('Pesquisar...');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListIngressoEspecial::route('/'),
            'create' => Pages\CreateIngressoEspecial::route('/create'),
            'edit'   => Pages\EditIngressoEspecial::route('/{record}/edit'),
        ];
    }
}
