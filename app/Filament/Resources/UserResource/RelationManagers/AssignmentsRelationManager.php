<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\RelationManagers\RelationManagerConfig;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class AssignmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'assignments';

    public function configure(RelationManagerConfig $config): void
    {
        $config
            ->form([
                TextInput::make('id_document')
                    ->label('ID del Documento')
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
            ])
            ->table([
                TextColumn::make('id_document')
                    ->label('Documento Asignado'),

                TextColumn::make('fecha_asignacion')
                    ->label('Asignado en')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('fecha_vencimiento')
                    ->label('Fecha Límite')
                    ->dateTime()
                    ->sortable(),

                BadgeColumn::make('estado')
                    ->label('Estado')
                    ->colors([
                        'success' => 'Completado',
                        'warning' => 'Pendiente',
                        'danger' => 'Vencido',
                    ]),
            ]);
    }
}
