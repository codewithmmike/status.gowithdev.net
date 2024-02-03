<?php
use App\Models\League;

function getClassSubstring($instance): string
{
    $classNameWithNamespace = get_class($instance);

    return substr($classNameWithNamespace, strrpos($classNameWithNamespace, '\\')+1);
}

function arrayToString(array $items): string
{
    $array = array_map(fn ($key, $value) => $key . ' => ' . $value, array_keys($items), array_values($items));

    return '[' . implode(', ', $array) . ']';
}

function formatRound(string $round, int $leagueId): string|int
{
    static $leagues = [];
    if (empty($leagues[$leagueId])) {
        $leagues[$leagueId] = League::findOrFail($leagueId)->type;
    }
    // dd($leagueId);
    $newRound = strtolower($round);
    switch ($newRound) {
        case 'round of 64':
            $newRound = '1/32';
            break;

        case 'round of 32':
            $newRound = '1/16';
            break;

        case 'round of 16':
            $newRound = '1/8';
            break;

        case 'quarter-finals':
            $newRound = 'Tứ kết';
            break;

        case 'semi-finals':
            $newRound = 'Bán kết';
            break;

        case 'final':
            $newRound = 'Chung kết';
            break;

        case 'qualifying round':
            $newRound = 'Vòng loại';
            break;

        case '1st qualifying round':
            $newRound = 'Vòng loại 1';
            break;

        case '2nd qualifying round':
            $newRound = 'Vòng loại 2';
            break;

        case '3rd qualifying round':
            $newRound = 'Vòng loại 3';
            break;

        case 'preliminary round':
            $newRound = 'Vòng sơ loại';
            break;

        default:
            if ($leagues[$leagueId] == League::TYPE_LEAGUE) {
                preg_match('/[^\d]+(\d+$)/', $newRound, $matches);
                $newRound = isset($matches[1]) ? (int) $matches[1] : $round;
            } else {
                $round = str_ireplace('Group Stage', 'Bảng', $round);
                $round = str_ireplace('Group', 'Bảng', $round);
                $newRound = $round;
            }
            
            break;
    }

    return $newRound;
}
