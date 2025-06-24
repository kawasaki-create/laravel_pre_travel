<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        
        // ゲストユーザーのクリーンアップ（毎日深夜2時）
        $schedule->command('guest:cleanup')->dailyAt('02:00');
        
        // データベース最適化（毎週日曜日の深夜3時）
        $schedule->command('db:optimize')->weeklyOn(0, '3:00');
        
        // キャッシュのウォームアップ（毎日深夜4時）
        $schedule->command('cache:clear')->dailyAt('04:00');
        $schedule->command('config:cache')->dailyAt('04:05');
        $schedule->command('route:cache')->dailyAt('04:10');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
