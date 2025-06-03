<?php

namespace App\Filament\Resources\SystemResource\RelationManagers;

use App\Enums\DataSubjectCategory;
use App\Enums\PersonalDataType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PersonalDataEntriesRelationManager extends RelationManager
{
    protected static string $relationship = 'personalDataEntries';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('subject_category')
                    ->required()
                    ->options(array_combine(
                        array_column(DataSubjectCategory::cases(), 'value'),
                        array_map(fn($case) => $case->getLabel(), DataSubjectCategory::cases())
                    )),
                Forms\Components\CheckboxList::make('data_types')
                    ->options(array_combine(
                        array_column(PersonalDataType::cases(), 'value'),
                        array_map(fn($case) => $case->getLabel(), PersonalDataType::cases())
                    ))
                    ->columns(2)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject_category')
                    ->label('Category')
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_types')
                    ->label('Data Types')
                    ->formatStateUsing(fn($state) => is_array($state) ? implode(', ', $state) : $state)
                    ->wrap(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
