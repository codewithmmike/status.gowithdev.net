<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use App\Services\ApiSports\DomainService;

class SyncScanStatus extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:scan-status-domain';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan status domain list';

    /**
     * Execute the console command.
     */
    public function handle(DomainService $service): void
    {
        $this->handleService($service);
    }
}
