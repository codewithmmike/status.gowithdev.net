<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use App\Services\ApiSports\VenueService;

class SyncVenue extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:venues';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync venues list from the ApiSports 3rd party api';

    /**
     * Execute the console command.
     */
    public function handle(VenueService $service): void
    {
        $this->handleService($service);
    }
}
