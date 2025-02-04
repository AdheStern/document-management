<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\RelationManagers\RelationManagerConfig;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;

class HistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'histories';

    public function configure(RelationManagerConfig $config): void
    {
        $config
            ->form([
                TextInput::make('id_document')
                    ->label('ID del Documento')
                    ->required(),

                TextInput::make('id_asignacion')
                    ->label('ID de la Asignación')
                    ->required(),

                TextInput::make('tipo_accion')
                    ->label('Tipo de Acción')
                    ->required(),

                Textarea::make('detalle')
                    ->label('Detalles')
                    ->required(),

                DateTimePicker::make('fecha')
                    ->label('Fecha del Evento')
                    ->required(),
            ])
            ->table([
                TextColumn::make('id_document')
                    ->label('Documento'),

                TextColumn::make('id_asignacion')
                    ->label('Asignación'),

                TextColumn::make('tipo_accion')
                    ->label('Acción'),

                TextColumn::make('detalle')
                    ->label('Detalles')
                    ->limit(50),

                TextColumn::make('fecha')
                    ->label('Fecha')
                    ->dateTime()
                    ->sortable(),
            ]);
    }
}
