<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use App\Services\ApiSports\LeagueService;

class SyncLeagueSeason extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:leagues-seasons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync leagues & seasons list from the ApiSports 3rd party api';

    /**
     * Execute the console command.
     */
    public function handle(LeagueService $service): void
    {
        $this->handleService($service);
    }
}
