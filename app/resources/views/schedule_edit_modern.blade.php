@extends('layouts.app')

@section('content')
@vite(['resources/css/app-modern.css'])

<div class="py-4" style="min-height: 100vh; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #e3f2fd 100%);">
    <div class="container">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
                <svg width="40" height="40" fill="white" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <h1 class="h3 fw-bold mb-2" style="color: #212529;">旅行プランを編集</h1>
            <p class="text-muted">「{{ $travelPlan->trip_title }}」を更新します</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
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

                <!-- Navigation -->
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <a href="/schedule/all_plan/" class="btn btn-outline-secondary d-flex align-items-center" style="transition: all 0.2s;">
                        <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        旅行一覧に戻る
                    </a>
                    <a href="{{ route('schedule.detail', ['id' => $travelPlan->id]) }}" class="btn btn-outline-primary d-flex align-items-center" style="transition: all 0.2s;">
                        <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        詳細設定
                    </a>
                </div>

                <!-- Main Form Card -->
                <div class="card shadow-lg border-0" style="border-radius: 16px;">
                    <div class="card-header text-white border-0" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); border-radius: 16px 16px 0 0;">
                        <div class="d-flex align-items-center">
                            <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <h3 class="h5 mb-0 fw-bold">旅行スケジュール修正</h3>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('travel.edit') }}" method="POST">
                            @php
                                $url = $_SERVER['REQUEST_URI'];
                                $editUrl = ltrim(strrchr("$url", "/"), '/');
                            @endphp
                            @csrf
                            
                            <!-- Trip Title -->
                            <div class="mb-4">
                                <label for="trip-title" class="form-label d-flex align-items-center fw-semibold">
                                    <svg width="18" height="18" class="me-2" style="color: #007bff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    旅行名
                                </label>
                                <input type="text" name="trip-title" id="trip-title" class="form-control form-control-lg" value="{{ $travelPlan->trip_title }}" placeholder="例: 京都旅行、沖縄バケーション" required style="border-radius: 12px; border: 2px solid #e9ecef; transition: all 0.2s;" onfocus="this.style.borderColor='#007bff'; this.style.boxShadow='0 0 0 0.2rem rgba(0,123,255,0.25)'" onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'">
                            </div>

                            <!-- Travel Dates -->
                            <div class="mb-4">
                                <label class="form-label d-flex align-items-center fw-semibold">
                                    <svg width="18" height="18" class="me-2" style="color: #28a745;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    旅行期間
                                </label>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px; border: 2px solid #e9ecef; border-right: none;">
                                                <svg width="16" height="16" style="color: #6c757d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </span>
                                            <input type="date" name="trip-start" class="form-control border-start-0" value="{{ $formatted_start }}" required style="border-radius: 0 12px 12px 0; border: 2px solid #e9ecef; border-left: none;">
                                        </div>
                                        <small class="text-muted">開始日</small>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px; border: 2px solid #e9ecef; border-right: none;">
                                                <svg width="16" height="16" style="color: #6c757d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </span>
                                            <input type="date" name="trip-end" class="form-control border-start-0" value="{{ $formatted_end }}" required style="border-radius: 0 12px 12px 0; border: 2px solid #e9ecef; border-left: none;">
                                        </div>
                                        <small class="text-muted">終了日</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Meeting Place -->
                            <div class="mb-4">
                                <label for="meet-place" class="form-label d-flex align-items-center fw-semibold">
                                    <svg width="18" height="18" class="me-2" style="color: #6f42c1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    集合場所
                                    <span class="text-muted small ms-2">(任意)</span>
                                </label>
                                <input type="text" name="meet-place" id="meet-place" class="form-control" value="{{ $travelPlan->meet_place }}" placeholder="例: 東京駅八重洲口、羽田空港第1ターミナル" style="border-radius: 12px; border: 2px solid #e9ecef; transition: all 0.2s;" onfocus="this.style.borderColor='#6f42c1'; this.style.boxShadow='0 0 0 0.2rem rgba(111,66,193,0.25)'" onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'">
                            </div>

                            <!-- Departure Time -->
                            <div class="mb-4">
                                <label for="departure-time" class="form-label d-flex align-items-center fw-semibold">
                                    <svg width="18" height="18" class="me-2" style="color: #ffc107;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    家を出る時刻
                                    <span class="text-muted small ms-2">(任意)</span>
                                </label>
                                <div class="input-group" style="max-width: 200px;">
                                    <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px; border: 2px solid #e9ecef; border-right: none;">
                                        <svg width="16" height="16" style="color: #6c757d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                    <input type="time" name="departure-time" id="departure-time" class="form-control border-start-0" value="{{ $departure }}" style="border-radius: 0 12px 12px 0; border: 2px solid #e9ecef; border-left: none;">
                                </div>
                            </div>

                            <!-- Budget -->
                            <div class="mb-5">
                                <label for="budget" class="form-label d-flex align-items-center fw-semibold">
                                    <svg width="18" height="18" class="me-2" style="color: #17a2b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                    </svg>
                                    予算
                                    <span class="text-muted small ms-2">(任意)</span>
                                </label>
                                <div class="input-group" style="max-width: 300px;">
                                    <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px; border: 2px solid #e9ecef; border-right: none;">¥</span>
                                    <input type="number" name="budget" id="budget" class="form-control border-start-0 border-end-0" value="{{ $travelPlan->budget }}" placeholder="100000" min="0" style="border: 2px solid #e9ecef; border-left: none; border-right: none;">
                                    <span class="input-group-text bg-light border-start-0" style="border-radius: 0 12px 12px 0; border: 2px solid #e9ecef; border-left: none;">円</span>
                                </div>
                            </div>

                            <!-- Hidden Fields -->
                            <input type="hidden" name="plan-id" value="{{ $editUrl }}">

                            <!-- Action Buttons -->
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <a href="/schedule/all_plan/" class="btn btn-outline-secondary w-100" style="border-radius: 12px; padding: 12px;">
                                        <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        キャンセル
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="plan-register" class="btn btn-lg text-white fw-bold w-100" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); border-radius: 12px; padding: 12px; transition: all 0.3s; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(255,193,7,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                        <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        変更を保存
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="card mt-4 border-danger" style="border-radius: 12px;">
                    <div class="card-header bg-danger text-white" style="border-radius: 12px 12px 0 0;">
                        <h5 class="mb-0 d-flex align-items-center">
                            <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            危険な操作
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">この旅行プランを完全に削除します。この操作は取り消せません。</p>
                        <form action="{{ route('schedule.delete', ['id' => $travelPlan->id]) }}" method="GET" style="display:inline;" onsubmit="return confirm('「{{ $travelPlan->trip_title }}」を削除しますか？\n\nこの操作は取り消せません。すべての詳細情報も削除されます。');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                旅行プランを削除
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Help Text -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        <svg width="16" height="16" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        変更を保存した後、詳細設定で予定や持ち物を管理できます
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Form enhancements */
.form-control:focus {
    border-color: var(--bs-primary) !important;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25) !important;
}

.input-group .form-control:focus {
    z-index: 3;
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
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-calculate trip duration
    const startDate = document.querySelector('input[name="trip-start"]');
    const endDate = document.querySelector('input[name="trip-end"]');
    
    function updateDateValidation() {
        if (startDate.value && endDate.value) {
            const start = new Date(startDate.value);
            const end = new Date(endDate.value);
            
            if (end < start) {
                endDate.setCustomValidity('終了日は開始日以降を選択してください');
            } else {
                endDate.setCustomValidity('');
            }
        }
    }
    
    startDate.addEventListener('change', function() {
        if (this.value) {
            endDate.min = this.value;
            updateDateValidation();
        }
    });
    
    endDate.addEventListener('change', updateDateValidation);
    
    // Format budget input
    const budgetInput = document.getElementById('budget');
    budgetInput.addEventListener('input', function() {
        // Remove non-numeric characters
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});
</script>
@endsection