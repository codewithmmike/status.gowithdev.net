<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $dateTime = Carbon::now();
        $today = $dateTime->format('Y-m-d');
        $yesterday = $dateTime->subDay()->format('Y-m-d');

        // Sync livescore every 30 seconds
        $livescorePath = storage_path('logs/livescore.log');
        $schedule->command('sync:livescore --live')->everyThirtySeconds()->sendOutputTo($livescorePath);

        // Sync hourly
        $fixturePath = storage_path('logs/fixture.log');
        $schedule->command('sync:fixtures --index-from=490')
            ->hourly()->sendOutputTo($fixturePath);

        $eventPath = storage_path('logs/fixture-events.log');
        $schedule->command('sync:fixture-events --live')->everyTwoMinutes()->sendOutputTo($eventPath);

        $lineupPath = storage_path('logs/fixture-lineups.log');
        $schedule->command('sync:fixture-lineups --live')->everyFiveMinutes()->sendOutputTo($lineupPath);

        $statisticsPath = storage_path('logs/fixture-statistics.log');
        $schedule->command('sync:fixture-statistics --date-from=' . $today . ' --date-to=' . $today)
            ->hourly()->sendOutputTo($statisticsPath);

        $standingPath = storage_path('logs/standings.log');
        $schedule->command('sync:standings --index-from=490')
            ->hourly()->sendOutputTo($standingPath);


        // Sync 1 time everyday
        $fixturePath = storage_path('logs/fixture.log');
        $schedule->command('sync:fixtures --index-from=490')
            ->daily()->at('2:30')->sendOutputTo($fixturePath);

        $eventPath = storage_path('logs/fixture-events.log');
        $schedule->command('sync:fixture-events --date-from=' . $yesterday . ' --date-to=' . $today)
            ->daily()->at('3:00')->sendOutputTo($eventPath);

        $lineupPath = storage_path('logs/fixture-lineups.log');
        $schedule->command('sync:fixture-lineups --date-from=' . $yesterday . ' --date-to=' . $today)
            ->daily()->at('3:30')->sendOutputTo($lineupPath);

        $statisticsPath = storage_path('logs/fixture-statistics.log');
        $schedule->command('sync:fixture-statistics --date-from=' . $yesterday . ' --date-to=' . $today)
            ->daily()->at('3:30')->sendOutputTo($statisticsPath);

        $teamPath = storage_path('logs/teams.log');
        $schedule->command('sync:teams')
            ->daily()->at('4:00')->sendOutputTo($teamPath);

        $leagueSeasonPath = storage_path('logs/leagues-seasons.log');
        $schedule->command('sync:leagues-seasons')
            ->daily()->at('4:30')->sendOutputTo($leagueSeasonPath);

        $roundPath = storage_path('logs/rounds.log');
        $schedule->command('sync:rounds --index-from=490')
            ->daily()->at('4:40')->sendOutputTo($roundPath);

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
