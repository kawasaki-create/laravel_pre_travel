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
        Schema::create('guest_users', function (Blueprint $table) {
            $table->id();
            $table->string('device_id', 100)->unique()->comment('デバイス識別子');
            $table->string('token', 80)->unique()->comment('認証トークン');
            $table->string('app_version', 20)->nullable()->comment('アプリバージョン');
            $table->string('platform', 20)->default('mobile')->comment('プラットフォーム');
            $table->timestamp('expires_at')->comment('トークン有効期限');
            $table->timestamp('last_accessed_at')->nullable()->comment('最終アクセス日時');
            $table->timestamps();
            
            // インデックス
            $table->index('device_id');
            $table->index('token');
            $table->index('expires_at');
            $table->index(['expires_at', 'last_accessed_at']); // クリーンアップ用
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_users');
    }
};