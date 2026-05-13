<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IngressoServicosResource\Pages;
use App\Models\IngressoServicos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

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
                Grid::make(2)->schema([
                    Forms\Components\TextInput::make('cpf_cnpj')->label('CPF/CNPJ')->maxLength(20),
                    Forms\Components\Select::make('motivo_visita')->label('Motivo')->options(['profissional'=>'Profissional','servico'=>'Serviço','manutencao'=>'Manutenção','outros'=>'Outros'])->native(false),
                ]),
            ]),
            Section::make('Veículo e Viagem')->schema([
                Grid::make(3)->schema([
                    Forms\Components\Select::make('tipo_veiculo')->label('Tipo Veículo')->options(['onibus'=>'Ônibus','micro_onibus'=>'Micro-ônibus','van'=>'Van','carro'=>'Carro'])->native(false),
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
            Section::make('Documentos')->schema([
                Forms\Components\Textarea::make('observacao')->label('Observação')->rows(3),
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
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
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
