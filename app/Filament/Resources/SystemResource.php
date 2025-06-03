<?php

namespace App\Filament\Resources;

use App\Enums\YesNoNa;
use App\Filament\Resources\SystemResource\Pages;
use App\Models\System;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SystemResource extends Resource
{
    protected static ?string $model = System::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $navigationLabel = null;

    public static function getNavigationLabel(): string
    {
        return __('system.navigation.label');
    }

    public static function getNavigationGroup(): string
    {
        return __('implementation.navigation.group');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('system.form.title'))
                    ->required(),
                Forms\Components\Select::make('vendor_id')
                    ->relationship('vendor', 'supplier')
                    ->label(__('system.form.vendor'))
                    ->searchable()
                    ->preload()
                    ->nullable(),
                Forms\Components\Textarea::make('description')
                    ->label(__('system.form.description'))
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('logo_url')
                    ->label(__('system.form.logo_url'))
                    ->nullable(),
                Forms\Components\TextInput::make('system_document_link')
                    ->label(__('system.form.system_document_link'))
                    ->nullable(),
                Forms\Components\Select::make('security_password_policy_compliant')
                    ->label(__('system.form.security_password_policy_compliant'))
                    ->options(YesNoNa::class)
                    ->default(YesNoNa::NA),
                Forms\Components\Select::make('security_sso_connected')
                    ->label(__('system.form.security_sso_connected'))
                    ->options(YesNoNa::class)
                    ->default(YesNoNa::NA),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('system.table.title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('vendor.supplier')
                    ->label(__('system.table.vendor')),
                Tables\Columns\TextColumn::make('security_password_policy_compliant')
                    ->label(__('system.table.security_password_policy_compliant'))
                    ->badge(),
                Tables\Columns\TextColumn::make('security_sso_connected')
                    ->label(__('system.table.security_sso_connected'))
                    ->badge(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSystems::route('/'),
            'create' => Pages\CreateSystem::route('/create'),
            'edit' => Pages\EditSystem::route('/{record}/edit'),
        ];
    }
}
