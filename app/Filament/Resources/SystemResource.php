<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SystemResource\Pages;
use App\Models\System;
use App\Models\Vendor;
use App\Filament\Resources\SystemResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SystemResource extends Resource
{
    protected static ?string $model = System::class;

    protected static ?string $navigationIcon = 'heroicon-o-server-stack';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    public static function getNavigationLabel(): string
    {
        return __('system.navigation.label');
    }


    public static function getModelLabel(): string
    {
        return __('system.model.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('system.model.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General Information')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('system.form.title'))
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                        Forms\Components\Select::make('vendor_id')
                            ->label(__('system.form.vendor'))
                            ->options(Vendor::pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Forms\Components\Textarea::make('description')
                            ->label(__('system.form.description'))
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('system_documentation_link')
                            ->label(__('system.form.system_document_link'))
                            ->maxLength(255)
                            ->nullable(),
                    ]),

                Forms\Components\Section::make('Security and compliance')
                    ->columns(3)
                    ->schema([
                        Forms\Components\CheckboxList::make('data_storage')
                            ->label(__('system.form.data_storage'))
                            ->options(array_combine(
                                array_column(\App\Enums\DataStorageType::cases(), 'value'),
                                array_map(fn($case) => $case->getLabel(), \App\Enums\DataStorageType::cases())
                            ))
                            ->columns(2)
                            ->columnSpan(3)
                            ->nullable(),
                        Forms\Components\Toggle::make('security_password_policy_compliant')
                            ->label(__('system.form.security_password_policy_compliant')),
                        Forms\Components\Toggle::make('security_sso_connected')
                            ->label(__('system.form.security_sso_connected')),
                    ]),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('system.table.columns.title'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vendor.name')
                    ->label(__('system.table.columns.vendor'))
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('security_password_policy_compliant')
                    ->label(__('system.table.columns.security_password_policy_compliant'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('security_sso_connected')
                    ->label(__('system.table.columns.security_sso_connected'))
                    ->boolean(),
            ])
            ->filters([
                //
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
            RelationManagers\AttachmentsRelationManager::class,
            RelationManagers\PersonalDataEntriesRelationManager::class,
            RelationManagers\BusinessDataEntriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSystems::route('/'),
            'create' => Pages\CreateSystem::route('/create'),
            'view' => Pages\ViewSystem::route('/{record}'),
            'edit' => Pages\EditSystem::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);
    }

    /**
     * @param  System  $record
     */
    public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
    {
        return $record->title;
    }
}
