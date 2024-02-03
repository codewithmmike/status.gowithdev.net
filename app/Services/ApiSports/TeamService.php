<?php
namespace App\Services\ApiSports;

use App\Models\Team;
use App\Models\Country;

class TeamService extends BaseService
{
    protected function getBaseModel(): string
    {
        return Team::class;
    }

    public function sync(): bool
    {
        $teams = [];
        $countryNameIds = Country::getListOfNameIds();
        if (empty($countryNameIds)) {
            $this->log('Please sync Country entities first');
            return false;
        }

        $this->log('There are ' . count($countryNameIds) . ' batches need to be synced');
        foreach ($countryNameIds as $countryName => $countryId) {
            $response = $this->client->team()->getTeamsInformation(['country' => $countryName]);
            if ($response['errors']) {
                $this->log(json_encode($response['errors']));
                return false;
            }

            if (!empty($response['response'])) {
                foreach ($response['response'] as $item) {
                    $team = $item['team'];
                    $team['country_id'] = $countryId;
                    $team['venue_id'] = $item['venue']['id'];
                    unset($team['country']);
                    $teams[] = $team;
                }
                $this->log("Start syncing {$countryName} - {$countryId}");
                $this->syncBatch($teams, ['id']);
            }
        }

        return true;
    }
}