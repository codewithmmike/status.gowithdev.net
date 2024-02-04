<?php

namespace App\Providers;

use App\Repositories\EmailNotification\EmailNotificationRepository;
use App\Repositories\EmailNotification\EmailNotificationRepositoryEloquent;
use App\Repositories\Domain\DomainRepository;
use App\Repositories\Domain\DomainRepositoryEloquent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Filament\Navigation\NavigationItem;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
