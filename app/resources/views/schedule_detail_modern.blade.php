@extends('layouts.app')

@section('content')
@vite(['resources/css/app-modern.css'])

<div class="py-4" style="min-height: 100vh; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #e3f2fd 100%);">
    <!-- Success Message -->
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

    <div class="container">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-lg border-0" style="border-radius: 16px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body p-4 text-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h1 class="h3 fw-bold mb-2 d-flex align-items-center">
                                    <svg width="32" height="32" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                    {{ $travelPlan->trip_title }}
                                </h1>
                                <div class="d-flex flex-column flex-md-row">
                                    <p class="mb-1 me-md-4 d-flex align-items-center">
                                        <svg width="18" height="18" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h6m-6 0l-1 14a2 2 0 002 2h4a2 2 0 002-2L15 7m-6 0l1 14a2 2 0 002 2h4a2 2 0 002-2l1-14m-8 0h8" />
                                        </svg>
                                        期間：{{ $formatted_start }} 〜 {{ $formatted_end }}
                                    </p>
                                    <p class="mb-0 d-flex align-items-center">
                                        <svg width="18" height="18" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $dateCount }}日間の旅行
                                    </p>
                                </div>
                            </div>
                            <a href="/home" class="btn btn-light d-flex align-items-center" style="transition: all 0.2s;">
                                <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                ホームに戻る
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Day-by-day Schedule -->
        @php
            $balance = $travelPlan->budget;
        @endphp
        
        @for($i = 0; $i < $dateCount; $i++)
            <div class="row mb-4">
                <div class="col-12">
                    <!-- Day Header -->
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between" style="border-radius: 12px 12px 0 0; cursor: pointer;" id="dayHeader{{ $i }}" onclick="toggleDay({{ $i }})">
                            <div class="d-flex align-items-center">
                                <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h6m-6 0l-1 14a2 2 0 002 2h4a2 2 0 002-2L15 7m-6 0l1 14a2 2 0 002 2h4a2 2 0 002-2l1-14m-8 0h8" />
                                </svg>
                                <h4 class="mb-0 fw-bold">{{ $displayDays[$i] }}</h4>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-light text-dark me-3" id="toggleText{{ $i }}">
                                    {{ $displayFlags[$displayDays[$i]] ? 'クリックで閉じる' : 'クリックで表示' }}
                                </span>
                                <svg width="20" height="20" class="toggle-icon" id="toggleIcon{{ $i }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="transform: {{ $displayFlags[$displayDays[$i]] ? 'rotate(180deg)' : 'rotate(0deg)' }}; transition: transform 0.3s;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>

                        <!-- Day Content -->
                        <div class="day-content" id="dayContent{{ $i }}" style="display: {{ $displayFlags[$displayDays[$i]] ? 'block' : 'none' }};">
                            <!-- Action Buttons -->
                            <div class="card-body border-bottom">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <form action="{{ route('schedule.detailNew', ['travel_plan_id' => $travelPlan->id, 'date' => $displayDays[$i]]) }}" method="POST" class="d-inline w-100">
                                            @csrf
                                            <button class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center" name="newDetail">
                                                <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                予定追加
                                            </button>
                                            <input type="hidden" name="travel_plan_id" value="{{ $travelPlan->id }}">
                                            <input type="hidden" name="travelDate" value="{{ $displayDays[$i] }}">
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                        <form action="{{ route('schedule.detailEdit', ['travel_plan_id' => $travelPlan->id, 'date' => $displayDays[$i]]) }}" method="POST" class="d-inline w-100">
                                            @csrf
                                            <button class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center" name="editDetail">
                                                <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                予定編集
                                            </button>
                                            <input type="hidden" name="travel_plan_id" value="{{ $travelPlan->id }}">
                                            <input type="hidden" name="travelDate" value="{{ $displayDays[$i] }}">
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                        <form action="{{ route('schedule.belongings', ['id' => $travelPlan->id]) }}" method="GET" class="d-inline w-100">
                                            <button class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center" name="belongingsDetail">
                                                <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                                持ち物編集
                                            </button>
                                            <input type="hidden" name="travel_plan_id" value="{{ $travelPlan->id }}">
                                            <input type="hidden" name="travelDate" value="{{ $displayDays[$i] }}">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Tabs -->
                            <div class="card-body p-0">
                                <div class="tabs-container">
                                    <!-- Tab Navigation -->
                                    <ul class="nav nav-tabs border-0" id="dayTabs{{ $i }}" role="tablist" style="background-color: #f8f9fa;">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="expense-tab-{{ $i }}" data-bs-toggle="tab" data-bs-target="#expense{{ $i }}" type="button" role="tab">
                                                <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                                </svg>
                                                支出管理
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="schedule-tab-{{ $i }}" data-bs-toggle="tab" data-bs-target="#schedule{{ $i }}" type="button" role="tab">
                                                <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                スケジュール
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="tweets-tab-{{ $i }}" data-bs-toggle="tab" data-bs-target="#tweets{{ $i }}" type="button" role="tab">
                                                <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                </svg>
                                                つぶやき
                                            </button>
                                        </li>
                                    </ul>

                                    <!-- Tab Content -->
                                    <div class="tab-content" id="dayTabContent{{ $i }}">
                                        <!-- Expense Tab -->
                                        <div class="tab-pane fade show active" id="expense{{ $i }}" role="tabpanel">
                                            <div class="table-responsive p-3">
                                                <table class="table table-hover">
                                                    <thead class="table-primary">
                                                        <tr>
                                                            <th scope="col">
                                                                <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                                </svg>
                                                                種目
                                                            </th>
                                                            <th scope="col">内容</th>
                                                            <th scope="col">金額(小計)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- 朝食 -->
                                                        <tr>
                                                            <td class="fw-semibold">
                                                                <span class="badge bg-warning text-dark">朝食</span>
                                                            </td>
                                                            @if($contents1Data[$i] ?? null)
                                                                <td>{{ $contents1Data[$i]->implode(', ') }}</td>
                                                                <td class="fw-bold text-success">¥{{ number_format($price1Data[$i]->sum()) }}</td>
                                                            @else
                                                                <td class="text-muted">-</td>
                                                                <td class="text-muted">-</td>
                                                            @endif
                                                        </tr>
                                                        <!-- 昼食 -->
                                                        <tr>
                                                            <td class="fw-semibold">
                                                                <span class="badge bg-info">昼食</span>
                                                            </td>
                                                            @if($contents2Data[$i] ?? null)
                                                                <td>{{ $contents2Data[$i]->implode(', ') }}</td>
                                                                <td class="fw-bold text-success">¥{{ number_format($price2Data[$i]->sum()) }}</td>
                                                            @else
                                                                <td class="text-muted">-</td>
                                                                <td class="text-muted">-</td>
                                                            @endif
                                                        </tr>
                                                        <!-- 夕食 -->
                                                        <tr>
                                                            <td class="fw-semibold">
                                                                <span class="badge bg-dark">夕食</span>
                                                            </td>
                                                            @if($contents3Data[$i] ?? null)
                                                                <td>{{ $contents3Data[$i]->implode(', ') }}</td>
                                                                <td class="fw-bold text-success">¥{{ number_format($price3Data[$i]->sum()) }}</td>
                                                            @else
                                                                <td class="text-muted">-</td>
                                                                <td class="text-muted">-</td>
                                                            @endif
                                                        </tr>
                                                        <!-- 間食 -->
                                                        <tr>
                                                            <td class="fw-semibold">
                                                                <span class="badge bg-secondary">間食</span>
                                                            </td>
                                                            @if($contents4Data[$i] ?? null)
                                                                <td>{{ $contents4Data[$i]->implode(', ') }}</td>
                                                                <td class="fw-bold text-success">¥{{ number_format($price4Data[$i]->sum()) }}</td>
                                                            @else
                                                                <td class="text-muted">-</td>
                                                                <td class="text-muted">-</td>
                                                            @endif
                                                        </tr>
                                                        <!-- 交通費 -->
                                                        <tr>
                                                            <td class="fw-semibold">
                                                                <span class="badge bg-primary">交通費</span>
                                                            </td>
                                                            @if($contents5Data[$i] ?? null)
                                                                <td>{{ $contents5Data[$i]->implode(', ') }}</td>
                                                                <td class="fw-bold text-success">¥{{ number_format($price5Data[$i]->sum()) }}</td>
                                                            @else
                                                                <td class="text-muted">-</td>
                                                                <td class="text-muted">-</td>
                                                            @endif
                                                        </tr>
                                                        <!-- 宿泊費 -->
                                                        <tr>
                                                            <td class="fw-semibold">
                                                                <span class="badge bg-success">宿泊費</span>
                                                            </td>
                                                            @if($contents6Data[$i] ?? null)
                                                                <td>{{ $contents6Data[$i]->implode(', ') }}</td>
                                                                <td class="fw-bold text-success">¥{{ number_format($price6Data[$i]->sum()) }}</td>
                                                            @else
                                                                <td class="text-muted">-</td>
                                                                <td class="text-muted">-</td>
                                                            @endif
                                                        </tr>
                                                        <!-- お土産 -->
                                                        <tr>
                                                            <td class="fw-semibold">
                                                                <span class="badge" style="background-color: #e91e63; color: white;">お土産</span>
                                                            </td>
                                                            @if($contents7Data[$i] ?? null)
                                                                <td>{{ $contents7Data[$i]->implode(', ') }}</td>
                                                                <td class="fw-bold text-success">¥{{ number_format($price7Data[$i]->sum()) }}</td>
                                                            @else
                                                                <td class="text-muted">-</td>
                                                                <td class="text-muted">-</td>
                                                            @endif
                                                        </tr>
                                                        <!-- レジャー -->
                                                        <tr>
                                                            <td class="fw-semibold">
                                                                <span class="badge" style="background-color: #ff9800; color: white;">レジャー</span>
                                                            </td>
                                                            @if($contents8Data[$i] ?? null)
                                                                <td>{{ $contents8Data[$i]->implode(', ') }}</td>
                                                                <td class="fw-bold text-success">¥{{ number_format($price8Data[$i]->sum()) }}</td>
                                                            @else
                                                                <td class="text-muted">-</td>
                                                                <td class="text-muted">-</td>
                                                            @endif
                                                        </tr>
                                                        <!-- その他雑費 -->
                                                        <tr>
                                                            <td class="fw-semibold">
                                                                <span class="badge bg-light text-dark">その他雑費</span>
                                                            </td>
                                                            @if($contents10Data[$i] ?? null)
                                                                <td>{{ $contents10Data[$i]->implode(', ') }}</td>
                                                                <td class="fw-bold text-success">¥{{ number_format($price10Data[$i]->sum()) }}</td>
                                                            @else
                                                                <td class="text-muted">-</td>
                                                                <td class="text-muted">-</td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                    <tfoot class="table-danger">
                                                        <tr>
                                                            <th scope="row" class="fw-bold">合計金額</th>
                                                            <td></td>
                                                            <th scope="col">
                                                                @if(
                                                                    $price2Data[$i] ?? null ||
                                                                    $price3Data[$i] ?? null ||
                                                                    $price4Data[$i] ?? null ||
                                                                    $price5Data[$i] ?? null ||
                                                                    $price6Data[$i] ?? null ||
                                                                    $price7Data[$i] ?? null ||
                                                                    $price8Data[$i] ?? null ||
                                                                    $price1Data[$i] ?? null ||
                                                                    $price10Data[$i] ?? null
                                                                )
                                                                    @php
                                                                        if($balance != null && $balance - $totalPrice[$i] < 0 && $totalPrice[$i] != 0) {
                                                                            $balance = $balance - $totalPrice[$i];
                                                                            echo '<span class="fw-bold">¥' . number_format($totalPrice[$i]) . '</span><span class="text-danger fw-bold ms-2">(' . '¥' . number_format(abs($balance)) . 'オーバー)</span>';
                                                                        } else if($balance != null && $balance - $totalPrice[$i] > 0 && $totalPrice[$i] != 0) {
                                                                            $balance = $balance - $totalPrice[$i];
                                                                            echo '<span class="fw-bold">¥' . number_format($totalPrice[$i]) . '</span><span class="text-success fw-bold ms-2">(残り¥' . number_format($balance) . ')</span>';
                                                                        } else {
                                                                            $balance = $balance - $totalPrice[$i];
                                                                            echo '<span class="fw-bold">¥' . number_format($totalPrice[$i]) . '</span>';
                                                                        }
                                                                    @endphp
                                                                @endif
                                                            </th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Schedule Tab -->
                                        <div class="tab-pane fade" id="schedule{{ $i }}" role="tabpanel">
                                            <div class="p-3">
                                                @php
                                                    $hasSchedule = false;
                                                    foreach ($contents9 as $row) {
                                                        if (substr($row->time_from, 0, 10) == $displayDays[$i]) {
                                                            $hasSchedule = true;
                                                            break;
                                                        }
                                                    }
                                                @endphp

                                                @if($hasSchedule)
                                                    <div class="timeline">
                                                        @foreach ($contents9 as $row)
                                                            @if(substr($row->time_from, 0, 10) == $displayDays[$i])
                                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                                    <div class="timeline-marker">
                                                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 12px; height: 12px; min-width: 12px;"></div>
                                                                    </div>
                                                                    <div class="timeline-content ms-3 flex-grow-1">
                                                                        <div class="card border-start border-primary border-3" style="border-radius: 8px;">
                                                                            <div class="card-body py-2 px-3">
                                                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                                                    <span class="badge bg-primary">{{ substr($row->time_from, 11, 5) }}～{{ substr($row->time_to, 11, 5) }}</span>
                                                                                </div>
                                                                                <p class="mb-0">{{ $row->contents }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="text-center py-5">
                                                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #e3f2fd 0%, #f8f9fa 100%);">
                                                            <svg width="30" height="30" style="color: #6c757d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                        <h5 class="fw-bold mb-2">予定がありません</h5>
                                                        <p class="text-muted">「予定追加」ボタンからスケジュールを追加してください</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Tweets Tab -->
                                        <div class="tab-pane fade" id="tweets{{ $i }}" role="tabpanel">
                                            <div class="p-3">
                                                @php
                                                    $dayTweets = $tweets->filter(function($tweet) use ($displayDays, $i) {
                                                        return substr($tweet->updated_at, 0, 10) == $displayDays[$i];
                                                    });
                                                @endphp

                                                @if($dayTweets->count() > 0)
                                                    @foreach ($dayTweets as $tweet)
                                                        <div class="tweet-card mb-3">
                                                            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                                                                <div class="card-body p-3">
                                                                    <div class="d-flex align-items-start">
                                                                        <div class="me-3">
                                                                            <div class="rounded-circle bg-info d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                                                <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                                                </svg>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <div class="tweet-content mb-2" style="line-height: 1.6;">
                                                                                {!! nl2br(e($tweet->tweet)) !!}
                                                                                @if($tweet->editFlg == 1)
                                                                                    <span class="badge bg-secondary ms-2 small">編集済み</span>
                                                                                @endif
                                                                            </div>
                                                                            <small class="text-muted d-flex align-items-center">
                                                                                <svg width="14" height="14" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                                </svg>
                                                                                {{ $tweet->updated_at }}
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="text-center py-5">
                                                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #e3f2fd 0%, #f8f9fa 100%);">
                                                            <svg width="30" height="30" style="color: #6c757d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                            </svg>
                                                        </div>
                                                        <h5 class="fw-bold mb-2">つぶやきがありません</h5>
                                                        <p class="text-muted">この日のつぶやきはまだありません</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>

<style>
/* Timeline styles */
.timeline {
    position: relative;
}

.timeline-item {
    position: relative;
}

.timeline-item:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 5px;
    top: 20px;
    bottom: -15px;
    width: 2px;
    background: linear-gradient(to bottom, #007bff, #e9ecef);
}

.timeline-marker {
    position: relative;
    z-index: 2;
}

/* Tab styling */
.nav-tabs .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 500;
    transition: all 0.2s;
}

