<?php

namespace App\Filament\Resources\VendorResource\RelationManagers;

use App\Filament\Resources\PersonalDataEntryResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Table;

class SystemPersonalDataEntriesRelationManager extends RelationManager
{
    protected static string $relationship = 'systemPersonalDataEntries';

    public function form(Form $form): Form
    {
        return PersonalDataEntryResource::form($form);
    }

    public function table(Table $table): Table
    {
        return PersonalDataEntryResource::table($table)
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}

