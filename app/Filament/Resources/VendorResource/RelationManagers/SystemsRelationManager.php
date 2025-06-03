<?php

namespace App\Filament\Resources\VendorResource\RelationManagers;

use App\Enums\YesNoNa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SystemsRelationManager extends RelationManager
{
    protected static string $relationship = 'systems';

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('logo_url'),
                Forms\Components\TextInput::make('system_document_link'),
                Forms\Components\Select::make('security_password_policy_compliant')
                    ->options(YesNoNa::class)
                    ->default(YesNoNa::NA),
                Forms\Components\Select::make('security_sso_connected')
                    ->options(YesNoNa::class)
                    ->default(YesNoNa::NA),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('security_password_policy_compliant')
                    ->badge(),
                Tables\Columns\TextColumn::make('security_sso_connected')
                    ->badge(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
