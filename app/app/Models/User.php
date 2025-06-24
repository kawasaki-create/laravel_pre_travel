<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\Api\Auth\ResetPasswordNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    // OS定数
    const OS_ANDROID = 1;
    const OS_IOS = 2;
    const OS_WEB = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'register_os',
        'last_login_os',
        'last_login_at',
        'vip_flg',
        'last_ad_view',
        'daily_ad_count',
        'ad_count_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_ad_view' => 'datetime',
        'ad_count_date' => 'date',
    ];

    /**
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function travelPlan()
    {
        return $this->hasMany(TravelPlan::class);
    }

    /**
     * プレミアム会員かどうか（モバイル課金 or Web広告視聴）
     */
    public function isPremiumUser(): bool
    {
        return $this->vip_flg == 1 || $this->hasWebPremium();
    }

    /**
     * Web版プレミアム（広告視聴）の有効性をチェック
     */
    public function hasWebPremium(): bool
    {
        if (!$this->last_ad_view) {
            return false;
        }

        // 24時間以内に広告視聴していればプレミアム
        return $this->last_ad_view->diffInHours(now()) < 24;
    }

    /**
     * 旅行プラン作成可能かチェック
     */
    public function canCreatePlan(): bool
    {
        if ($this->isPremiumUser()) {
            return true; // プレミアムユーザーは無制限
        }

        // 無料ユーザーは3つまで
        $planCount = $this->travelPlan()->count();
        return $planCount < 3;
    }

    /**
     * 広告視聴を記録
     */
    public function recordAdView(): void
    {
        $today = now()->toDateString();
        
        // 日付が変わったらカウントリセット
        if ($this->ad_count_date?->toDateString() !== $today) {
            $this->daily_ad_count = 0;
            $this->ad_count_date = $today;
        }

        $this->last_ad_view = now();
        $this->daily_ad_count += 1;
        $this->save();
    }

    /**
     * 今日の広告視聴回数
     */
    public function getTodayAdCount(): int
    {
        $today = now()->toDateString();
        
        if ($this->ad_count_date?->toDateString() !== $today) {
            return 0;
        }

        return $this->daily_ad_count;
    }
}
