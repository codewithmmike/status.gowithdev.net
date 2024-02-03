<?php
namespace App\Services\ApiSports;

use App\Models\League;
use App\Models\Country;
use slvler\LiveScoreService\LiveScoreClient;

class LeagueService extends BaseService
{
    private SeasonService $seasonService;
    public function __construct(LiveScoreClient $liveScoreClient, SeasonService $seasonService)
    {
        parent::__construct($liveScoreClient);
        $this->seasonService = $seasonService;
    }

    protected function getBaseModel(): string
    {
        return League::class;
    }

    public function sync(): bool
    {
        $leagues = [];
        $seasons = [];
        $countryNameIds = Country::getListOfNameIds();
        if (empty($countryNameIds)) {
            $this->log('Please sync Country entities first');
            return false;
        }

        $response = $this->client->leagues()->getLeagues();
        if (!empty($response['errors'])) {
            $this->log(json_encode($response['errors']));
            return false;
        }

        if (!empty($response['response'])) {
            foreach ($response['response'] as $item) {
                $league = $item['league'];
                $league['country_id'] = $countryNameIds[$item['country']['name']];
                foreach ($item['seasons'] as $season) {
                    $season['league_id'] = $league['id'];
                    $seasons[] = $season;
                }
                unset($item);
                $leagues[] = $league;
            }

            $this->syncBatch($leagues, ['id']);
            $this->seasonService->syncBatch($seasons, ['year', 'league_id']);
        }

        return true;
    }
}
