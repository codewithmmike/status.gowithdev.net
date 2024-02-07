<?php

namespace App\Filament\Resources\EmailNotificationResource\Pages;

use App\Filament\Resources\EmailNotificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Http\Controllers\EmailNotificationController;

class ListEmailNotifications extends ListRecords
{
    protected static string $resource = EmailNotificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Send Emails')
            ->color('success')
            ->action(function(EmailNotificationController $emailNotificationController) {
                $emailNotificationController->sendEmail();
            }),
            Actions\CreateAction::make()->label('New Email Notification'),
        ];
    }
}
