<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class GuestUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'token',
        'app_version',
        'platform',
        'expires_at',
        'last_accessed_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'last_accessed_at' => 'datetime',
    ];

    /**
     * 新しいゲストユーザーを作成
     */
    public static function createForDevice(string $deviceId, string $appVersion = null, string $platform = 'mobile'): self
    {
        // 既存のゲストユーザーがあれば削除
        static::where('device_id', $deviceId)->delete();

        return static::create([
            'device_id' => $deviceId,
            'token' => static::generateToken(),
            'app_version' => $appVersion,
            'platform' => $platform,
            'expires_at' => Carbon::now()->addDays(30), // 30日間有効
            'last_accessed_at' => Carbon::now(),
        ]);
    }

    /**
     * 安全なトークンを生成
     */
    public static function generateToken(): string
    {
        return 'guest_' . Str::random(64);
    }

    /**
     * トークンが有効かどうか
     */
    public function isValid(): bool
    {
        return $this->expires_at->isFuture();
    }

    /**
     * 最終アクセス日時を更新
     */
    public function updateLastAccessed(): void
    {
        $this->update(['last_accessed_at' => Carbon::now()]);
    }

    /**
     * トークンの有効期限を延長
     */
    public function extendExpiration(int $days = 30): void
    {
        $this->update([
            'expires_at' => Carbon::now()->addDays($days),
            'last_accessed_at' => Carbon::now(),
        ]);
    }

    /**
     * 期限切れのゲストユーザーを削除
     */
    public static function cleanupExpired(): int
    {
        return static::where('expires_at', '<', Carbon::now())->delete();
    }

    /**
     * 非アクティブなゲストユーザーを削除（最終アクセスから指定日数経過）
     */
    public static function cleanupInactive(int $inactiveDays = 60): int
    {
        return static::where('last_accessed_at', '<', Carbon::now()->subDays($inactiveDays))->delete();
    }

    /**
     * デバイスIDでゲストユーザーを検索
     */
    public static function findByDeviceId(string $deviceId): ?self
    {
        return static::where('device_id', $deviceId)->first();
    }

    /**
     * トークンでゲストユーザーを検索
     */
    public static function findByToken(string $token): ?self
    {
        return static::where('token', $token)->first();
    }

    /**
     * 有効なトークンでゲストユーザーを検索
     */
    public static function findByValidToken(string $token): ?self
    {
        $guest = static::findByToken($token);
        
        if ($guest && $guest->isValid()) {
            $guest->updateLastAccessed();
            return $guest;
        }
        
        return null;
    }

    /**
     * このゲストユーザーの旅行プラン
     */
    public function travelPlans()
    {
        return $this->hasMany(TravelPlan::class, 'guest_user_id');
    }

    /**
     * 統計情報の取得
     */
    public static function getStats(): array
    {
        $total = static::count();
        $active = static::where('expires_at', '>', Carbon::now())->count();
        $todayCreated = static::whereDate('created_at', Carbon::today())->count();
        
        return [
            'total' => $total,
            'active' => $active,
            'expired' => $total - $active,
            'created_today' => $todayCreated,
        ];
    }
}