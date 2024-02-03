<?php

namespace App\Http\Controllers\Api;

use App\Models\Fixture;
use App\Services\CommonService;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Controllers\Controller as BaseController;

class CommonController extends BaseController
{
    private CommonService $service;

    public function __construct(CommonService $service)
    {
        $this->service = $service;
    }

    public function leagues(): ResourceCollection
    {
        return $this->service->getLeagues();
    }

    public function getMatchDetail(int $fixtureId, string $teamSlug1, string $teamSlug2)
    {
        $fixture = Fixture::findOrFail($fixtureId);
        $fixture->load(['statistics', 'events', 'lineups', 'league', 'venue']);

        return $this->response($this->service->getMatchDetail($fixture));
    }

}
