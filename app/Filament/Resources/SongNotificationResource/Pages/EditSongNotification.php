<?php

namespace App\Filament\Resources\SongNotificationResource\Pages;

use App\Filament\Resources\SongNotificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSongNotification extends EditRecord
{
    protected static string $resource = SongNotificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
