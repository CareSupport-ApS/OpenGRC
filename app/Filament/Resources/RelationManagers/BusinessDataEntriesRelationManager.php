<?php

namespace App\Filament\Resources\RelationManagers;

use App\Enums\BusinessCriticalDataType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class BusinessDataEntriesRelationManager extends RelationManager
{
    protected static string $relationship = 'businessDataEntries';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('process_name')
                    ->label('Process Name')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('purpose')
                    ->label('Purpose')
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\CheckboxList::make('data_types')
                    ->options(array_combine(
                        array_column(BusinessCriticalDataType::cases(), 'value'),
                        array_map(fn($case) => $case->getLabel(), BusinessCriticalDataType::cases())
                    ))
                    ->columns(2)
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('process_name')
                    ->label('Process')
                    ->sortable(),
                Tables\Columns\TextColumn::make('purpose')
                    ->label('Purpose')
                    ->wrap(),
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
