<?php

namespace App\Filament\Resources\ControlResource\RelationManagers;

use App\Enums\Effectiveness;
use App\Enums\ImplementationStatus;
use App\Filament\Resources\ImplementationResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ImplementationRelationManager extends RelationManager
{
    protected static string $relationship = 'Implementations';

    public function form(Form $form): Form
    {
        return ImplementationResource::form($form)->columns(2);
    }

    public function table(Table $table): Table
    {
        return ImplementationResource::table($table)
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->label('Add Existing Implementation')
                    ->preloadRecordSelect()
                    ->recordSelectOptionsQuery(function (Builder $query) {
                        $query->select(['id', 'title']);
                    })
                    ->recordTitle(fn ($record) => $record->title)
                    ->recordSelectSearchColumns(['title']),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\DetachBulkAction::make()->label('Detach from this Control'),
                ]),
            ]);
    }
}
