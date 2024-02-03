<?php
namespace App\Services\ApiSports;

use App\Models\Country;

class CountryService extends BaseService
{
    protected function getBaseModel(): string
    {
        return Country::class;
    }

    public function sync(): bool
    {
        $data = $this->client->countries()->getAll();
        
        if (empty($data['response'])) {
            return false;
        }

        return $this->syncBatch($data['response'], ['name']);
    }
}