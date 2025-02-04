<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssignmnetResource\Pages;
use App\Filament\Resources\AssignmnetResource\RelationManagers;
use App\Models\Assignmnet;
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
use Filament\Tables\Columns\BadgeColumn;

class AssignmnetResource extends Resource
{
    protected static ?string $model = Assignmnet::class;
    protected static ?string $navigationLabel = 'Asignaciones';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('id_document')
                ->label('Documento Asignado')
                ->relationship('document', 'name')
                ->required(),

            Select::make('id_usuario')
                ->label('Usuario Asignado')
                ->relationship('user', 'name')
                ->required(),

            DateTimePicker::make('fecha_asignacion')
                ->label('Fecha de Asignación')
                ->required(),

            DateTimePicker::make('fecha_vencimiento')
                ->label('Fecha de Vencimiento')
                ->required(),

            TextInput::make('instruccion')
                ->label('Instrucción')
                ->required(),

            TextInput::make('estado')
                ->label('Estado')
                ->required(),

            DateTimePicker::make('fecha_devolucion')
                ->label('Fecha de Devolución'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('document.name')
                    ->label('Documento'),

                TextColumn::make('user.name')
                    ->label('Usuario Asignado'),

                TextColumn::make('fecha_asignacion')
                    ->label('Fecha de Asignación')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('fecha_vencimiento')
                    ->label('Fecha de Vencimiento')
                    ->dateTime()
                    ->sortable(),

                BadgeColumn::make('estado')
                    ->label('Estado')
                    ->colors([
                        'success' => 'Completado',
                        'warning' => 'Pendiente',
                        'danger' => 'Vencido',
                    ]),
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
            RelationManagers\HistoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssignmnets::route('/'),
            'create' => Pages\CreateAssignmnet::route('/create'),
            'edit' => Pages\EditAssignmnet::route('/{record}/edit'),
        ];
    }
}
