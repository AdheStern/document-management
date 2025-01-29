<?php

namespace App\Filament\Resources\AssignmnetResource\Pages;

use App\Filament\Resources\AssignmnetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssignmnet extends EditRecord
{
    protected static string $resource = AssignmnetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
