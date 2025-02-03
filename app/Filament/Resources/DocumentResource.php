<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nombre del Documento')
                    ->required(),
                    
                TextInput::make('type')
                    ->label('Tipo de Documento')
                    ->required(),

                TextInput::make('state')
                    ->label('Estado')
                    ->required(),

                FileUpload::make('content')
                    ->label('Archivo PDF')
                    ->disk('public') // Almacenar en storage/app/public
                    ->directory('documents') // Carpeta donde se guardarán los archivos
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(5120) // 5MB
                    ->required(),

                TextInput::make('user_id')
                    ->label('ID de Usuario')
                    ->required(),

                DateTimePicker::make('reception_at')
                    ->label('Fecha de Recepción')
                    ->required(),

                DateTimePicker::make('delivery_at')
                    ->label('Fecha de Entrega')
                    ->required(),

                DateTimePicker::make('deadline')
                    ->label('Fecha Límite')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre'),

                TextColumn::make('type')
                    ->label('Tipo'),

                TextColumn::make('state')
                    ->label('Estado'),

                TextColumn::make('content')
                    ->label('Archivo PDF')
                    ->formatStateUsing(fn (string $state, Model $record) => 
                        "<a href='/storage/$state' target='_blank' class='text-blue-500 underline'>Ver PDF</a>"
                    )->html(),

                TextColumn::make('user_id')
                    ->label('Usuario'),

                TextColumn::make('reception_at')
                    ->label('Recepción')
                    ->dateTime(),

                TextColumn::make('delivery_at')
                    ->label('Entrega')
                    ->dateTime(),

                TextColumn::make('deadline')
                    ->label('Fecha Límite')
                    ->dateTime(),
            ])
            ->filters([
                // Puedes agregar filtros aquí si lo necesitas
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
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
