<?php

namespace App\Filament\Resources\SongHistoryResource\Pages;

use App\Filament\Resources\SongHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSongHistories extends ListRecords
{
    protected static string $resource = SongHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
