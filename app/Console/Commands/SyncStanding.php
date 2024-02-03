<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use App\Services\ApiSports\StandingService;

class SyncStanding extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:standings {--thread=10} {--only-current} {--index-from=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync standings list from the ApiSports 3rd party api';

    /**
     * Execute the console command.
     */
    public function handle(StandingService $service): void
    {
        $this->handleWithThreads($service);
    }

    protected function getCommandType(): string
    {
        return self::TYPE_LEAGUE_SEASON;
    }
}
