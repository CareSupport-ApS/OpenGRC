<?php

namespace App\Filament\Widgets;

use App\Enums\TaskStatus;
use App\Models\Task;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\HtmlString;

class TaskListWidget extends BaseWidget
{
    protected int|string|array $columnSpan = '2';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Task::query()->where('status', TaskStatus::PENDING)
            )
            ->heading('Tasks')
            ->emptyStateHeading(new HtmlString('No tasks'))
            ->columns([
                Tables\Columns\TextColumn::make('taskable_type')
                    ->label('Type')
                    ->formatStateUsing(fn(string $state) => class_basename($state)),
                Tables\Columns\TextColumn::make('title')
                    ->label('Task')
                    ->limit(100),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('due_date')
                    ->label('Due Date'),
            ])
            ->paginated(false);
    }
}
