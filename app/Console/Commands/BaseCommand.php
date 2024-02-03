<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiSports\BaseService;

class BaseCommand extends Command
{
    const TYPE_LEAGUE_SEASON = 'LEAGUE_SEASON';
    const TYPE_FIXTURE = 'FIXTURE';
    const TYPE_FIXTURE_DATE = 'FIXTURE_DATE';
    const MAX_THREADS = 100;

    protected $signature = 'sync:base';

    public function handleService(BaseService $service): void
    {
        $service->sync();
    }

    public function handleWithThreads(BaseService $service): void
    {
        $startTime = time();
        $thread = (int) $this->option('thread');
        if ($thread < 1) {
            throw new \Exception('thread must be a positive integer');
        }
        if ($thread > self::MAX_THREADS) {
            throw new \Exception('the max thread number is ' . self::MAX_THREADS);
        }

        $options = $this->options();

        $indexFrom = (int) $options['index-from'];
        $args = [
            'type' => $this->getCommandType(),
            'thread' => $thread,
            'index_from' => $indexFrom,
            'only_current' => $options['only-current'] ?? false,
            'is_live' => $options['live'] ?? false,
        ];

        $indexTo = intval($options['index-to'] ?? 0);
        if (!empty($indexTo) && $indexTo > $indexFrom) {
            $args['index_to'] = $indexTo;
        }

        $dateFrom = $options['date-from'] ?? null;
        $dateTo = $options['date-to'] ?? null;
        if ($dateFrom && $dateTo) {
            $args['date_from'] = $dateFrom;
            $args['date_to'] = $dateTo;
        }

        $service->syncWithThreads($args);

        $this->log('Finish syncing. Total seconds: ' . (time() - $startTime));
    }

    protected function getCommandType(): string
    {
        return '';
    }

    public function log(string $message, string $prefix = ''): void
    {
        if ($prefix) {
            $message = "[{$prefix}] " . $message;
        }
        $this->info(get_class($this) . ' - ' . $message);
    }
}
