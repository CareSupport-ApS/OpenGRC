<?php

namespace App\Filament\Resources\VendorResource\RelationManagers;

use App\Filament\Resources\SystemResource;
use App\Models\Vendor;
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

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('system.table.columns.title'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('security_password_policy_compliant')
                    ->label(__('system.table.columns.security_password_policy_compliant'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('security_sso_connected')
                    ->label(__('system.table.columns.security_sso_connected'))
                    ->boolean(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->url(fn($record) => SystemResource::getUrl('view', ['record' => $record])),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
