<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use App\Services\ApiSports\CountryService;

class SyncCountry extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync countries list from the ApiSports 3rd party api';

    /**
     * Execute the console command.
     */
    public function handle(CountryService $service): void
    {
        $this->handleService($service);
    }
}
