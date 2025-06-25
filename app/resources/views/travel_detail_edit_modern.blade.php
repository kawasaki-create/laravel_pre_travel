@extends('layouts.app')

@section('content')
@vite(['resources/css/app-modern.css'])

<div class="py-4" style="min-height: 100vh; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #e3f2fd 100%);">
    <div class="container">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-lg border-0" style="border-radius: 16px; background: linear-gradient(135deg, #ff7979 0%, #eb4d4b 100%);">
                    <div class="card-body p-4 text-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h1 class="h3 fw-bold mb-2 d-flex align-items-center">
                                    <svg width="32" height="32" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    詳細スケジュール管理
                                </h1>
                                <div class="d-flex flex-column flex-md-row">
                                    <p class="mb-1 me-md-4 d-flex align-items-center">
                                        <svg width="18" height="18" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h4M9 7h6m-6 4h6m-2 4h2" />
                                        </svg>
                                        {{ $travelPlan->trip_title }}
                                    </p>
                                    <p class="mb-0 d-flex align-items-center">
                                        <svg width="18" height="18" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h6m-6 0l-1 14a2 2 0 002 2h4a2 2 0 002-2L15 7m-6 0l1 14a2 2 0 002 2h4a2 2 0 002-2l1-14m-8 0h8" />
                                        </svg>
                                        {{ $travelDate }}
                                    </p>
                                </div>
                            </div>
                            <a href="/schedule/detail/{{ $travelPlanId }}" class="btn btn-light d-flex align-items-center" style="transition: all 0.2s;">
                                <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                詳細画面に戻る
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('status'))
            <div class="alert alert-success d-flex align-items-center mb-4" role="alert" style="border-left: 4px solid #28a745;">
                <div class="me-3">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" style="color: #28a745;">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="mb-0" style="color: #155724;">{{ session('status') }}</p>
                </div>
            </div>
        @endif

        <div class="row g-4">
            <!-- Add New Items Section -->
            <div class="col-12">
                <div class="card shadow-lg border-0" style="border-radius: 16px;">
                    <div class="card-header text-white border-0" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 16px 16px 0 0;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <h3 class="h5 mb-0 fw-bold">新しいアイテムを追加</h3>
                            </div>
                            <button class="btn btn-light btn-sm" id="toggleAddBtn" type="button">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0" id="addSection" style="display: none;">
                        @php
                            $detailCount = $travelPlan->travelDetail()->count();
                            $canCreateDetail = $travelPlan->user->isPremiumUser() || $detailCount < 20;
                        @endphp

                        <!-- Expense Form -->
                        <form action="{{ route('schedule.detailNR') }}" method="POST" id="expenseForm" onsubmit="return checkDetailCount({{ $travelPlan->user->canAddDetailUnlimited() ? 1 : 0 }}, {{ $detailCount }});"
                            @csrf
                            <div class="p-4 border-bottom">
                                <h6 class="fw-bold mb-3 d-flex align-items-center">
                                    <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                    </svg>
                                    食事・費用を追加
                                </h6>
                                <div class="row g-3">
                                    <!-- Expense categories in compact form -->
                                    <div class="col-md-6">
                                        <div class="p-2 rounded" style="background: #fff3cd; border-left: 3px solid #ffc107;">
                                            <small class="fw-bold">朝食</small>
                                            <div class="d-flex gap-2 mt-1">
                                                <input type="text" name="contents1" class="form-control form-control-sm" placeholder="内容" style="border-radius: 6px;">
                                                <div class="input-group input-group-sm" style="max-width: 120px;">
                                                    <span class="input-group-text">¥</span>
                                                    <input type="number" name="price1" class="form-control" placeholder="620" style="border-radius: 0 6px 6px 0;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-2 rounded" style="background: #cff4fc; border-left: 3px solid #0dcaf0;">
                                            <small class="fw-bold">昼食</small>
                                            <div class="d-flex gap-2 mt-1">
                                                <input type="text" name="contents2" class="form-control form-control-sm" placeholder="内容" style="border-radius: 6px;">
                                                <div class="input-group input-group-sm" style="max-width: 120px;">
                                                    <span class="input-group-text">¥</span>
                                                    <input type="number" name="price2" class="form-control" placeholder="1200" style="border-radius: 0 6px 6px 0;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-2 rounded" style="background: #f8d7da; border-left: 3px solid #dc3545;">
                                            <small class="fw-bold">夕食</small>
                                            <div class="d-flex gap-2 mt-1">
                                                <input type="text" name="contents3" class="form-control form-control-sm" placeholder="内容" style="border-radius: 6px;">
                                                <div class="input-group input-group-sm" style="max-width: 120px;">
                                                    <span class="input-group-text">¥</span>
                                                    <input type="number" name="price3" class="form-control" placeholder="3500" style="border-radius: 0 6px 6px 0;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-2 rounded" style="background: #e2e3e5; border-left: 3px solid #6c757d;">
                                            <small class="fw-bold">間食</small>
                                            <div class="d-flex gap-2 mt-1">
                                                <input type="text" name="contents4" class="form-control form-control-sm" placeholder="内容" style="border-radius: 6px;">
                                                <div class="input-group input-group-sm" style="max-width: 120px;">
                                                    <span class="input-group-text">¥</span>
                                                    <input type="number" name="price4" class="form-control" placeholder="350" style="border-radius: 0 6px 6px 0;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-2 rounded" style="background: #cfe2ff; border-left: 3px solid #0d6efd;">
                                            <small class="fw-bold">交通費</small>
                                            <div class="d-flex gap-2 mt-1">
                                                <input type="text" name="contents5" class="form-control form-control-sm" placeholder="内容" style="border-radius: 6px;">
                                                <div class="input-group input-group-sm" style="max-width: 120px;">
                                                    <span class="input-group-text">¥</span>
                                                    <input type="number" name="price5" class="form-control" placeholder="5600" style="border-radius: 0 6px 6px 0;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-2 rounded" style="background: #d1e7dd; border-left: 3px solid #198754;">
                                            <small class="fw-bold">宿泊費</small>
                                            <div class="d-flex gap-2 mt-1">
                                                <input type="text" name="contents6" class="form-control form-control-sm" placeholder="内容" style="border-radius: 6px;">
                                                <div class="input-group input-group-sm" style="max-width: 120px;">
                                                    <span class="input-group-text">¥</span>
                                                    <input type="number" name="price6" class="form-control" placeholder="8900" style="border-radius: 0 6px 6px 0;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-2 rounded" style="background: #fce4ec; border-left: 3px solid #e91e63;">
                                            <small class="fw-bold">お土産</small>
                                            <div class="d-flex gap-2 mt-1">
                                                <input type="text" name="contents7" class="form-control form-control-sm" placeholder="内容" style="border-radius: 6px;">
                                                <div class="input-group input-group-sm" style="max-width: 120px;">
                                                    <span class="input-group-text">¥</span>
                                                    <input type="number" name="price7" class="form-control" placeholder="2500" style="border-radius: 0 6px 6px 0;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-2 rounded" style="background: #fff3e0; border-left: 3px solid #ff9800;">
                                            <small class="fw-bold">レジャー</small>
                                            <div class="d-flex gap-2 mt-1">
                                                <input type="text" name="contents8" class="form-control form-control-sm" placeholder="内容" style="border-radius: 6px;">
                                                <div class="input-group input-group-sm" style="max-width: 120px;">
                                                    <span class="input-group-text">¥</span>
                                                    <input type="number" name="price8" class="form-control" placeholder="4200" style="border-radius: 0 6px 6px 0;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-2 rounded" style="background: #f8f9fa; border-left: 3px solid #6c757d;">
                                            <small class="fw-bold">その他雑費</small>
                                            <div class="d-flex gap-2 mt-1">
                                                <input type="text" name="contents10" class="form-control form-control-sm" placeholder="内容" style="border-radius: 6px;">
                                                <div class="input-group input-group-sm" style="max-width: 120px;">
                                                    <span class="input-group-text">¥</span>
                                                    <input type="number" name="price9" class="form-control" placeholder="300" style="border-radius: 0 6px 6px 0;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" name="plan-register" class="btn btn-primary">
                                        <svg width="14" height="14" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        費用を追加
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="travel_plan_id" value="{{ $travelPlanId }}">
                            <input type="hidden" name="travelDate" value="{{ $travelDate }}">
                        </form>

                        <!-- Schedule Form -->
                        <form action="{{ route('schedule.detailNR') }}" method="POST" id="scheduleForm" onsubmit="return checkDetailCount({{ $travelPlan->user->canAddDetailUnlimited() ? 1 : 0 }}, {{ $detailCount }});"
                            @csrf
                            <div class="p-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="fw-bold mb-0 d-flex align-items-center">
                                        <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        スケジュールを追加
                                    </h6>
                                    <div>
                                        <button type="button" class="btn btn-success btn-sm me-2" id="addScheduleBtn">
                                            <svg width="14" height="14" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            追加
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm" id="removeScheduleBtn">
                                            <svg width="14" height="14" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                            </svg>
                                            削除
                                        </button>
                                    </div>
                                </div>
                                
                                <div id="timeContainer" style="max-height: 300px; overflow-y: auto;">
                                    <div class="schedule-item mb-2">
                                        <div class="card border-0" style="background: #f8f9fa;">
                                            <div class="card-body p-2">
                                                <div class="row g-2 align-items-center">
                                                    <div class="col-1">
                                                        <span class="badge bg-secondary">1</span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="time" name="time-from-1" class="form-control form-control-sm" style="border-radius: 6px;">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="time" name="time-to-1" class="form-control form-control-sm" style="border-radius: 6px;">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" name="going-1" class="form-control form-control-sm" placeholder="予定内容" style="border-radius: 6px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center mt-3">
                                    <button type="submit" name="todo-register" class="btn btn-info">
                                        <svg width="14" height="14" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        スケジュールを追加
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" id="timeCnt" name="timeCnt" value="1">
                            <input type="hidden" name="travel_plan_id" value="{{ $travelPlanId }}">
                            <input type="hidden" name="travelDate" value="{{ $travelDate }}">
                        </form>
                    </div>
                </div>
            </div>

            <!-- Existing Items Management Section -->
            <div class="col-12">
                @php
                    $hasItems = false;
                    $allContents = collect();
                    
                    // Collect all matching contents
                    foreach(['contents1', 'contents2', 'contents3', 'contents4', 'contents5', 'contents6', 'contents7', 'contents8', 'contents10'] as $contentVar) {
                        if(isset($$contentVar)) {
                            $matching = $$contentVar->where('date', $travelDate);
                            if($matching->isNotEmpty()) {
                                $hasItems = true;
                                $allContents = $allContents->merge($matching);
                            }
                        }
                    }
                    
                    // Also check for schedule items (contents9)
                    $scheduleItems = collect();
                    if(isset($contents9)) {
                        $scheduleItems = $contents9->filter(function($item) use ($travelDate) {
                            return substr($item->time_from, 0, 10) == $travelDate;
                        });
                        if($scheduleItems->isNotEmpty()) {
                            $hasItems = true;
                        }
                    }
                @endphp

                @if($hasItems)
                    <!-- Deletion Management Card -->
                    <div class="card shadow-lg border-0" style="border-radius: 16px;">
                        <div class="card-header text-white border-0" style="background: linear-gradient(135deg, #ff7979 0%, #eb4d4b 100%); border-radius: 16px 16px 0 0;">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                    <h3 class="h5 mb-0 fw-bold">登録済みアイテム管理</h3>
                                </div>
                                <span class="badge bg-light text-dark">{{ $allContents->count() + $scheduleItems->count() }}件</span>
                            </div>
                        </div>

                        <form action="{{ route('schedule.detailDelete') }}" method="POST" id="deleteForm">
                            @csrf
                            <div class="card-body p-0">
                                <!-- Select All Header -->
                                <div class="p-4 border-bottom bg-light">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAll">
                                            <label class="form-check-label fw-semibold" for="selectAll">
                                                すべて選択
                                            </label>
                                        </div>
                                        <small class="text-muted">削除するアイテムを選択してください</small>
                                    </div>
                                </div>

                                <!-- Items List -->
                                <div class="p-3">
                                    <!-- Expense Items -->
                                    @php
                                        $categories = [
                                            'contents1' => ['name' => '朝食', 'color' => '#ffc107', 'bg' => '#fff3cd'],
                                            'contents2' => ['name' => '昼食', 'color' => '#0dcaf0', 'bg' => '#cff4fc'],
                                            'contents3' => ['name' => '夕食', 'color' => '#343a40', 'bg' => '#f8d7da'],
                                            'contents4' => ['name' => '間食', 'color' => '#6c757d', 'bg' => '#e2e3e5'],
                                            'contents5' => ['name' => '交通費', 'color' => '#0d6efd', 'bg' => '#cfe2ff'],
                                            'contents6' => ['name' => '宿泊費', 'color' => '#198754', 'bg' => '#d1e7dd'],
                                            'contents7' => ['name' => 'お土産', 'color' => '#e91e63', 'bg' => '#fce4ec'],
                                            'contents8' => ['name' => 'レジャー', 'color' => '#ff9800', 'bg' => '#fff3e0'],
                                            'contents10' => ['name' => 'その他雑費', 'color' => '#6c757d', 'bg' => '#f8f9fa']
                                        ];
                                    @endphp

                                    @foreach($categories as $contentVar => $category)
                                        @if(isset($$contentVar))
                                            @php $matchingContents = $$contentVar->where('date', $travelDate); @endphp
                                            @if($matchingContents->isNotEmpty())
                                                @foreach($matchingContents as $content)
                                                    <div class="expense-item p-3 mb-2 rounded" style="background-color: {{ $category['bg'] }}; border-left: 4px solid {{ $category['color'] }}; transition: all 0.2s; cursor: pointer;" data-id="{{ $content->id }}" data-category="{{ $contentVar }}" onclick="editExpenseItem(this)">
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check me-3">
                                                                <input type="checkbox" name="deletes[]" value="{{ $content->id }}" class="form-check-input item-checkbox" onclick="event.stopPropagation()">
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex align-items-center mb-1">
                                                                    <span class="badge" style="background-color: {{ $category['color'] }}; color: white;">{{ $category['name'] }}</span>
                                                                    <span class="fw-semibold ms-2 editable-content" data-original="{{ $content->contents }}">{{ $content->contents }}</span>
                                                                    <button class="btn btn-sm btn-outline-primary ms-auto edit-btn" style="display: none;" onclick="event.stopPropagation()">
                                                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                                <div class="text-success fw-bold editable-price" data-original="{{ $content->price }}">¥{{ number_format($content->price) }}</div>
                                                            </div>
                                                            <div class="text-muted">
                                                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endif
                                    @endforeach

                                    <!-- Schedule Items -->
                                    @if($scheduleItems->isNotEmpty())
                                        @foreach($scheduleItems as $scheduleItem)
                                            <div class="schedule-item p-3 mb-2 rounded" style="background-color: #e3f2fd; border-left: 4px solid #2196f3; transition: all 0.2s; cursor: pointer;" data-id="{{ $scheduleItem->id }}" onclick="editScheduleItem(this)">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check me-3">
                                                        <input type="checkbox" name="deletes[]" value="{{ $scheduleItem->id }}" class="form-check-input item-checkbox" onclick="event.stopPropagation()">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center mb-1">
                                                            <span class="badge bg-primary">スケジュール</span>
                                                            <span class="fw-semibold ms-2 editable-schedule-content" data-original="{{ $scheduleItem->contents }}">{{ $scheduleItem->contents }}</span>
                                                            <button class="btn btn-sm btn-outline-primary ms-auto edit-btn" style="display: none;" onclick="event.stopPropagation()">
                                                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div class="text-primary small editable-schedule-time" 
                                                             data-time-from="{{ substr($scheduleItem->time_from, 11, 5) }}" 
                                                             data-time-to="{{ substr($scheduleItem->time_to, 11, 5) }}">
                                                            <svg width="14" height="14" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            {{ substr($scheduleItem->time_from, 11, 5) }}～{{ substr($scheduleItem->time_to, 11, 5) }}
                                                        </div>
                                                    </div>
                                                    <div class="text-muted">
                                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <!-- Action Footer -->
                            <div class="card-footer bg-light border-0 d-flex align-items-center justify-content-between" style="border-radius: 0 0 16px 16px;">
                                <div class="d-flex align-items-center">
                                    <span class="text-muted small me-3">選択済み: </span>
                                    <span id="selectedCount" class="badge bg-danger">0</span>
                                    <span class="text-muted small ms-1">件</span>
                                </div>
                                <button type="submit" class="btn btn-danger" id="deleteButton" disabled style="transition: all 0.2s;">
                                    <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    選択したアイテムを削除
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-5">
                        <div class="card shadow-sm" style="max-width: 500px; margin: 0 auto; border-radius: 16px;">
                            <div class="card-body py-5">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 80px; height: 80px; background: linear-gradient(135deg, #e3f2fd 0%, #f8f9fa 100%);">
                                    <svg width="40" height="40" style="color: #6c757d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                </div>
                                <h3 class="h5 fw-bold mb-3">この日の登録データがありません</h3>
                                <p class="text-muted mb-4">まだ {{ $travelDate }} の詳細は登録されていません</p>
                                <a href="/schedule/detail/{{ $travelPlanId }}" class="btn text-white" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); transition: all 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    詳細画面に戻る
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Custom animations */
.expense-item, .schedule-item {
    transform: translateX(0);
    transition: all 0.3s ease;
}

