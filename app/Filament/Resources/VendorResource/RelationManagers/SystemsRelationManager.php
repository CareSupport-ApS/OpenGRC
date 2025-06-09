<?php

namespace App\Filament\Resources\VendorResource\RelationManagers;

use App\Filament\Resources\SystemResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SystemsRelationManager extends RelationManager
{
    protected static string $relationship = 'systems';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return SystemResource::form($form);
    }

    public function table(Table $table): Table
    {
        return SystemResource::table($table)
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->url(fn($record) => SystemResource::getUrl('view', ['record' => $record])),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
