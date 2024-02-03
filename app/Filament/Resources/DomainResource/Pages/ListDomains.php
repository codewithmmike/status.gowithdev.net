<?php

namespace App\Filament\Resources\DomainResource\Pages;

use App\Filament\Resources\DomainResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\DomainController;

class ListDomains extends ListRecords
{
    protected static string $resource = DomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Scan status')
                ->color('success')
                ->action(function(DomainController $domainController) {
                    $domainController->checkStatus();
                }),
            Actions\CreateAction::make(),
        ];
    }
}
