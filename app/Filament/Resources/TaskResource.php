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
use Filament\Tables\Table;
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
                    ->visible(fn (string $operation) => $operation === 'create'),
                Forms\Components\DatePicker::make('due_date')
                    ->label('Due Date')
                    ->required()
                    ->visible(fn (string $operation) => $operation === 'create'),
                Forms\Components\Select::make('recurrence')
                    ->options(TaskRecurrence::class)
                    ->default(TaskRecurrence::NONE)
                    ->native(false)
                    ->visible(fn (string $operation) => $operation === 'create'),
                Forms\Components\Select::make('status')
                    ->options(TaskStatus::class)
                    ->default(TaskStatus::PENDING)
                    ->native(false)
                    ->visible(fn (string $operation) => $operation !== 'create'),
                Forms\Components\Textarea::make('completion_notes')
                    ->columnSpanFull()
                    ->visible(fn (string $operation) => $operation !== 'create'),
                Forms\Components\Hidden::make('attachment_id'),
                Forms\Components\FileUpload::make('attachment')
                    ->label('Attachment')
                    ->disk(config('filesystems.default'))
                    ->directory('task-attachments')
                    ->visibility('private')
                    ->preserveFilenames()
                    ->saveUploadedFileUsing(function (TemporaryUploadedFile $file, callable $set) {
                        $path = $file->store('task-attachments', config('filesystems.default'));
                        $attachment = Attachment::create([
                            'file_name' => $file->getClientOriginalName(),
                            'file_path' => $path,
                            'file_size' => $file->getSize(),
                            'uploaded_by' => auth()->id(),
                        ]);
                        $set('attachment_id', $attachment->id);
                    })
                    ->dehydrateStateUsing(fn () => null)
                    ->downloadable()
                    ->openable()
                    ->columnSpanFull()
                    ->visible(fn (string $operation) => $operation !== 'create'),
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
