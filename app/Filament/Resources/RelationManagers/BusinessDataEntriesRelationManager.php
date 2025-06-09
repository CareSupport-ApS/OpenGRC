<?php

namespace App\Filament\Resources\RelationManagers;

use App\Filament\Resources\BusinessDataEntryResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class BusinessDataEntriesRelationManager extends RelationManager
{
    protected static string $relationship = 'businessDataEntries';

    public function form(Form $form): Form
    {
        return BusinessDataEntryResource::form($form);
    }

    public function table(Table $table): Table
    {
        return BusinessDataEntryResource::table($table);
    }
}
