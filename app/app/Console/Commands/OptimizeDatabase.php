<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class OptimizeDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:optimize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize database tables and update statistics';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting database optimization...');
        
        $tables = [
            'users',
            'travel_plans',
            'travel_details',
            'tweets',
            'belongings',
            'contacts',
            'guest_users'
        ];

        foreach ($tables as $table) {
            try {
                if (DB::getDriverName() === 'mysql') {
                    DB::statement("OPTIMIZE TABLE {$table}");
                    DB::statement("ANALYZE TABLE {$table}");
                    $this->info("✓ Optimized table: {$table}");
                }
            } catch (\Exception $e) {
                $this->error("✗ Failed to optimize {$table}: " . $e->getMessage());
            }
        }

        // クエリキャッシュのクリア
        if (config('cache.default') !== 'file') {
            $this->call('cache:clear');
        }

        // 古いゲストユーザーのクリーンアップ
        $this->call('guest:cleanup');

        $this->info('Database optimization completed!');
        return Command::SUCCESS;
    }
}