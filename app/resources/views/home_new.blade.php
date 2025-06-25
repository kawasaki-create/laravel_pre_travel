@extends('layouts.app')

@section('content')
@vite(['resources/css/app-modern.css'])

<div class="py-4" style="min-height: 100vh; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #e3f2fd 100%);">
    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center mb-4" role="alert" style="border-left: 4px solid #28a745;">
            <div class="me-3">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" style="color: #28a745;">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <p class="mb-0" style="color: #155724;">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning d-flex align-items-center mb-4" role="alert" style="border-left: 4px solid #ffc107;">
            <div class="me-3">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" style="color: #ffc107;">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <p class="mb-0" style="color: #856404;">{{ session('warning') }}</p>
            </div>
        </div>
    @endif

    @if (session('danger'))
        <div class="alert alert-danger d-flex align-items-center mb-4" role="alert" style="border-left: 4px solid #dc3545;">
            <div class="me-3">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" style="color: #dc3545;">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <p class="mb-0" style="color: #721c24;">{{ session('danger') }}</p>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row g-4">
            <!-- Sidebar Navigation -->
            <div class="col-lg-3">
                <!-- Main Navigation Card -->
                <div class="card shadow-sm mb-4" style="border-radius: 12px;">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 64px; height: 64px; background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);">
                                <svg width="32" height="32" fill="white" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h5 class="fw-bold mb-1">{{Auth::user()->name}}</h5>
                            <p class="text-muted small mb-0">
                                @if(Auth::user()->isPremiumUser())
                                    <span class="badge rounded-pill text-white" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
                                        ✨ プレミアム会員
                                    </span>
                                @else
                                    <span class="badge bg-light text-dark">無料会員</span>
                                @endif
                            </p>
                        </div>

                        <nav class="nav flex-column">
                            <a href="/schedule/all_plan/" class="nav-link d-flex align-items-center py-2 px-3 rounded text-decoration-none" style="color: #6c757d; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#e3f2fd'; this.style.color='#007bff';" onmouseout="this.style.backgroundColor=''; this.style.color='#6c757d';">
                                <svg width="20" height="20" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                全ての旅行
                            </a>
                            <a href="/home/all_tweet" class="nav-link d-flex align-items-center py-2 px-3 rounded text-decoration-none" style="color: #6c757d; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#e3f2fd'; this.style.color='#007bff';" onmouseout="this.style.backgroundColor=''; this.style.color='#6c757d';">
                                <svg width="20" height="20" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                全てのつぶやき
                            </a>
                            <a href="/home/change_mail" class="nav-link d-flex align-items-center py-2 px-3 rounded text-decoration-none" style="color: #6c757d; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#e3f2fd'; this.style.color='#007bff';" onmouseout="this.style.backgroundColor=''; this.style.color='#6c757d';">
                                <svg width="20" height="20" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                                メール変更
                            </a>
                            <a href="/home/contact" class="nav-link d-flex align-items-center py-2 px-3 rounded text-decoration-none" style="color: #6c757d; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#e3f2fd'; this.style.color='#007bff';" onmouseout="this.style.backgroundColor=''; this.style.color='#6c757d';">
                                <svg width="20" height="20" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                お問い合わせ
                            </a>
                            <a href="/home/account_delete" class="nav-link d-flex align-items-center py-2 px-3 rounded text-decoration-none" style="color: #dc3545; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f8d7da';" onmouseout="this.style.backgroundColor='';">
                                <svg width="20" height="20" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                アカウント削除
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- 広告エリア（スクロール追尾） -->
                <div class="sticky-ad-container">
                    <div class="card shadow-lg border-0" style="border-radius: 12px;">
                        <div class="card-header bg-light border-0 d-flex align-items-center" style="border-radius: 12px 12px 0 0;">
                            <svg width="20" height="20" class="me-2" style="color: #6c757d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            <h6 class="mb-0 fw-semibold text-muted">スポンサー</h6>
                        </div>
                        <div class="card-body p-3">
                            <!-- Google AdSense 広告 -->
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1568606156833955"
                                 crossorigin="anonymous"></script>
                            <!-- PreTravel -->
                            <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-1568606156833955"
                                 data-ad-slot="6046649503"
                                 data-ad-format="auto"
                                 data-full-width-responsive="true"></ins>
                            <script>
                                 (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- Welcome Header -->
                <div class="card shadow-sm text-white mb-4" style="background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="h4 fw-bold mb-2">おかえりなさい、{{Auth::user()->name}}さん！</h2>
                                <p class="mb-0" style="color: rgba(255,255,255,0.9);">今日も素敵な旅行を計画しましょう ✈️</p>
                            </div>
                            <div class="col-auto d-none d-md-block">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 64px; height: 64px; background-color: rgba(255,255,255,0.2);">
                                    <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row g-3 mb-4">
                    @php
                        $userTravelPlansCount = Auth::user()->travelPlan()->count();
                        $totalTweets = Auth::user()->travelPlan()->withCount('tweet')->get()->sum('tweet_count');
                        $activeTravels = 0;
                        foreach ($travelPlans as $plan) {
                            if($plan->trip_start <= date('Y-m-d H:i:s', strtotime('+1 day')) && date('Y-m-d H:i:s', strtotime('-1 day')) <= $plan->trip_end) {
                                $activeTravels++;
                            }
                        }
                    @endphp
                    
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100" style="border-left: 4px solid #007bff;">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="rounded p-2" style="background-color: #e3f2fd;">
                                            <svg width="24" height="24" style="color: #007bff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <p class="text-muted small mb-1">旅行計画</p>
                                        <h3 class="h2 fw-bold mb-0">{{ $userTravelPlansCount }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm h-100" style="border-left: 4px solid #28a745;">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="rounded p-2" style="background-color: #d4edda;">
                                            <svg width="24" height="24" style="color: #28a745;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <p class="text-muted small mb-1">つぶやき</p>
                                        <h3 class="h2 fw-bold mb-0">{{ $totalTweets }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm h-100" style="border-left: 4px solid #6f42c1;">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="rounded p-2" style="background-color: #e2e3f3;">
                                            <svg width="24" height="24" style="color: #6f42c1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <p class="text-muted small mb-1">アクティブな旅行</p>
                                        <h3 class="h2 fw-bold mb-0">{{ $activeTravels }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h5 fw-bold mb-4 d-flex align-items-center">
                            <svg width="24" height="24" class="me-2" style="color: #007bff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            クイックアクション
                        </h3>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <a href="/schedule" class="btn text-white w-100 d-flex align-items-center p-3 border-0 rounded shadow-sm text-decoration-none" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); transition: all 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    <div class="text-start">
                                        <div class="fw-bold">新しい旅行</div>
                                        <div class="small" style="opacity: 0.9;">計画を作成</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="/schedule/all_plan/" class="btn text-white w-100 d-flex align-items-center p-3 border-0 rounded shadow-sm text-decoration-none" style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%); transition: all 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <div class="text-start">
                                        <div class="fw-bold">旅行一覧</div>
                                        <div class="small" style="opacity: 0.9;">全て表示</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="/home/all_tweet" class="btn text-white w-100 d-flex align-items-center p-3 border-0 rounded shadow-sm text-decoration-none" style="background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%); transition: all 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <div class="text-start">
                                        <div class="fw-bold">つぶやき</div>
                                        <div class="small" style="opacity: 0.9;">思い出を共有</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $displayCard = false;
                    $currentTravelPlanId = null;
                    $tweetCount = 0;
                    $currentTravelPlans = [];
                @endphp
                @foreach ($travelPlans as $travelPlan)
                    @if($travelPlan->trip_start <= date('Y-m-d H:i:s', strtotime('+1 day')) && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end)
                        @php
                            $displayCard = true;
                            $currentTravelPlanId = $travelPlan->id;
                            $tweetCount = $travelPlan->tweet()->count();
                            $currentTravelPlans[] = $travelPlan;
                        @endphp
                    @endif
                @endforeach

                @if($displayCard)
                    <!-- Active Travel Section -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h3 class="h5 fw-bold mb-4 d-flex align-items-center">
                                <span class="bg-success rounded-circle me-3" style="width: 12px; height: 12px; animation: pulse 2s infinite;"></span>
                                現在の旅行
                            </h3>
                            
                            @foreach ($currentTravelPlans as $travelPlan)
                                <div class="p-4 mb-3 rounded" style="background: linear-gradient(135deg, #f8f9fa 0%, #e3f2fd 100%); border: 1px solid #dee2e6;">
                                    <div class="row align-items-start">
                                        <div class="col">
                                            <h4 class="h6 fw-bold mb-3">{{ $travelPlan->trip_title }}</h4>
                                            <div class="row g-3 small text-muted">
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-center">
                                                        <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        {{ $travelPlan->trip_start }} 〜 {{ $travelPlan->trip_end }}
                                                    </div>
                                                </div>
                                                @if($travelPlan->meet_place)
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-center">
                                                            <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            </svg>
                                                            {{ $travelPlan->meet_place }}
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($travelPlan->budget)
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-center">
                                                            <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                                            </svg>
                                                            ¥{{ number_format($travelPlan->budget) }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('schedule.edit', ['id' => $travelPlan->id]) }}" class="btn btn-sm btn-outline-primary">編集</a>
                                                <a href="{{ route('schedule.detail', ['id' => $travelPlan->id]) }}" class="btn btn-sm btn-outline-success">詳細</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tweet Section -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h3 class="h5 fw-bold mb-4 d-flex align-items-center">
                                <svg width="24" height="24" class="me-2" style="color: #007bff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                つぶやき
                                <span class="ms-2 badge bg-primary">旅行中限定</span>
                            </h3>
                            
                            <form action="{{ route('button.click') }}" method="POST" class="mb-4">
                                @csrf
                                <input type="hidden" name="travel_plan_id" value="{{ $currentTravelPlanId }}" id="selectedTravelPlanId">
                                
                                <div class="mb-3">
                                    <textarea 
                                        id="myTextarea" 
                                        name="tweet" 
                                        placeholder="今の気持ちをつぶやいてみませんか？ ✨" 
                                        minlength="1" 
                                        maxlength="140"
                                        class="form-control"
                                        rows="3"
                                        style="resize: none;"
                                    ></textarea>
                                    <div id="charCount" class="text-end small text-muted mt-1"></div>
                                </div>
                                
                                @if($tripCnt >= 2)
                                    <div class="mb-3">
                                        <select name="duplicatedTravel" id="duplicatedTravel" class="form-select" onchange="updateTweetCount()">
                                            @for($i = 0; $i < $tripCnt; $i++)
                                                <option value="{{ $duplicatedIdList[$i] }}" data-tweet-count="{{ $travelPlans->find($duplicatedIdList[$i])->tweet()->count() }}">{{ $duplicatedTitleList[$i] }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                @endif
                                
                                <button type="submit" id="tweetButton" onclick="return checkTweetCount({{ auth()->user()->canTweetUnlimited() ? 1 : 0 }});" class="btn text-white" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); transition: all 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    投稿する
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Tweet Display -->
                    @php $hasActiveTweets = false; @endphp
                    @foreach ($travelPlans as $travelPlan)
                        @foreach ($tweets as $tweet)
                            @if($travelPlan->trip_start <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end && $travelPlan->id == $tweet->travel_plan_id)
                                @php $hasActiveTweets = true; @endphp
                                @break
                            @endif
                        @endforeach
                        @if($hasActiveTweets) @break @endif
                    @endforeach

                    @if($hasActiveTweets)
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h3 class="h5 fw-bold mb-0 d-flex align-items-center">
                                        <svg width="24" height="24" class="me-2" style="color: #6f42c1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1l-4 4z" />
                                        </svg>
                                        あなたのつぶやき
                                    </h3>
                                </div>
                                
                                <form action="{{ route('tweets.delete') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        @foreach ($travelPlans as $travelPlan)
                                            @foreach ($tweets as $tweet)
                                                @if($travelPlan->trip_start <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end && $travelPlan->id == $tweet->travel_plan_id)
                                                    <div class="p-3 mb-3 rounded" style="background-color: #f8f9fa; border-left: 4px solid #007bff;">
                                                        <div class="d-flex align-items-start">
                                                            <input type="checkbox" name="tweets[]" value="{{ $tweet->id }}" class="form-check-input mt-1 me-3">
                                                            <div class="flex-grow-1">
                                                                <div name="{{ $tweet->id }}">
                                                                    {!! nl2br(e($tweet->tweet)) !!}
                                                                    @if($tweet->editFlg == 1)
                                                                        <span class="ms-2 badge bg-warning text-dark">編集済み</span>
                                                                    @endif
                                                                </div>
                                                                <div class="d-flex align-items-center justify-content-between mt-2">
                                                                    <span class="small text-muted">{{ $tweet->updated_at->format('Y/m/d H:i') }}</span>
                                                                    <button type="button" class="btn btn-sm btn-link editButton p-0" data-tweet-id="{{ $tweet->id }}">
                                                                        編集
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </div>
                                    <button type="submit" id="tweetDeleteButton" class="btn btn-danger">
                                        選択したつぶやきを削除
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                @else
                    <!-- No Active Travel -->
                    <div class="card shadow-sm text-center">
                        <div class="card-body py-5">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 64px; height: 64px; background-color: #f8f9fa;">
                                <svg width="32" height="32" style="color: #6c757d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="h5 fw-bold mb-2">現在アクティブな旅行はありません</h3>
                            <p class="text-muted mb-4">新しい旅行を計画して、素敵な思い出を作りましょう！</p>
                            <a href="/schedule" class="btn text-white text-decoration-none" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); transition: all 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                新しい旅行を計画する
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="easyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">つぶやき編集</h5>
                <button type="button" class="btn-close modalClose" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea id="myTweetEdit" name="tweet" placeholder="つぶやき" minlength="1" maxlength="140" class="form-control mb-2" rows="3" style="resize: none;"></textarea>
                <div id="modalCharCount" class="text-end small text-muted"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modalClose">キャンセル</button>
                <button type="button" class="btn btn-primary editSaveBtn">保存</button>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
