<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use App\Services\ApiSports\FixtureStatisticsService;

class SyncFixtureStatistics extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:fixture-statistics {--thread=10} {--only-current} {--index-from=0} {--index-to=0} {--date-from=} {--date-to=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync fixture statistics list from the ApiSports 3rd party api';

    /**
     * Execute the console command.
     */
    public function handle(FixtureStatisticsService $service): void
    {
        $this->handleWithThreads($service);
    }

    protected function getCommandType(): string
    {
        return self::TYPE_FIXTURE;
    }
}
