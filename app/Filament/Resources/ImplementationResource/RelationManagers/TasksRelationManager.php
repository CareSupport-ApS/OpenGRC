<?php

namespace App\Filament\Resources\ImplementationResource\RelationManagers;

use App\Enums\TaskRecurrence;
use App\Enums\TaskStatus;
use App\Models\Attachment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';

    public static ?string $title = 'Tasks';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('due_at')
                    ->label('Due Date')
                    ->required(),
                Forms\Components\Select::make('recurrence')
                    ->options(TaskRecurrence::class)
                    ->default(TaskRecurrence::NONE)
                    ->native(false),
                Forms\Components\Select::make('status')
                    ->options(TaskStatus::class)
                    ->default(TaskStatus::PENDING)
                    ->native(false),
                Forms\Components\Textarea::make('completion_notes')
                    ->columnSpanFull(),
                // Forms\Components\Hidden::make('attachment_id'),
                // Forms\Components\FileUpload::make('attachment')
                //     ->label('Attachment')
                //     ->disk(config('filesystems.default'))
                //     ->directory('task-attachments')
                //     ->visibility('private')
                //     ->preserveFilenames()
                //     ->saveUploadedFileUsing(function (TemporaryUploadedFile $file, callable $set) {
                //         $path = $file->store('task-attachments', config('filesystems.default'));
                //         $attachment = Attachment::create([
                //             'file_name' => $file->getClientOriginalName(),
                //             'file_path' => $path,
                //             'file_size' => $file->getSize(),
                //             'uploaded_by' => auth()->id(),
                //         ]);
                //         $set('attachment_id', $attachment->id);
                //     })
                //     ->dehydrateStateUsing(fn () => null)
                //     ->downloadable()
                //     ->openable()
                //     ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('due_at')->label('Due')->date(),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('recurrence'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
