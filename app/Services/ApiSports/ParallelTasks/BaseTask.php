<?php
namespace App\Services\ApiSports\ParallelTasks;

use Amp\Cancellation;
use Amp\Parallel\Worker\Task;
use Amp\Sync\Channel;
use Amp\CancelledException;

class BaseTask implements Task
{
    protected array $args;
    protected $retryCount = 0;
    const MAX_RETRY_COUNT = 3;

    protected HttpClient $httpClient;

    public function __construct(array $args)
    {
        $this->args = $args;
    }

    public function run(Channel $channel, Cancellation $cancellation): array
    {
        $timeStart = microtime(true);
        $this->httpClient = new HttpClient;

        $paramsStr = arrayToString($this->args);
        $this->log('Start syncing the request ' . $paramsStr);
        $response = $this->fetchApiData();
        while (
            (empty($response) || !empty($response['errors']))
            && $this->retryCount < self::MAX_RETRY_COUNT
        ) {
            $this->retryCount++;
            $this->log('Retry the request ' . $paramsStr . ' #' . $this->retryCount);
            $response = $this->fetchApiData();
        }

        if (empty($response) || !empty($response['errors'])) {
            $errorStr = !empty($response['errors']) ? json_encode($response['errors']) : 'Empty response from the API server';
            $this->log($paramsStr . ' - ' . $errorStr);

            throw new CancelledException;
        }

        $this->retryCount = 0;
        $this->log('Finish syncing the request ' . $paramsStr . '. Total seconds(s): ' . microtime(true) - $timeStart);

        return $this->transformData($response['response']);
    }

    public function log(string $message): void
    {
        error_log('[' . get_class($this) . '] - ' . $message);
    }

    public function transformData(array $items): array
    {
        return $items;
    }
}
