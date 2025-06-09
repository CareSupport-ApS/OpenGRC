<?php

namespace App\Filament\Resources;

use App\Enums\TaskRecurrence;
use App\Enums\TaskStatus;
use App\Filament\Resources\TaskResource\Pages;
use App\Models\Attachment;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->visible(fn(string $operation) => $operation === 'create'),
                Forms\Components\DatePicker::make('due_date')
                    ->label('Due Date')
                    ->required()
                    ->visible(fn(string $operation) => $operation === 'create'),
                Forms\Components\Select::make('recurrence')
                    ->options(TaskRecurrence::class)
                    ->default(TaskRecurrence::NONE)
                    ->native(false)
                    ->visible(fn(string $operation) => $operation === 'create'),
                Forms\Components\ToggleButtons::make('status')
                    ->label('Status')
                    ->options(TaskStatus::class)                  // shows enum labels              // default on create
                    ->options(
                        fn(string $operation) =>                  // allowed choices
                        $operation === 'create'
                            ? [TaskStatus::PENDING->value => TaskStatus::PENDING->getLabel()]
                            : [TaskStatus::COMPLETED->value => TaskStatus::COMPLETED->getLabel()]
                    ),
                Forms\Components\Textarea::make('completion_notes')
                    ->columnSpanFull()
                    ->visible(fn(string $operation) => $operation !== 'create'),
                Forms\Components\Hidden::make('attachment_id'),
                Forms\Components\Placeholder::make('attachment_display')
                    ->label('Attachment')
                    ->content(function (?Task $record): string {
                        if (! $record?->attachment) {
                            return '—';
                        }

                        // the file lives on a private disk, so give the user a short-lived URL
                        $url = Storage::disk(config('filesystems.default'))
                            ->temporaryUrl($record->attachment->file_path, now()->addMinutes(5));

                        return '<a href="' . $url . '" target="_blank" class="text-primary-600 underline">'
                            . e($record->attachment->file_name)
                            . '</a>';
                    })
                    ->columnSpanFull()
                    ->visible(fn(string $operation) => $operation === 'view'),
                Forms\Components\FileUpload::make('attachment')
                    ->label('Attachment')
                    ->disk(config('filesystems.default'))
                    ->directory('task-attachments')
                    ->visibility('private')
                    ->preserveFilenames()
                    ->saveUploadedFileUsing(
                        function (
                            TemporaryUploadedFile $file,
                            callable              $set,
                            \App\Models\Task|null $task,
                        ) {

                            // 1. store the binary
                            $path = $file->store('task-attachments', config('filesystems.default'));

                            // 2. Build a pretty display name for the DB column
                            $displayName = $task->due_date->format('Y-m-d') . '-' .
                                Str::slug($task->title) . '.' .
                                $file->getClientOriginalExtension();

                            // 3. Create the attachment on the parent model
                            $attachment = $task->taskable
                                ->attachments()
                                ->create([
                                    'file_name'   => $displayName,   // what you’ll show to users
                                    'file_path'   => $path,          // opaque/random storage path
                                    'file_size'   => $file->getSize(),
                                    'uploaded_by' => auth()->id(),
                                ]);

                            // 3. remember id on the task form data
                            $set('attachment_id', $attachment->id);
                        }
                    )
                    ->dehydrated(false)
                    ->downloadable()
                    ->openable()
                    ->columnSpanFull()
                    ->visible(fn(string $operation) => $operation === 'edit')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('due_date')->label('Due')->date(),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('recurrence'),
            ])->actions([
                Tables\Actions\ViewAction::make(),

                Tables\Actions\EditAction::make()
                    ->visible(
                        fn(Task $record) =>             // shown only if NOT completed
                        $record->status !== TaskStatus::COMPLETED
                    ),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'view' => Pages\ViewTask::route('/{record}'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