</style>

<script>
    // Tweet count functions
    function updateTweetCount() {
        var selectedOption = document.getElementById("duplicatedTravel")?.selectedOptions[0];
        if (selectedOption) {
            var tweetCount = selectedOption.getAttribute("data-tweet-count");
            document.getElementById("selectedTravelPlanId").value = selectedOption.value;
            return tweetCount;
        }
        return 0;
    }

    function checkTweetCount(isPremium) {
        var tweetCount = updateTweetCount();
        if (isPremium == 0 && tweetCount >= 10) {
            // プレミアムモーダルを表示
            var premiumModalElement = document.getElementById('premiumModal');
            if (premiumModalElement) {
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    var premiumModal = new bootstrap.Modal(premiumModalElement);
                    premiumModal.show();
                } else {
                    alert('つぶやきの上限に達しました。\\n\\n無料会員は10個までのつぶやきを投稿できます。\\n有料会員登録で無制限にご利用いただけます。');
                }
            }
            return false;
        }
        return true;
    }

    // Character count for textarea
    function updateCharCount() {
        const textarea = document.getElementById('myTextarea');
        const charCount = document.getElementById('charCount');
        if (textarea && charCount) {
            const remaining = 140 - textarea.value.length;
            charCount.textContent = `${remaining}/140文字`;
            charCount.className = remaining < 20 ? 'text-end small text-danger mt-1' : 'text-end small text-muted mt-1';
        }
    }

    function updateModalCharCount() {
        const textarea = document.getElementById('myTweetEdit');
        const charCount = document.getElementById('modalCharCount');
        if (textarea && charCount) {
            const remaining = 140 - textarea.value.length;
            charCount.textContent = `${remaining}/140文字`;
            charCount.className = remaining < 20 ? 'text-end small text-danger' : 'text-end small text-muted';
        }
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('myTextarea');
        const editTextarea = document.getElementById('myTweetEdit');
        
        if (textarea) {
            textarea.addEventListener('input', updateCharCount);
            updateCharCount();
        }
        
        if (editTextarea) {
            editTextarea.addEventListener('input', updateModalCharCount);
        }

        // Modal functionality
        const modal = new bootstrap.Modal(document.getElementById('easyModal'));
        const editButtons = document.querySelectorAll('.editButton');
        const closeButtons = document.querySelectorAll('.modalClose');
        const saveButton = document.querySelector('.editSaveBtn');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tweetId = this.getAttribute('data-tweet-id');
                const tweetText = document.querySelector(`[name="${tweetId}"]`).textContent.trim();
                editTextarea.value = tweetText.replace(/\(編集済み\)/, '').trim();
                updateModalCharCount();
                modal.show();
            });
        });

        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                modal.hide();
            });
        });

        if (saveButton) {
            saveButton.addEventListener('click', function() {
                // Here you would typically send an AJAX request to save the tweet
                // For now, we'll just close the modal
                modal.hide();
            });
        }
    });
