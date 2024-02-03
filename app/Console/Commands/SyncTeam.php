<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use App\Services\ApiSports\TeamService;

class SyncTeam extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:teams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync teams list from the ApiSports 3rd party api';

    /**
     * Execute the console command.
     */
    public function handle(TeamService $service): void
    {
        $this->handleService($service);
    }
}
