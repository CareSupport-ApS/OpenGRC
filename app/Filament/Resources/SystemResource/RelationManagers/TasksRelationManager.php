<?php

namespace App\Filament\Resources\SystemResource\RelationManagers;

use App\Filament\Resources\TaskResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';

    public static ?string $title = 'Tasks';

    public function form(Form $form): Form
    {
        return TaskResource::form($form);
    }

    public function table(Table $table): Table
    {
        return TaskResource::table($table)
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
