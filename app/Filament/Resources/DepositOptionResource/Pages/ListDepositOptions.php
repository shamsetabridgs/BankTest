<?php

namespace App\Filament\Resources\DepositOptionResource\Pages;

use App\Filament\Resources\DepositOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDepositOptions extends ListRecords
{
    protected static string $resource = DepositOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
