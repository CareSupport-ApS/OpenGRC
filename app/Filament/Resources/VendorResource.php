<?php

namespace App\Filament\Resources;

use App\Enums\YesNoNa;
use App\Filament\Resources\VendorResource\Pages;
use App\Filament\Resources\VendorResource\RelationManagers;
use App\Models\Vendor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationLabel = null;

    public static function getNavigationLabel(): string
    {
        return __('navigation.resources.vendor');
    }

    public static function getNavigationGroup(): string
    {
        return __('implementation.navigation.group');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\Section::make('General Information')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('supplier')
                            ->label(__('vendor.form.supplier')),
                        Forms\Components\TextInput::make('system')
                            ->label(__('vendor.form.system')),
                        Forms\Components\DatePicker::make('start_date')
                            ->label(__('vendor.form.start_date')),
                        Forms\Components\Select::make('type')
                            ->label(__('vendor.form.type'))
                            ->options([
                                'Third-party consultants / experts' => 'Third-party consultants / experts',
                                'Managed services' => 'Managed services',
                                'Cloud / SaaS system' => 'Cloud / SaaS system',
                            ]),
                        Forms\Components\Textarea::make('description')
                            ->label(__('vendor.form.description'))
                            ->columnSpanFull(),
                    ])->columnSpanFull(),
                Forms\Components\Section::make('Internal Ownership')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('owner_name')
                            ->label(__('vendor.form.owner_name')),
                        Forms\Components\TextInput::make('owner_role')
                            ->label(__('vendor.form.owner_role')),
                        Forms\Components\TextInput::make('owner_email')
                            ->label(__('vendor.form.owner_email')),
                        Forms\Components\TextInput::make('business_area')
                            ->label(__('vendor.form.business_area'))
                            ->columnSpanFull(),
                    ])->columnSpanFull(),
                Forms\Components\Section::make('Roles')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('business_process_owner')
                            ->label(__('vendor.form.business_process_owner')),
                        Forms\Components\TextInput::make('system_owner')
                            ->label(__('vendor.form.system_owner')),
                        Forms\Components\TextInput::make('primary_user')
                            ->label(__('vendor.form.primary_user')),
                        Forms\Components\TextInput::make('primary_it')
                            ->label(__('vendor.form.primary_it')),
                    ])->columnSpanFull(),
                Forms\Components\Section::make('Security')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('it_security_policy')
                            ->label(__('vendor.form.it_security_policy'))
                            ->options(YesNoNa::class),
                        Forms\Components\Select::make('sso_ad')
                            ->label(__('vendor.form.sso_ad'))
                            ->options(YesNoNa::class),
                        Forms\Components\Select::make('password_policy')
                            ->label(__('vendor.form.password_policy'))
                            ->options(YesNoNa::class),
                        Forms\Components\Select::make('iso27001')
                            ->label(__('vendor.form.iso27001'))
                            ->options(YesNoNa::class),
                    ])->columnSpanFull(),
                Forms\Components\Section::make('Documentation')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Select::make('contract_collected')
                            ->label(__('vendor.form.contract_collected'))
                            ->options(YesNoNa::class),
                        Forms\Components\TextInput::make('contract_location')
                            ->label(__('vendor.form.contract_location')),
                        Forms\Components\Textarea::make('contract_justification')
                            ->label(__('vendor.form.contract_justification')),
                        Forms\Components\Select::make('sla_collected')
                            ->label(__('vendor.form.sla_collected'))
                            ->options(YesNoNa::class),
                        Forms\Components\TextInput::make('sla_location')
                            ->label(__('vendor.form.sla_location')),
                        Forms\Components\Textarea::make('sla_justification')
                            ->label(__('vendor.form.sla_justification')),
                        Forms\Components\Select::make('dpa_collected')
                            ->label(__('vendor.form.dpa_collected'))
                            ->options(YesNoNa::class),
                        Forms\Components\TextInput::make('dpa_location')
                            ->label(__('vendor.form.dpa_location')),
                        Forms\Components\Textarea::make('dpa_justification')
                            ->label(__('vendor.form.dpa_justification')),
                        Forms\Components\Select::make('privacy_policy_collected')
                            ->label(__('vendor.form.privacy_policy_collected'))
                            ->options(YesNoNa::class),
                        Forms\Components\TextInput::make('privacy_policy_location')
                            ->label(__('vendor.form.privacy_policy_location')),
                        Forms\Components\Textarea::make('privacy_policy_justification')
                            ->label(__('vendor.form.privacy_policy_justification')),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('supplier')
                    ->label(__('vendor.table.supplier'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('system')
                    ->label(__('vendor.table.system'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('vendor.table.type')),
                Tables\Columns\TextColumn::make('start_date')
                    ->label(__('vendor.table.start_date'))
                    ->date(),
                Tables\Columns\TextColumn::make('owner_name')
                    ->label(__('vendor.table.owner_name')),
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

    public static function getRelations(): array
    {
        return [
            RelationManagers\SystemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVendors::route('/'),
            'create' => Pages\CreateVendor::route('/create'),
            'edit' => Pages\EditVendor::route('/{record}/edit'),
        ];
    }
}