</script>

<style>
/* スクロール追尾広告のスタイル */
.sticky-ad-container {
    position: sticky;
    top: 2rem;
    z-index: 100;
}

/* スクロール時のアニメーション */
.sticky-ad-container .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.sticky-ad-container .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.15) !important;
}

/* モバイル対応 */
@media (max-width: 991.98px) {
    .sticky-ad-container {
        position: static;
        margin-top: 1rem;
    }
}

/* 広告エリアの境界線アニメーション */
.sticky-ad-container .card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
}

/* 広告読み込み時のプレースホルダー */
.adsbygoogle[data-ad-status="unfilled"] {
    min-height: 250px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.adsbygoogle[data-ad-status="unfilled"]::before {
    content: "広告読み込み中...";
    color: #6c757d;
    font-size: 0.875rem;
    font-weight: 500;
}

/* 視覚効果の改善 */
.sticky-ad-container .card {
    border: 1px solid rgba(0, 0, 0, 0.05);
    backdrop-filter: blur(10px);
    background-color: rgba(255, 255, 255, 0.95);
}

/* スクロールインジケーター */
.sticky-ad-container::before {
    content: '';
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 30px;
    height: 3px;
    background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);
    border-radius: 2px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.sticky-ad-container.scrolled::before {
    opacity: 1;
}
</style>

<script>
// スクロール追尾の動作制御
document.addEventListener('DOMContentLoaded', function() {
    const stickyAdContainer = document.querySelector('.sticky-ad-container');
    if (!stickyAdContainer) return;
    
    let isScrolled = false;

    function handleScroll() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > 100 && !isScrolled) {
            isScrolled = true;
            stickyAdContainer.classList.add('scrolled');
        } else if (scrollTop <= 100 && isScrolled) {
            isScrolled = false;
            stickyAdContainer.classList.remove('scrolled');
        }
    }

    // スクロールイベントリスナー（パフォーマンス最適化済み）
    let ticking = false;
    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(function() {
                handleScroll();
                ticking = false;
            });
            ticking = true;
        }
    });

    // 広告読み込み完了の監視
    const adElements = document.querySelectorAll('.adsbygoogle');
    adElements.forEach(function(ad) {
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'data-ad-status') {
                    if (ad.getAttribute('data-ad-status') === 'filled') {
                        ad.style.minHeight = 'auto';
                    }
                }
            });
        });
        
        observer.observe(ad, {
            attributes: true,
            attributeFilter: ['data-ad-status']
        });
    });
});
</script>

{{-- @include('components.premium-modal') --}}
@endsection