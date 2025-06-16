<?php

namespace App\Filament\Resources\IdentitasResource\Pages;

use App\Filament\Resources\IdentitasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIdentitas extends ListRecords
{
    protected static string $resource = IdentitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
