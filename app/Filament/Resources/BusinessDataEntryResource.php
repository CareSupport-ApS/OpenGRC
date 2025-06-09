<?php

namespace App\Filament\Resources;

use App\Enums\BusinessCriticalDataType;
use App\Models\BusinessDataEntry;
use App\Filament\Resources\BusinessDataEntryResource\Pages;
use App\Filament\Resources\RelationManagers\BusinessDataEntriesRelationManager;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BusinessDataEntryResource extends Resource
{
    protected static ?string $model = BusinessDataEntry::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Foundations';

    public static function getNavigationLabel(): string
    {
        return __('business-data-entry.navigation.label');
    }

    public static function getNavigationGroup(): string
    {
        return __('business-data-entry.navigation.group');
    }

    public static function form(Form $form): Form
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('processable.name')
                    ->label('Vendor / system')
                    ->wrap()
                    ->sortable()
                    ->hiddenOn(BusinessDataEntriesRelationManager::class),
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
            ->defaultSort('id', 'asc')
            ->headerActions([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBusinessDataEntries::route('/'),
            'create' => Pages\CreateBusinessDataEntry::route('/create'),
            'view' => Pages\ViewBusinessDataEntry::route('/{record}'),
            'edit' => Pages\EditBusinessDataEntry::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery();
    }
}
