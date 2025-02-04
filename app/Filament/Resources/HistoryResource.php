<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryResource\Pages;
use App\Filament\Resources\HistoryResource\RelationManagers;
use App\Models\History;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class HistoryResource extends Resource
{
    protected static ?string $model = History::class;
    protected static ?string $navigationLabel = 'Historial';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('id_document')
                ->label('Documento')
                ->relationship('document', 'name')
                ->required(),

            Select::make('id_asignacion')
                ->label('Asignación')
                ->relationship('assignment', 'id')
                ->required(),

            Select::make('id_usuario')
                ->label('Usuario')
                ->relationship('user', 'name')
                ->required(),

            TextInput::make('tipo_accion')
                ->label('Tipo de Acción')
                ->required(),

            Textarea::make('detalle')
                ->label('Detalles')
                ->required(),

            FileUpload::make('archivo')
                ->label('Archivo')
                ->disk('public')
                ->directory('history_files') // Guarda en storage/app/public/history_files
                ->acceptedFileTypes(['application/pdf', 'image/*'])
                ->maxSize(10240), // Máx 10MB

            DateTimePicker::make('fecha')
                ->label('Fecha de Acción')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('document.name')
                    ->label('Documento'),

                TextColumn::make('assignment.id')
                    ->label('Asignación'),

                TextColumn::make('user.name')
                    ->label('Usuario'),

                TextColumn::make('tipo_accion')
                    ->label('Acción'),

                TextColumn::make('detalle')
                    ->label('Detalles')
                    ->limit(50),

                TextColumn::make('fecha')
                    ->label('Fecha')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('archivo')
                    ->label('Archivo')
                    ->formatStateUsing(fn (string $state): string =>
                        "<a href='/storage/$state' target='_blank' class='text-blue-500 underline'>Ver Archivo</a>")
                    ->html(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHistories::route('/'),
            'create' => Pages\CreateHistory::route('/create'),
            'edit' => Pages\EditHistory::route('/{record}/edit'),
        ];
    }
}
