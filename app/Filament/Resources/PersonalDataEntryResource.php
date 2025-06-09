<?php

namespace App\Filament\Resources;

use App\Enums\DataSubjectCategory;
use App\Enums\PersonalDataType;
use App\Models\PersonalDataEntry;
use App\Filament\Resources\PersonalDataEntryResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PersonalDataEntryResource extends Resource
{
    protected static ?string $model = PersonalDataEntry::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'Foundations';

    public static function getNavigationLabel(): string
    {
        return __('personal-data-entry.navigation.label');
    }

    public static function getNavigationGroup(): string
    {
        return __('personal-data-entry.navigation.group');
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
                    ->columnSpanFull()
                    ->rows(3),
                Forms\Components\Select::make('subject_category')
                    ->required()
                    ->columnSpanFull()
                    ->options(array_combine(
                        array_column(DataSubjectCategory::cases(), 'value'),
                        array_map(fn($case) => $case->getLabel(), DataSubjectCategory::cases())
                    )),
                Forms\Components\CheckboxList::make('data_types')
                    ->columnSpanFull()
                    ->options(array_combine(
                        array_column(PersonalDataType::cases(), 'value'),
                        array_map(fn($case) => $case->getLabel(), PersonalDataType::cases())
                    ))
                    ->columns(2)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
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
            ->defaultSort('id', 'asc')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPersonalDataEntries::route('/'),
            'create' => Pages\CreatePersonalDataEntry::route('/create'),
            'view' => Pages\ViewPersonalDataEntry::route('/{record}'),
            'edit' => Pages\EditPersonalDataEntry::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery();
    }
}
