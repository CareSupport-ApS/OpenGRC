<?php

namespace App\Filament\Resources\ControlResource\Pages;

use App\Filament\Resources\ControlResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Livewire\Attributes\On;


class EditControl extends EditRecord
{
    protected static string $resource = ControlResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Edit Control';
    }

    public function getRelationManagers(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        $record = $this->record;

        // If a parent_control_id exists, redirect to the parent's view page
        if ($record->parent_control_id) {
            return ControlResource::getUrl('view', ['record' => $record->parent_control_id]);
        }

        // Default redirect (e.g. stay on the same record)
        return ControlResource::getUrl('view', ['record' => $record]);
    }
}
