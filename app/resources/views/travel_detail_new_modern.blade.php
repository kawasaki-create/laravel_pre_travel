@extends('layouts.app')

@section('content')
@vite(['resources/css/app-modern.css'])

<div class="py-4" style="min-height: 100vh; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #e3f2fd 100%);">
    <div class="container">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-lg border-0" style="border-radius: 16px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <div class="card-body p-4 text-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h1 class="h3 fw-bold mb-2 d-flex align-items-center">
                                    <svg width="32" height="32" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    詳細スケジュール登録
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

        @php
            $detailCount = $travelPlan->travelDetail()->count();
            $canCreateDetail = $travelPlan->user->isPremiumUser() || $detailCount < 20;
        @endphp

        <div class="row g-4">
            <!-- Expense Section -->
            <div class="col-lg-6">
                <div class="card shadow-lg border-0" style="border-radius: 16px;">
                    <div class="card-header text-white border-0" style="background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%); border-radius: 16px 16px 0 0;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                </svg>
                                <h3 class="h5 mb-0 fw-bold">食事・費用を入力</h3>
                            </div>
                            <button class="btn btn-light btn-sm" id="toggleExpenseBtn" type="button">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0" id="expenseSection" style="display: none;">
                        <form action="{{ route('schedule.detailNR') }}" method="POST" id="expenseForm" onsubmit="return checkDetailCount({{ $travelPlan->user->canAddDetailUnlimited() ? 1 : 0 }}, {{ $detailCount }});"
                            @csrf
                            <div class="p-4">
                                <!-- Expense Categories -->
                                <div class="row g-3">
                                    <!-- 朝食 -->
                                    <div class="col-md-6">
                                        <div class="expense-item p-3 rounded" style="background: linear-gradient(135deg, #fff3cd 0%, #f8f9fa 100%); border-left: 4px solid #ffc107;">
                                            <h6 class="fw-bold mb-2 d-flex align-items-center">
                                                <span class="badge bg-warning text-dark me-2">朝食</span>
                                            </h6>
                                            <div class="mb-2">
                                                <input type="text" name="contents1" class="form-control" placeholder="例：ホテルビュッフェ" style="border-radius: 8px;">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text">¥</span>
                                                <input type="number" name="price1" class="form-control" placeholder="620" style="border-radius: 0 8px 8px 0;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 昼食 -->
                                    <div class="col-md-6">
                                        <div class="expense-item p-3 rounded" style="background: linear-gradient(135deg, #cff4fc 0%, #f8f9fa 100%); border-left: 4px solid #0dcaf0;">
                                            <h6 class="fw-bold mb-2 d-flex align-items-center">
                                                <span class="badge bg-info me-2">昼食</span>
                                            </h6>
                                            <div class="mb-2">
                                                <input type="text" name="contents2" class="form-control" placeholder="例：海鮮丼" style="border-radius: 8px;">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text">¥</span>
                                                <input type="number" name="price2" class="form-control" placeholder="1200" style="border-radius: 0 8px 8px 0;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 夕食 -->
                                    <div class="col-md-6">
                                        <div class="expense-item p-3 rounded" style="background: linear-gradient(135deg, #f8d7da 0%, #f8f9fa 100%); border-left: 4px solid #dc3545;">
                                            <h6 class="fw-bold mb-2 d-flex align-items-center">
                                                <span class="badge bg-dark me-2">夕食</span>
                                            </h6>
                                            <div class="mb-2">
                                                <input type="text" name="contents3" class="form-control" placeholder="例：懐石料理" style="border-radius: 8px;">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text">¥</span>
                                                <input type="number" name="price3" class="form-control" placeholder="3500" style="border-radius: 0 8px 8px 0;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 間食 -->
                                    <div class="col-md-6">
                                        <div class="expense-item p-3 rounded" style="background: linear-gradient(135deg, #e2e3e5 0%, #f8f9fa 100%); border-left: 4px solid #6c757d;">
                                            <h6 class="fw-bold mb-2 d-flex align-items-center">
                                                <span class="badge bg-secondary me-2">間食</span>
                                            </h6>
                                            <div class="mb-2">
                                                <input type="text" name="contents4" class="form-control" placeholder="例：アイスクリーム" style="border-radius: 8px;">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text">¥</span>
                                                <input type="number" name="price4" class="form-control" placeholder="350" style="border-radius: 0 8px 8px 0;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 交通費 -->
                                    <div class="col-md-6">
                                        <div class="expense-item p-3 rounded" style="background: linear-gradient(135deg, #cfe2ff 0%, #f8f9fa 100%); border-left: 4px solid #0d6efd;">
                                            <h6 class="fw-bold mb-2 d-flex align-items-center">
                                                <span class="badge bg-primary me-2">交通費</span>
                                            </h6>
                                            <div class="mb-2">
                                                <input type="text" name="contents5" class="form-control" placeholder="例：新幹線" style="border-radius: 8px;">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text">¥</span>
                                                <input type="number" name="price5" class="form-control" placeholder="5600" style="border-radius: 0 8px 8px 0;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 宿泊費 -->
                                    <div class="col-md-6">
                                        <div class="expense-item p-3 rounded" style="background: linear-gradient(135deg, #d1e7dd 0%, #f8f9fa 100%); border-left: 4px solid #198754;">
                                            <h6 class="fw-bold mb-2 d-flex align-items-center">
                                                <span class="badge bg-success me-2">宿泊費</span>
                                            </h6>
                                            <div class="mb-2">
                                                <input type="text" name="contents6" class="form-control" placeholder="例：温泉旅館" style="border-radius: 8px;">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text">¥</span>
                                                <input type="number" name="price6" class="form-control" placeholder="8900" style="border-radius: 0 8px 8px 0;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- お土産 -->
                                    <div class="col-md-6">
                                        <div class="expense-item p-3 rounded" style="background: linear-gradient(135deg, #fce4ec 0%, #f8f9fa 100%); border-left: 4px solid #e91e63;">
                                            <h6 class="fw-bold mb-2 d-flex align-items-center">
                                                <span class="badge" style="background-color: #e91e63; color: white;">お土産</span>
                                            </h6>
                                            <div class="mb-2">
                                                <input type="text" name="contents7" class="form-control" placeholder="例：地酒" style="border-radius: 8px;">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text">¥</span>
                                                <input type="number" name="price7" class="form-control" placeholder="2500" style="border-radius: 0 8px 8px 0;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- レジャー -->
                                    <div class="col-md-6">
                                        <div class="expense-item p-3 rounded" style="background: linear-gradient(135deg, #fff3e0 0%, #f8f9fa 100%); border-left: 4px solid #ff9800;">
                                            <h6 class="fw-bold mb-2 d-flex align-items-center">
                                                <span class="badge" style="background-color: #ff9800; color: white;">レジャー</span>
                                            </h6>
                                            <div class="mb-2">
                                                <input type="text" name="contents8" class="form-control" placeholder="例：遊園地" style="border-radius: 8px;">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text">¥</span>
                                                <input type="number" name="price8" class="form-control" placeholder="4200" style="border-radius: 0 8px 8px 0;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- その他雑費 -->
                                    <div class="col-md-12">
                                        <div class="expense-item p-3 rounded" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-left: 4px solid #6c757d;">
                                            <h6 class="fw-bold mb-2 d-flex align-items-center">
                                                <span class="badge bg-light text-dark me-2">その他雑費</span>
                                            </h6>
                                            <div class="mb-2">
                                                <input type="text" name="contents10" class="form-control" placeholder="例：コインロッカー" style="border-radius: 8px;">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text">¥</span>
                                                <input type="number" name="price9" class="form-control" placeholder="300" style="border-radius: 0 8px 8px 0;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="card-footer bg-light border-0" style="border-radius: 0 0 16px 16px;">
                                <div class="text-center">
                                    <button type="submit" name="plan-register" class="btn btn-lg text-white fw-bold" style="background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%); border-radius: 12px; padding: 12px 30px; transition: all 0.3s; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(255,154,158,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                        <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        費用を登録
                                    </button>
                                </div>
                            </div>

                            <input type="hidden" name="travel_plan_id" value="{{ $travelPlanId }}">
                            <input type="hidden" name="travelDate" value="{{ $travelDate }}">
                        </form>
                    </div>
                </div>
            </div>

            <!-- Schedule Section -->
            <div class="col-lg-6">
                <div class="card shadow-lg border-0" style="border-radius: 16px;">
                    <div class="card-header text-white border-0" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); border-radius: 16px 16px 0 0;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="h5 mb-0 fw-bold">予定を入力</h3>
                            </div>
                            <button class="btn btn-light btn-sm" id="toggleScheduleBtn" type="button">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0" id="scheduleSection" style="display: none;">
                        <form action="{{ route('schedule.detailNR') }}" method="POST" id="scheduleForm" onsubmit="return checkDetailCount({{ $travelPlan->user->canAddDetailUnlimited() ? 1 : 0 }}, {{ $detailCount }});"
                            @csrf
                            <div class="p-4">
                                <!-- Control Buttons -->
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div>
                                        <button type="button" name="add" class="btn btn-success btn-sm me-2" id="addScheduleBtn" style="border-radius: 8px;">
                                            <svg width="14" height="14" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            スケジュール追加
                                        </button>
                                        <button type="button" name="delete" class="btn btn-outline-danger btn-sm" id="removeScheduleBtn" style="border-radius: 8px;">
                                            <svg width="14" height="14" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                            </svg>
                                            削除
                                        </button>
                                    </div>
                                    <span class="badge bg-primary" id="scheduleCount">1項目</span>
                                </div>

                                <!-- Schedule Items Container -->
                                <div id="timeContainer" style="max-height: 400px; overflow-y: auto;">
                                    <div class="schedule-item mb-3">
                                        <div class="card border-0" style="background: linear-gradient(135deg, #f8f9fa 0%, #e3f2fd 100%); border-radius: 12px;">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="badge bg-secondary me-2" style="min-width: 30px;">1</span>
                                                    <h6 class="mb-0 fw-semibold">スケジュール詳細</h6>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col-md-6">
                                                        <label class="form-label small fw-semibold">開始時間</label>
                                                        <input type="time" name="time-from-1" class="form-control" style="border-radius: 8px;">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label small fw-semibold">終了時間</label>
                                                        <input type="time" name="time-to-1" class="form-control" style="border-radius: 8px;">
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label small fw-semibold">予定内容</label>
                                                        <input type="text" name="going-1" class="form-control" placeholder="例：○○神社参拝" style="border-radius: 8px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="card-footer bg-light border-0" style="border-radius: 0 0 16px 16px;">
                                <div class="text-center">
                                    <button type="submit" name="todo-register" class="btn btn-lg text-white fw-bold" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); border-radius: 12px; padding: 12px 30px; transition: all 0.3s; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(168,237,234,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                        <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        スケジュールを登録
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
        </div>
    </div>
</div>

<style>
/* Toggle animations */
.card-body {
    transition: all 0.3s ease;
}

/* Expense item hover effects */
.expense-item {
    transition: all 0.2s ease;
    cursor: pointer;
}

.expense-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Schedule item animations */
.schedule-item {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Form styling */
.form-control:focus {
    border-color: #4facfe !important;
    box-shadow: 0 0 0 0.2rem rgba(79, 172, 254, 0.25) !important;
}

/* Button states */
.btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Scrollbar styling */
#timeContainer::-webkit-scrollbar {
    width: 6px;
}

#timeContainer::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

#timeContainer::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

#timeContainer::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .card {
        margin: 0 1rem;
    }
    
    .btn-lg {
        padding: 10px 20px;
        font-size: 1rem;
    }
    
    .row.g-4 {
        flex-direction: column;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle functionality for sections
    const toggleExpenseBtn = document.getElementById('toggleExpenseBtn');
    const toggleScheduleBtn = document.getElementById('toggleScheduleBtn');
    const expenseSection = document.getElementById('expenseSection');
    const scheduleSection = document.getElementById('scheduleSection');

    // Toggle expense section
    toggleExpenseBtn.addEventListener('click', function() {
        if (expenseSection.style.display === 'none') {
            expenseSection.style.display = 'block';
            this.querySelector('svg').style.transform = 'rotate(180deg)';
        } else {
            expenseSection.style.display = 'none';
            this.querySelector('svg').style.transform = 'rotate(0deg)';
        }
    });

    // Toggle schedule section
    toggleScheduleBtn.addEventListener('click', function() {
        if (scheduleSection.style.display === 'none') {
            scheduleSection.style.display = 'block';
            this.querySelector('svg').style.transform = 'rotate(180deg)';
        } else {
            scheduleSection.style.display = 'none';
            this.querySelector('svg').style.transform = 'rotate(0deg)';
        }
    });

    // Schedule management
    const addScheduleBtn = document.getElementById('addScheduleBtn');
    const removeScheduleBtn = document.getElementById('removeScheduleBtn');
    const timeContainer = document.getElementById('timeContainer');
    const scheduleCountElement = document.getElementById('scheduleCount');
    const timeCntInput = document.getElementById('timeCnt');
    
    let currentScheduleCount = 1;

    function updateScheduleCount() {
        scheduleCountElement.textContent = `${currentScheduleCount}項目`;
        timeCntInput.value = currentScheduleCount;
    }

    // Add schedule functionality
    addScheduleBtn.addEventListener('click', function() {
        if (currentScheduleCount < 10) { // Limit to 10 items
            currentScheduleCount++;
            const newSchedule = document.createElement('div');
            newSchedule.className = 'schedule-item mb-3';
            newSchedule.innerHTML = `
                <div class="card border-0" style="background: linear-gradient(135deg, #f8f9fa 0%, #e3f2fd 100%); border-radius: 12px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-secondary me-2" style="min-width: 30px;">${currentScheduleCount}</span>
                            <h6 class="mb-0 fw-semibold">スケジュール詳細</h6>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">開始時間</label>
                                <input type="time" name="time-from-${currentScheduleCount}" class="form-control" style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">終了時間</label>
                                <input type="time" name="time-to-${currentScheduleCount}" class="form-control" style="border-radius: 8px;">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold">予定内容</label>
                                <input type="text" name="going-${currentScheduleCount}" class="form-control" placeholder="例：○○神社参拝" style="border-radius: 8px;">
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

    // Remove last schedule functionality
    removeScheduleBtn.addEventListener('click', function() {
        if (currentScheduleCount > 1) {
            const lastSchedule = timeContainer.lastElementChild;
            lastSchedule.remove();
            currentScheduleCount--;
            updateScheduleCount();
        }
    });

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
    document.getElementById('expenseForm').addEventListener('submit', function(e) {
        if (!validateForm(this)) {
            e.preventDefault();
            alert('少なくとも一つの項目を入力してください。');
            return;
        }
    });

    document.getElementById('scheduleForm').addEventListener('submit', function(e) {
        if (!validateForm(this)) {
            e.preventDefault();
            alert('少なくとも一つのスケジュールを入力してください。');
            return;
        }
    });

    // Initial count update
    updateScheduleCount();
});

// Detail count check function - プレミアムモーダル無効化
function checkDetailCount(isPremium, detailCount) {
    // プレミアムモーダル表示を無効化し、常にフォーム送信を許可
    return true; // 常にフォームの送信を許可
}
</script>

{{-- @include('components.premium-modal') --}}
@endsection