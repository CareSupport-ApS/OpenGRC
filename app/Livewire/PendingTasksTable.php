<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ImplementationTask;
use App\Enums\TaskStatus;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;

class PendingTasksTable extends Component implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected function getTableQuery(): Builder
    {
        return ImplementationTask::query()
            ->where('status', TaskStatus::PENDING);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('title')->label('Task'),
            Tables\Columns\TextColumn::make('due_at')->label('Due At')->dateTime(),
            TextColumn::make('recurrence')->label('Recurrence')->badge(),
            Tables\Columns\TextColumn::make('status')->label('Status')->badge(),

        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('view')
                ->label('View task')
                ->url(
                    fn(ImplementationTask $record) =>
                    route('filament.app.resources.implementations.view', [$record->implementation,  'activeRelationManager' => 3]),
                ),
        ];
    }

    public function render()
    {
        return view('livewire.pending-tasks-table');
    }
}
