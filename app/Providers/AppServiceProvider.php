<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Database\Eloquent\Model;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(FilamentServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('LOG_QUERY', false)) {
            DB::listen(function($query) {
                Log::info(
                    $query->sql,
                    [
                        'bindings' => $query->bindings,
                        'time' => $query->time
                    ]
                );
            });
        }

        Model::unguard();

    }
}
