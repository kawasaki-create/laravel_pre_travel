<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Sanctum\PersonalAccessToken; // 追加
use Laravel\Sanctum\Sanctum; // 追加

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // これを記述
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
