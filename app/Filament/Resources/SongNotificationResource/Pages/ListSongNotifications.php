<?php

namespace App\Filament\Resources\SongNotificationResource\Pages;

use App\Filament\Resources\SongNotificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSongNotifications extends ListRecords
{
    protected static string $resource = SongNotificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
