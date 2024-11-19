<?php

namespace App\Filament\Resources\OfficeSpacePhotoResource\Pages;

use App\Filament\Resources\OfficeSpacePhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOfficeSpacePhoto extends EditRecord
{
    protected static string $resource = OfficeSpacePhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
