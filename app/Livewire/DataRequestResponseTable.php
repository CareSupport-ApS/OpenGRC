<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use App\Models\DataRequestResponse;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Enums\ResponseStatus;
use Filament\Forms\Contracts\HasForms;

class DataRequestResponseTable extends Component implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected function getTableQuery(): Builder
    {
        return DataRequestResponse::query()
            ->where('requestee_id', auth()->id());
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
            Tables\Columns\TextColumn::make('dataRequest.audit.title')->label('Audit'),
            Tables\Columns\TextColumn::make('dataRequest.details')->label('Requested Information')->html()->limit(100),
            Tables\Columns\TextColumn::make('due_at')->label('Due At')->dateTime(),
            Tables\Columns\TextColumn::make('status')->label('Status'),
        ];
    }


    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('view')
                ->label('Respond')
                ->url(
                    fn(DataRequestResponse $record) =>
                    route('filament.app.resources.data-request-responses.edit', $record),
                ),
        ];
    }



    public function render()
    {
        return view('livewire.data-request-response-table');
    }
}
