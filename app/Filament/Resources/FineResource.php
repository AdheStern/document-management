<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FineResource\Pages;
use App\Filament\Resources\FineResource\RelationManagers;
use App\Models\Fine;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;

class FineResource extends Resource
{
    protected static ?string $model = Fine::class;
    protected static ?string $navigationLabel = 'Multas';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('id_document')
                ->label('Documento Asociado')
                ->relationship('document', 'name')
                ->required(),

            TextInput::make('monto')
                ->label('Monto de la Multa')
                ->numeric()
                ->required(),

            DateTimePicker::make('fecha_vencimiento')
                ->label('Fecha de Vencimiento')
                ->required(),

            DateTimePicker::make('fecha_registro')
                ->label('Fecha de Registro')
                ->required(),

            TextInput::make('razon')
                ->label('Razón de la Multa')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('document.name')
                    ->label('Documento Asociado'),

                TextColumn::make('monto')
                    ->label('Monto de la Multa')
                    ->sortable(),

                TextColumn::make('fecha_vencimiento')
                    ->label('Fecha de Vencimiento')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('fecha_registro')
                    ->label('Fecha de Registro')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('razon')
                    ->label('Razón')
                    ->limit(50),
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
            'index' => Pages\ListFines::route('/'),
            'create' => Pages\CreateFine::route('/create'),
            'edit' => Pages\EditFine::route('/{record}/edit'),
        ];
    }
}