.expense-item:hover, .schedule-item:hover {
    transform: translateX(5px);
}

/* Checkbox styling */
.form-check-input:checked {
    background-color: #dc3545;
    border-color: #dc3545;
}

.form-check-input:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

/* Button states */
.btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .card {
        margin: 0 1rem;
    }
    
    .d-flex.align-items-center.justify-content-between {
        flex-direction: column;
        text-align: center;
    }
    
    .d-flex.align-items-center.justify-content-between > div {
        margin-bottom: 0.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle functionality for add section
    const toggleAddBtn = document.getElementById('toggleAddBtn');
    const addSection = document.getElementById('addSection');
    
    if (toggleAddBtn) {
        toggleAddBtn.addEventListener('click', function() {
            if (addSection.style.display === 'none') {
                addSection.style.display = 'block';
                this.querySelector('svg').style.transform = 'rotate(180deg)';
            } else {
                addSection.style.display = 'none';
                this.querySelector('svg').style.transform = 'rotate(0deg)';
            }
        });
    }

    // Schedule management
    const addScheduleBtn = document.getElementById('addScheduleBtn');
    const removeScheduleBtn = document.getElementById('removeScheduleBtn');
    const timeContainer = document.getElementById('timeContainer');
    const timeCntInput = document.getElementById('timeCnt');
    
    let currentScheduleCount = 1;

    function updateScheduleCount() {
        timeCntInput.value = currentScheduleCount;
    }

    // Add schedule functionality
    if (addScheduleBtn) {
        addScheduleBtn.addEventListener('click', function() {
            if (currentScheduleCount < 10) {
                currentScheduleCount++;
                const newSchedule = document.createElement('div');
                newSchedule.className = 'schedule-item mb-2';
                newSchedule.innerHTML = `
                    <div class="card border-0" style="background: #f8f9fa;">
                        <div class="card-body p-2">
                            <div class="row g-2 align-items-center">
                                <div class="col-1">
                                    <span class="badge bg-secondary">${currentScheduleCount}</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="time" name="time-from-${currentScheduleCount}" class="form-control form-control-sm" style="border-radius: 6px;">
                                </div>
                                <div class="col-md-3">
                                    <input type="time" name="time-to-${currentScheduleCount}" class="form-control form-control-sm" style="border-radius: 6px;">
                                </div>
                                <div class="col">
                                    <input type="text" name="going-${currentScheduleCount}" class="form-control form-control-sm" placeholder="予定内容" style="border-radius: 6px;">
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                timeContainer.appendChild(newSchedule);
                updateScheduleCount();
            } else {
                alert('スケジュールは最大10個まで追加できます。');
            }
        });
    }

    // Remove last schedule functionality
    if (removeScheduleBtn) {
        removeScheduleBtn.addEventListener('click', function() {
            if (currentScheduleCount > 1) {
                const lastSchedule = timeContainer.lastElementChild;
                lastSchedule.remove();
                currentScheduleCount--;
                updateScheduleCount();
            }
        });
    }

    // Form validation
    function validateForm(form) {
        const inputs = form.querySelectorAll('input[type="text"], input[type="number"], input[type="time"]');
        let hasContent = false;
        
        inputs.forEach(input => {
            if (input.value.trim()) {
                hasContent = true;
            }
        });
        
        return hasContent;
    }

    // Form submission handlers
    const expenseForm = document.getElementById('expenseForm');
    const scheduleForm = document.getElementById('scheduleForm');
    
    if (expenseForm) {
        expenseForm.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
                alert('少なくとも一つの項目を入力してください。');
                return;
            }
        });
    }

    if (scheduleForm) {
        scheduleForm.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
                alert('少なくとも一つのスケジュールを入力してください。');
                return;
            }
        });
    }

    // Deletion management functionality
    const selectAllCheckbox = document.getElementById('selectAll');
    const itemCheckboxes = document.querySelectorAll('.item-checkbox');
    const deleteButton = document.getElementById('deleteButton');
    const selectedCountElement = document.getElementById('selectedCount');
    const deleteForm = document.getElementById('deleteForm');

    // Update selected count and button state
    function updateUI() {
        const checkedBoxes = document.querySelectorAll('.item-checkbox:checked');
        const count = checkedBoxes.length;
        
        selectedCountElement.textContent = count;
        deleteButton.disabled = count === 0;
        
        // Update select all checkbox state
        if (count === 0) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = false;
        } else if (count === itemCheckboxes.length) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = true;
        } else {
            selectAllCheckbox.indeterminate = true;
        }
    }

    // Select all functionality
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            const isChecked = this.checked;
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
            updateUI();
        });
    }

    // Individual checkbox change
    itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateUI);
    });

    // Delete form submission
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            const checkedBoxes = document.querySelectorAll('.item-checkbox:checked');
            if (checkedBoxes.length === 0) {
                e.preventDefault();
                return;
            }

            const count = checkedBoxes.length;
            const confirmMessage = `選択した${count}件のアイテムを削除しますか？\\n\\nこの操作は取り消せません。`;
            
            if (!confirm(confirmMessage)) {
                e.preventDefault();
            }
        });
    }

    // Initial UI update
    updateUI();
    
    // Initial count update for schedule
    updateScheduleCount();
});

// Inline editing functionality
function editExpenseItem(element) {
    const contentSpan = element.querySelector('.editable-content');
    const priceSpan = element.querySelector('.editable-price');
    const editBtn = element.querySelector('.edit-btn');
    
    if (contentSpan && priceSpan) {
        const itemId = element.dataset.id;
        const originalContent = contentSpan.dataset.original;
        const originalPrice = priceSpan.dataset.original;
        
        // Create edit form
        const editForm = `
            <div class="edit-form-inline" style="width: 100%;">
                <form onsubmit="saveExpenseEdit(event, ${itemId})" style="display: flex; gap: 10px; align-items: center; width: 100%;">
                    <input type="text" class="form-control form-control-sm" value="${originalContent}" name="content" required style="flex: 1;">
                    <div class="input-group input-group-sm" style="max-width: 150px;">
                        <span class="input-group-text">¥</span>
                        <input type="number" class="form-control" value="${originalPrice}" name="price" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">保存</button>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="cancelEdit(this)">取消</button>
                </form>
            </div>
        `;
        
        // Replace content with edit form
        const container = element.querySelector('.flex-grow-1');
        container.innerHTML = editForm;
    }
}

function editScheduleItem(element) {
    const contentSpan = element.querySelector('.editable-schedule-content');
    const timeSpan = element.querySelector('.editable-schedule-time');
    
    if (contentSpan && timeSpan) {
        const itemId = element.dataset.id;
        const originalContent = contentSpan.dataset.original;
        const timeFrom = timeSpan.dataset.timeFrom;
        const timeTo = timeSpan.dataset.timeTo;
        
        // Create edit form
        const editForm = `
            <div class="edit-form-inline" style="width: 100%;">
                <form onsubmit="saveScheduleEdit(event, ${itemId})" style="display: flex; flex-direction: column; gap: 10px; width: 100%;">
                    <input type="text" class="form-control form-control-sm" value="${originalContent}" name="content" required placeholder="予定内容">
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="time" class="form-control form-control-sm" value="${timeFrom}" name="time_from" required>
                        <span>～</span>
                        <input type="time" class="form-control form-control-sm" value="${timeTo}" name="time_to" required>
                        <button type="submit" class="btn btn-success btn-sm">保存</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="cancelEdit(this)">取消</button>
                    </div>
                </form>
            </div>
        `;
        
        // Replace content with edit form
        const container = element.querySelector('.flex-grow-1');
        container.innerHTML = editForm;
    }
}

function saveExpenseEdit(event, itemId) {
    event.preventDefault();
    const form = event.target;
    const content = form.content.value;
    const price = form.price.value;
    
    // Send AJAX request to update
    fetch('/schedule/update-detail', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            id: itemId,
            contents: content,
            price: price
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload page to show updated data
            location.reload();
        } else {
            alert('更新に失敗しました');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('更新に失敗しました');
    });
}

function saveScheduleEdit(event, itemId) {
    event.preventDefault();
    const form = event.target;
    const content = form.content.value;
    const timeFrom = form.time_from.value;
    const timeTo = form.time_to.value;
    
    // Send AJAX request to update
    fetch('/schedule/update-detail', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            id: itemId,
            contents: content,
            time_from: timeFrom + ':00',
            time_to: timeTo + ':00'
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload page to show updated data
            location.reload();
        } else {
            alert('更新に失敗しました');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('更新に失敗しました');
    });
}

function cancelEdit(button) {
    // Reload page to cancel edit
    location.reload();
}

// Detail count check function - プレミアムモーダル無効化
function checkDetailCount(isPremium, detailCount) {
    // プレミアムモーダル表示を無効化し、常にフォーム送信を許可
    return true; // 常にフォームの送信を許可
}
</script>

{{-- @include('components.premium-modal') --}}
@endsection