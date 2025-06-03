<?php

namespace App\Filament\Resources;

use App\Enums\VendorType;
use App\Filament\Resources\VendorResource\Pages;
use App\Filament\Resources\VendorResource\RelationManagers;
use App\Models\Vendor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 50;

    public static function getNavigationLabel(): string
    {
        return __('vendor.navigation.label');
    }

    public static function getModelLabel(): string
    {
        return __('vendor.model.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('vendor.model.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\Section::make('General Information')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('engagement_date'),
                        Forms\Components\Select::make('vendor_type')
                            ->enum(VendorType::class)
                            ->options(VendorType::class)
                            ->native(false),
                        Forms\Components\TextInput::make('business_area'),
                    ]),

                Forms\Components\Section::make('Internal Owner')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('internal_owner_name'),
                        Forms\Components\TextInput::make('internal_owner_email')->email(),
                        Forms\Components\TextInput::make('internal_owner_role'),
                    ]),

                Forms\Components\Section::make('Security & Compliance')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Toggle::make('is_data_processor'),
                        Forms\Components\Toggle::make('is_personal_data_processor'),
                        Forms\Components\Toggle::make('is_critical_business_data_processor'),
                        Forms\Components\Toggle::make('gdpr_compliant'),
                        Forms\Components\Toggle::make('has_dpa'),
                        Forms\Components\Toggle::make('has_contract'),
                    ]),

                Forms\Components\Section::make('Key Contact')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('key_contact_name'),
                        Forms\Components\TextInput::make('key_contact_email')->email(),
                        Forms\Components\TextInput::make('key_contact_role'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('business_area')
                    ->sortable(),
                Tables\Columns\TextColumn::make('vendor_type')
                    ->badge()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_data_processor')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_dpa')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_personal_data_processor')->boolean(),
                Tables\Columns\IconColumn::make('is_critical_business_data_processor')->boolean(),
                Tables\Columns\IconColumn::make('gdpr_compliant')->boolean(),
                Tables\Columns\IconColumn::make('has_contract')->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('vendor_type')
                    ->options(VendorType::class),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\SystemsRelationManager::class,
            RelationManagers\AttachmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVendors::route('/'),
            'create' => Pages\CreateVendor::route('/create'),
            'view' => Pages\ViewVendor::route('/{record}'),
            'edit' => Pages\EditVendor::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    /**
     * @param  Vendor  $record
     */
    public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
    {
        return $record->name;
    }
}
