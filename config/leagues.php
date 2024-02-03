<?php

use App\Models\League;

if (!defined('CODE_CHAMPIONS')) {
    define('CODE_CHAMPIONS', 'champions');
    define('TEXT_CHAMPIONS', 'Dự vòng bảng Champions League');

    define('CODE_PRE_CHAMPIONS', 'pre-champions');
    define('TEXT_PRE_CHAMPIONS', 'Vòng loại Champions League');

    define('CODE_EUROPA', 'europa');
    define('TEXT_EUROPA', 'Dự vòng bảng Europa League');

    define('CODE_EU_CONFERENCE', 'eu-conference');
    define('TEXT_EU_CONFERENCE', 'Dự vòng loại Europa Conference League');

    define('CODE_PRE_DOWN', 'pre-down');
    define('TEXT_PRE_DOWN', 'Tranh suất trụ hạng');

    define('CODE_DOWN', 'down');
}

if (!function_exists('generateColorInfoItem')) {
    function generateColorInfoItem(array $ranks, string $code, string $text): array {
        return compact('ranks', 'code', 'text');
    }
}

return [
    'popular_leagues' => [
        League::PREMIER_LEAGUE_ID,
        League::LA_LIGA_ID,
        League::SERIE_A,
        League::LEAGUE_1_ID,
        League::BUNDESLIGA_ID,
        League::CHAMPIONS_LEAGUE_ID,
        League::EUROPA_LEAGUE_ID,
        League::V_LEAGUE_ID,
    ],

    'color_info' => [
        League::PREMIER_LEAGUE_ID => [
            generateColorInfoItem([1, 2, 3, 4], CODE_CHAMPIONS, TEXT_CHAMPIONS),
            generateColorInfoItem([5], CODE_EUROPA, TEXT_EUROPA),
            generateColorInfoItem([18, 19, 20], CODE_DOWN, 'Xuống hạng Championship'),
        ],

        League::LA_LIGA_ID => [
            generateColorInfoItem([1, 2, 3, 4], CODE_CHAMPIONS, TEXT_CHAMPIONS),
            generateColorInfoItem([5], CODE_EUROPA, TEXT_EUROPA),
            generateColorInfoItem([6], CODE_EU_CONFERENCE, TEXT_EU_CONFERENCE),
            generateColorInfoItem([18, 19, 20], CODE_DOWN, 'Xuống hạng La Liga 2'),
        ],

        League::SERIE_A =>  [
            generateColorInfoItem([1, 2, 3, 4], CODE_CHAMPIONS, TEXT_CHAMPIONS),
            generateColorInfoItem([5], CODE_EUROPA, TEXT_EUROPA),
            generateColorInfoItem([6], CODE_EU_CONFERENCE, TEXT_EU_CONFERENCE),
            generateColorInfoItem([18, 19, 20], CODE_DOWN, 'Xuống hạng Serie B'),
        ],

        League::LEAGUE_1_ID => [
            generateColorInfoItem([1, 2, 3], CODE_CHAMPIONS, TEXT_CHAMPIONS),
            generateColorInfoItem([4], CODE_PRE_CHAMPIONS, TEXT_PRE_CHAMPIONS),
            generateColorInfoItem([5], CODE_EUROPA, TEXT_EUROPA),
            generateColorInfoItem([6], CODE_EU_CONFERENCE, TEXT_EU_CONFERENCE),
            generateColorInfoItem([16], CODE_PRE_DOWN, TEXT_PRE_DOWN),
            generateColorInfoItem([17, 18], CODE_DOWN, 'Xuống hạng Ligue 2'),
        ],

        League::BUNDESLIGA_ID => [
            generateColorInfoItem([1, 2, 3, 4], CODE_CHAMPIONS, TEXT_CHAMPIONS),
            generateColorInfoItem([5], CODE_EUROPA, TEXT_EUROPA),
            generateColorInfoItem([6], CODE_EU_CONFERENCE, TEXT_EU_CONFERENCE),
            generateColorInfoItem([16], CODE_PRE_DOWN, TEXT_PRE_DOWN),
            generateColorInfoItem([17, 18], CODE_DOWN, 'Xuống hạng 2 Bundesliga'),
        ],

        League::CHAMPIONS_LEAGUE_ID => [
            generateColorInfoItem([1, 2], CODE_CHAMPIONS, 'Champions League (Round of 16)'),
            generateColorInfoItem([3], CODE_EUROPA, 'Europa League (Round of 32)'),
            generateColorInfoItem([4, 5], CODE_DOWN, 'Bị loại'),
        ],

        League::EUROPA_LEAGUE_ID,
        League::V_LEAGUE_ID => [
            generateColorInfoItem([1], CODE_CHAMPIONS, 'Dự AFC Champions League'),
            generateColorInfoItem([13], CODE_PRE_DOWN, TEXT_PRE_DOWN),
            generateColorInfoItem([14], CODE_DOWN, 'Xuống hạng 2 V-league'),
        ],
    ],


];
