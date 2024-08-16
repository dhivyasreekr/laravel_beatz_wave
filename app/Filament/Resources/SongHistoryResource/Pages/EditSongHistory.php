<?php

namespace App\Filament\Resources\SongHistoryResource\Pages;

use App\Filament\Resources\SongHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSongHistory extends EditRecord
{
    protected static string $resource = SongHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
