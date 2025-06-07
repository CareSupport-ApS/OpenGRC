<?php

namespace App\Filament\Resources\VendorResource\RelationManagers;

use App\Filament\Resources\RelationManagers\BaseAttachmentsRelationManager;

class AttachmentsRelationManager extends BaseAttachmentsRelationManager
{
    protected static string $relationship = 'attachments';
    protected static string $directory = 'vendor-attachment';
}
