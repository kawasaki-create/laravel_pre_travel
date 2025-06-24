<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index('email');
            $table->index('last_login_at');
            $table->index(['vip_flg', 'last_login_at']);
        });

        Schema::table('travel_plans', function (Blueprint $table) {
            $table->index('user_id');
            $table->index(['user_id', 'created_at']);
        });

        // travel_details テーブルが存在する場合
        if (Schema::hasTable('travel_details')) {
            Schema::table('travel_details', function (Blueprint $table) {
                $table->index('travel_plan_id');
                $table->index(['travel_plan_id', 'created_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['email']);
            $table->dropIndex(['last_login_at']);
            $table->dropIndex(['vip_flg', 'last_login_at']);
        });

        Schema::table('travel_plans', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['user_id', 'created_at']);
        });

        if (Schema::hasTable('travel_details')) {
            Schema::table('travel_details', function (Blueprint $table) {
                $table->dropIndex(['travel_plan_id']);
                $table->dropIndex(['travel_plan_id', 'created_at']);
            });
        }
    }
};