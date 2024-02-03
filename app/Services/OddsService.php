<?php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class OddsService extends BaseService
{

    /**
     * For livescore
     */
    public function getByDate(string|null $date): array
    {
        $fileName = 'odds';
        $fileName = $date ? $fileName . '-' . $date : $fileName;
        $fileName .= '.json';
        $filePath = 'json/' . $fileName;

        $responseData = [];
        if (Storage::disk('public')->exists($filePath)) {
            $items = Storage::disk('public')->json($filePath)['data'];
            if (count($items)) {
                foreach ($items as $leagueName => $fixtures) {
                    $responseData[] = [
                        'league' => [
                            'name' => $leagueName,
                        ],
                        'fixtures' => $fixtures,
                    ];
                }
            }
        }

        return $responseData;
    }
}
