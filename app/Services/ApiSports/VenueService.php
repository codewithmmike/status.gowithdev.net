<?php
namespace App\Services\ApiSports;

use App\Models\Venue;
use App\Models\Country;

class VenueService extends BaseService
{
    protected function getBaseModel(): string
    {
        return Venue::class;
    }

    public function sync(): bool
    {
        $data = [];
        $countryNameIds = Country::getListOfNameIds();
        if (empty($countryNameIds)) {
            $this->log('Please sync Country entities first');
            return false;
        }

        $this->log('There are ' . count($countryNameIds) . ' batches need to be synced');
        foreach ($countryNameIds as $countryName => $countryId) {
            $response = $this->client->venues()->getVenues(['country' => $countryName]);
            if ($response['errors']) {
                $this->log(json_encode($response['errors']));
                return false;
            }

            if (!empty($response['response'])) {
                foreach ($response['response'] as $item) {
                    $item['country_id'] = $countryId;
                    unset($item['country']);
                    $data[] = $item;
                }
                $this->log("Start syncing {$countryName} - {$countryId}");
                $this->syncBatch($data, ['id']);
            }
        }

        return true;
    }
}