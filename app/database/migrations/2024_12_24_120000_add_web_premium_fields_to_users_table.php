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
            $table->timestamp('last_ad_view')->nullable()->comment('最後に広告を視聴した日時');
            $table->integer('daily_ad_count')->default(0)->comment('今日視聴した広告数');
            $table->date('ad_count_date')->nullable()->comment('広告カウントの基準日');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_ad_view', 'daily_ad_count', 'ad_count_date']);
        });
    }
};