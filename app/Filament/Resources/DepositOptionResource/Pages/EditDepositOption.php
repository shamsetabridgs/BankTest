<?php

namespace App\Filament\Resources\DepositOptionResource\Pages;

use App\Filament\Resources\DepositOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDepositOption extends EditRecord
{
    protected static string $resource = DepositOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
