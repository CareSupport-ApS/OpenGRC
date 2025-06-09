<?php

namespace App\Filament\Widgets;

use App\Enums\TaskStatus;
use App\Models\ImplementationTask;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\HtmlString;

class ImplementationTaskListWidget extends BaseWidget
{
    protected int|string|array $columnSpan = '2';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ImplementationTask::query()->where('status', TaskStatus::PENDING)
            )
            ->heading('Implementation Tasks')
            ->emptyStateHeading(new HtmlString('No tasks'))
            ->columns([
                Tables\Columns\TextColumn::make('implementation.title')
                    ->label('Implementation'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Task')
                    ->limit(100),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('task_date')
                    ->label('Due Date'),
            ])
            ->paginated(false);
    }
}
