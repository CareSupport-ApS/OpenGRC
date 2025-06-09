<?php

namespace App\Filament\Resources\BusinessDataEntryResource\Pages;

use App\Filament\Resources\BusinessDataEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusinessDataEntries extends ListRecords
{
    protected static string $resource = BusinessDataEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('export')
                ->label('Export')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(fn() => $this->export()),
        ];
    }

    protected function export()
    {
        $records = BusinessDataEntryResource::getModel()::with('processable')->get();

        return response()->streamDownload(function () use ($records) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Process Name', 'Purpose', 'Data Types', 'Processable Type', 'Processable ID']);
            foreach ($records as $record) {
                fputcsv($file, [
                    $record->id,
                    $record->process_name,
                    $record->purpose,
                    implode(',', (array) $record->data_types),
                    class_basename($record->processable_type ?? ''),
                    $record->processable_id,
                ]);
            }
            fclose($file);
        }, 'business-data-entries.csv');
    }
}
