<?php

namespace App\Http\Controllers\Api;

use App\Services\OddsService;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Carbon;

class OddsController extends BaseController
{

    public function __construct(private OddsService $service)
    {
    }

    public function index(): array
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->response($this->service->getByDate($today));
    }

    public function getByDate(string $date): array
    {
        return $this->response($this->service->getByDate($date));
    }
}
