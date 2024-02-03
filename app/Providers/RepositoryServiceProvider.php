<?php

namespace App\Providers;

use App\Repositories\EmailNotification\EmailNotificationRepository;
use App\Repositories\EmailNotification\EmailNotificationRepositoryEloquent;
use App\Repositories\Domain\DomainRepository;
use App\Repositories\Domain\DomainRepositoryEloquent;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(EmailNotificationRepository::class, EmailNotificationRepositoryEloquent::class);
        $this->app->bind(DomainRepository::class, DomainRepositoryEloquent::class);
    }
}
