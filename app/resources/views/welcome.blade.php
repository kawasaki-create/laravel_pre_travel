@extends('layouts.app')
@section('content')

@if (session('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <!-- Hero Section -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-dark mb-4">
                Pre<span class="text-primary">Travel</span>
            </h1>
            <p class="lead text-muted mx-auto" style="max-width: 600px;">
                旅行前の計画を立てたり予算を作成したりできるシンプルで使いやすいアプリです✨
            </p>
        </div>

        <!-- Features Section -->
        <div class="row mb-5">
            <div class="col-md-4 mb-3">
                <div class="card text-center h-100 shadow-sm" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <div class="card-body">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">📅</div>
                        <h3 class="h5 fw-semibold text-dark mb-2">スケジュール管理</h3>
                        <p class="text-muted">旅行の日程を詳細に計画できます</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center h-100 shadow-sm" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <div class="card-body">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">💰</div>
                        <h3 class="h5 fw-semibold text-dark mb-2">予算管理</h3>
                        <p class="text-muted">旅行費用を効率的に管理できます</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center h-100 shadow-sm" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <div class="card-body">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">🎒</div>
                        <h3 class="h5 fw-semibold text-dark mb-2">持ち物チェック</h3>
                        <p class="text-muted">忘れ物を防ぐチェックリスト機能</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Auth Section -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="h5 fw-semibold">始めてみませんか？</h2>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                ログイン
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-success">
                                新規登録
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile App Promotion -->
        <div class="text-center mt-5">
            <p class="text-muted mb-4">モバイルアプリ版もご利用いただけます</p>
            <div class="d-flex justify-content-center flex-wrap" style="gap: 1rem;">
                <a href="https://apps.apple.com/jp/app/pretravel-旅行計画作成アプリ/id6478861524" class="d-inline-block">
                    <img src="https://tools.applemediaservices.com/api/badges/download-on-the-app-store/white/ja-jp?size=250x83" 
                         alt="Download on the App Store" 
                         style="height: 3rem;">
                </a>
                <a href="https://play.google.com/store/apps/details?id=com.pretravel.kawasaki_create.pre_travel_mobile" class="d-inline-block">
                    <img src="https://play.google.com/intl/ja/badges/static/images/badges/ja_badge_web_generic.png" 
                         alt="Google Play で手に入れよう" 
                         style="height: 3rem;">
                </a>
            </div>
        </div>
    </div>
</div>

@endsection