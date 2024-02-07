<?php
namespace App\Services\ApiSports;

use App\Models\Domain;
use Carbon\Carbon;

class DomainService extends BaseService
{
    protected function getBaseModel(): string
    {
        return Domain::class;
    }

    public function sync(): bool
    {
        $dateTime = Carbon::now();
        $today = $dateTime->format('Y-m-d');
        
        Domain::CheckStatus();
        $this->log($today . ' : Scan Status domain');
        
        if (empty($data['response'])) {
            return false;
        }

        return $this->syncBatch($data['response'], ['name']);
    }
}