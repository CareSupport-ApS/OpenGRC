<?php

namespace App\Filament\Resources\VendorResource\RelationManagers;

use App\Filament\Resources\BusinessDataEntryResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Table;

class SystemBusinessDataEntriesRelationManager extends RelationManager
{
    protected static string $relationship = 'systemBusinessDataEntries';

    public function form(Form $form): Form
    {
        return BusinessDataEntryResource::form($form);
    }

    public function table(Table $table): Table
    {
        return BusinessDataEntryResource::table($table)->description('Showing processing activities belonging to associated systems')->paginated(false);;
    }
}
