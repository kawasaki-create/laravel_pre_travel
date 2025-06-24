<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GuestUser;
use Carbon\Carbon;

class CleanupGuestUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'guest:cleanup {--days=60 : Number of days of inactivity}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up expired and inactive guest users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $inactiveDays = $this->option('days');
        
        $this->info('Starting guest user cleanup...');
        
        // 期限切れゲストユーザーの削除
        $expiredCount = GuestUser::cleanupExpired();
        $this->info("✓ Removed {$expiredCount} expired guest users");
        
        // 非アクティブゲストユーザーの削除
        $inactiveCount = GuestUser::cleanupInactive($inactiveDays);
        $this->info("✓ Removed {$inactiveCount} inactive guest users (inactive for {$inactiveDays} days)");
        
        // 統計情報の表示
        $stats = GuestUser::getStats();
        $this->info("\nCurrent Statistics:");
        $this->info("Total guest users: {$stats['total']}");
        $this->info("Active guest users: {$stats['active']}");
        $this->info("Expired guest users: {$stats['expired']}");
        
        return Command::SUCCESS;
    }
}