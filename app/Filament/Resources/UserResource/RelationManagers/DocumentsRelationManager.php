<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\RelationManagers\RelationManagerConfig;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    public function configure(RelationManagerConfig $config): void
    {
        $config
            ->form([
                TextInput::make('name')->label('Nombre del Documento')->required(),
            ])
            ->table([
                TextColumn::make('name')->label('Nombre'),
            ]);
    }
}
