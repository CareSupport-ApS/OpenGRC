<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ToDo extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-check-circle';
    protected static string $view = 'filament.pages.to-do';

    public static function getNavigationLabel(): string
    {
        return __('navigation.menu.todo');
    }

    public static function getNavigationBadge(): ?string
    {
        $pendingResponses = auth()->user()->openTodos()->count();
        $pendingTasks     = \App\Models\ImplementationTask::where('status', \App\Enums\TaskStatus::PENDING)->count();

        $count = $pendingResponses + $pendingTasks;

        if ($count > 99) {
            return '99+';
        }

        return $count ?: null;
    }
}