.nav-tabs .nav-link.active {
    background-color: #007bff;
    color: white;
    border-radius: 8px 8px 0 0;
}

.nav-tabs .nav-link:hover {
    border: none;
    color: #007bff;
}

/* Card animations */
.card {
    transition: all 0.3s ease;
}

.day-content {
    transition: all 0.3s ease;
}

.toggle-icon {
    transition: transform 0.3s ease;
}

/* Table styling */
.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

/* Badge custom colors */
.badge {
    font-size: 0.75em;
    font-weight: 500;
}

/* Tweet card styling */
.tweet-card {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive improvements */
@media (max-width: 768px) {
    .card-body {
        padding: 1rem;
    }
    
    .table-responsive {
        font-size: 0.9rem;
    }
    
    .nav-tabs {
        font-size: 0.9rem;
    }
    
    .timeline-content {
        margin-left: 1rem !important;
    }
}

/* Scrollbar styling */
.tab-content::-webkit-scrollbar {
    width: 6px;
}

.tab-content::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.tab-content::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

.tab-content::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Day toggle functionality
    window.toggleDay = function(dayIndex) {
        const content = document.getElementById('dayContent' + dayIndex);
        const icon = document.getElementById('toggleIcon' + dayIndex);
        const text = document.getElementById('toggleText' + dayIndex);
        
        if (content.style.display === 'none') {
            content.style.display = 'block';
            icon.style.transform = 'rotate(180deg)';
            text.textContent = 'クリックで閉じる';
        } else {
            content.style.display = 'none';
            icon.style.transform = 'rotate(0deg)';
            text.textContent = 'クリックで表示';
        }
    };

    // Initialize Bootstrap tabs
    const tabTriggerEls = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabTriggerEls.forEach(tabTriggerEl => {
        const tabTrigger = new bootstrap.Tab(tabTriggerEl);
    });

    // Add smooth scrolling for day headers
    document.querySelectorAll('[id^="dayHeader"]').forEach(header => {
        header.addEventListener('click', function() {
            this.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    // Add hover effects to cards
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            if (!this.classList.contains('shadow-lg')) {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 0.5rem 1rem rgba(0, 0, 0, 0.15)';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            if (!this.classList.contains('shadow-lg')) {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
            }
        });
    });

    // Format numbers in tables
    document.querySelectorAll('td, th').forEach(cell => {
        if (cell.textContent.includes('¥') && !cell.textContent.includes(',')) {
            const text = cell.textContent;
            const match = text.match(/¥(\d+)/);
            if (match) {
                const formattedNumber = parseInt(match[1]).toLocaleString();
                cell.innerHTML = text.replace(/¥\d+/, '¥' + formattedNumber);
            }
        }
    });
});
</script>
@endsection