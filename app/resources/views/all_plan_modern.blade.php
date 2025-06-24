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

    <div class="container">
        <!-- Header Section -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 fw-bold mb-2" style="color: #212529;">旅行プラン一覧</h1>
                <p class="text-muted mb-0">すべての旅行プランを管理できます</p>
            </div>
            <div class="d-flex gap-2">
                <a href="/home" class="btn btn-outline-secondary d-flex align-items-center" style="transition: all 0.2s;">
                    <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    ホームに戻る
                </a>
                <a href="/schedule" class="btn text-white d-flex align-items-center" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); transition: all 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    新しい旅行
                </a>
            </div>
        </div>

        <!-- Travel Plans Grid -->
        @if(count($travelPlans) > 0)
            <div class="row g-4">
                @foreach($travelPlans as $travelPlan)
                    @php
                        $time = substr($travelPlan->departure_time, 11, 8);
                        $ftime = substr($time, 0, 5);
                        $isActive = $travelPlan->trip_start <= date('Y-m-d H:i:s', strtotime('+1 day')) && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end;
                        $isPast = $travelPlan->trip_end < date('Y-m-d');
                        $isFuture = $travelPlan->trip_start > date('Y-m-d');
                    @endphp
                    
                    <div class="col-lg-6 col-xl-4">
                        <div class="card h-100 shadow-sm" style="transition: all 0.3s; border: none;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='';">
                            <!-- Status Banner -->
                            @if($isActive)
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge text-white" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); animation: pulse 2s infinite;">
                                        ✈️ 旅行中
                                    </span>
                                </div>
                            @elseif($isFuture)
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge" style="background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%); color: white;">
                                        🗓️ 予定
                                    </span>
                                </div>
                            @elseif($isPast)
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-secondary">
                                        📝 完了
                                    </span>
                                </div>
                            @endif

                            <!-- Card Header with Gradient -->
                            <div class="card-header border-0 text-white" style="background: linear-gradient(135deg, {{ $isActive ? '#28a745, #20c997' : ($isFuture ? '#007bff, #6f42c1' : '#6c757d, #495057') }});">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0 fw-bold">{{ $travelPlan->trip_title }}</h5>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-light border-0" type="button" data-bs-toggle="dropdown">
                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                            </svg>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="{{ route('schedule.edit', ['id' => $travelPlan->id]) }}">
                                                <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                編集
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('schedule.detail', ['id' => $travelPlan->id]) }}">
                                                <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                                詳細設定
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('schedule.belongings', ['id' => $travelPlan->id]) }}">
                                                <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h1.586a1 1 0 01.707.293l1.414 1.414a1 1 0 00.707.293H15a2 2 0 012 2v0M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m0 0V6a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293L13.293 2.293A1 1 0 0012.586 2H9.414a1 1 0 00-.707.293L7.293 3.707A1 1 0 006.586 4H5a2 2 0 00-2 2v2z" />
                                                </svg>
                                                持ち物管理
                                            </a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('schedule.delete', ['id' => $travelPlan->id]) }}" method="GET" style="display:inline;" onsubmit="return confirm('「{{ $travelPlan->trip_title }}」を削除しますか？\n\nこの操作は取り消せません。');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        削除
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Travel Dates -->
                                    <div class="col-12">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="rounded p-2 me-3" style="background-color: {{ $isActive ? '#d4edda' : ($isFuture ? '#e3f2fd' : '#f8f9fa') }};">
                                                <svg width="16" height="16" style="color: {{ $isActive ? '#28a745' : ($isFuture ? '#007bff' : '#6c757d') }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="small text-muted mb-0">期間</p>
                                                <p class="mb-0 fw-semibold">{{ $travelPlan->trip_start }} 〜 {{ $travelPlan->trip_end }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Departure Time -->
                                    @if($time != '00:00:00')
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="rounded p-2 me-3" style="background-color: #fff3cd;">
                                                    <svg width="16" height="16" style="color: #ffc107;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="small text-muted mb-0">出発時刻</p>
                                                    <p class="mb-0 fw-semibold">{{ $travelPlan->trip_start . ' ' . $ftime }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Meeting Place -->
                                    @if($travelPlan->meet_place)
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="rounded p-2 me-3" style="background-color: #e2e3f3;">
                                                    <svg width="16" height="16" style="color: #6f42c1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="small text-muted mb-0">集合場所</p>
                                                    <p class="mb-0 fw-semibold">{{ $travelPlan->meet_place }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Budget -->
                                    @if($travelPlan->budget)
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="rounded p-2 me-3" style="background-color: #d1ecf1;">
                                                    <svg width="16" height="16" style="color: #17a2b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="small text-muted mb-0">予算</p>
                                                    <p class="mb-0 fw-semibold">¥{{ number_format($travelPlan->budget) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Footer -->
                            <div class="card-footer bg-transparent border-0 pt-0">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <a href="{{ route('schedule.edit', ['id' => $travelPlan->id]) }}" class="btn btn-outline-primary btn-sm w-100">
                                            <svg width="14" height="14" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            編集
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('schedule.detail', ['id' => $travelPlan->id]) }}" class="btn btn-outline-success btn-sm w-100">
                                            <svg width="14" height="14" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            詳細
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5">
                <div class="card shadow-sm" style="max-width: 500px; margin: 0 auto;">
                    <div class="card-body py-5">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 80px; height: 80px; background: linear-gradient(135deg, #e3f2fd 0%, #f8f9fa 100%);">
                            <svg width="40" height="40" style="color: #007bff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="h5 fw-bold mb-3">まだ旅行プランがありません</h3>
                        <p class="text-muted mb-4">新しい旅行を計画して、素敵な思い出を作りましょう！</p>
                        <a href="/schedule" class="btn text-white" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); transition: all 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                            <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            最初の旅行を作成
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}
</style>

<script>
    // Enhanced delete confirmation
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('[id="planDeleteButton"]');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                const tripTitle = form.getAttribute('data-trip-title') || '旅行';
                
                if (confirm(`「${tripTitle}」を削除しますか？\n\nこの操作は取り消せません。すべての詳細情報も削除されます。`)) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection