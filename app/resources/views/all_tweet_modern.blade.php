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
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 fw-bold mb-2 d-flex align-items-center" style="color: #212529;">
                    <svg width="32" height="32" class="me-3" style="color: #6f42c1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    過去のつぶやき一覧
                </h1>
                <p class="text-muted mb-0">あなたの旅行の思い出を振り返りましょう</p>
            </div>
            <a href="/home" class="btn btn-outline-secondary d-flex align-items-center" style="transition: all 0.2s;">
                <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                ホームに戻る
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if(count($tweets) > 0)
                    <!-- Tweet Management Card -->
                    <div class="card shadow-lg border-0" style="border-radius: 16px;">
                        <div class="card-header text-white border-0 d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #6f42c1 0%, #8e44ad 100%); border-radius: 16px 16px 0 0;">
                            <div class="d-flex align-items-center">
                                <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1l-4 4z" />
                                </svg>
                                <h3 class="h5 mb-0 fw-bold">つぶやき管理</h3>
                            </div>
                            <span class="badge bg-light text-dark">{{ count($tweets) }}件</span>
                        </div>

                        <form action="{{ route('allTweets.delete') }}" method="POST" id="deleteTweetsForm">
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
                                        <small class="text-muted">削除したいつぶやきを選択してください</small>
                                    </div>
                                </div>

                                <!-- Tweets List -->
                                <div class="p-3">
                                    @foreach ($tweets as $tweet)
                                        <div class="tweet-item p-3 mb-3 rounded" style="background-color: #f8f9fa; border-left: 4px solid #6f42c1; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#e3f2fd'" onmouseout="this.style.backgroundColor='#f8f9fa'">
                                            <div class="d-flex align-items-start">
                                                <div class="form-check me-3 mt-1">
                                                    <input type="checkbox" name="tweets[]" value="{{ $tweet->id }}" class="form-check-input tweet-checkbox">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="tweet-content mb-2" style="line-height: 1.6;">
                                                        {!! nl2br(e($tweet->tweet)) !!}
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <small class="text-muted d-flex align-items-center">
                                                            <svg width="14" height="14" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            {{ \Carbon\Carbon::parse($tweet->created_at)->format('Y年m月d日 H:i') }}
                                                        </small>
                                                        <small class="text-muted">{{ mb_strlen($tweet->tweet) }}文字</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Action Footer -->
                            <div class="card-footer bg-light border-0 d-flex align-items-center justify-content-between" style="border-radius: 0 0 16px 16px;">
                                <div class="d-flex align-items-center">
                                    <span class="text-muted small me-3">選択済み: </span>
                                    <span id="selectedCount" class="badge bg-primary">0</span>
                                    <span class="text-muted small ms-1">件</span>
                                </div>
                                <button type="submit" class="btn btn-danger" id="tweetDeleteButton" disabled style="transition: all 0.2s;">
                                    <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    選択したつぶやきを削除
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
                                    <svg width="40" height="40" style="color: #6f42c1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </div>
                                <h3 class="h5 fw-bold mb-3">まだつぶやきがありません</h3>
                                <p class="text-muted mb-4">旅行中につぶやいた思い出がここに表示されます</p>
                                <a href="/home" class="btn text-white" style="background: linear-gradient(135deg, #6f42c1 0%, #8e44ad 100%); transition: all 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    ホームに戻る
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
.tweet-item {
    transform: translateX(0);
    transition: all 0.3s ease;
}

.tweet-item:hover {
    transform: translateX(5px);
}

/* Checkbox styling */
.form-check-input:checked {
    background-color: #6f42c1;
    border-color: #6f42c1;
}

.form-check-input:focus {
    border-color: #6f42c1;
    box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
}

/* Button states */
.btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const tweetCheckboxes = document.querySelectorAll('.tweet-checkbox');
    const deleteButton = document.getElementById('tweetDeleteButton');
    const selectedCountElement = document.getElementById('selectedCount');
    const deleteForm = document.getElementById('deleteTweetsForm');

    // Update selected count and button state
    function updateUI() {
        const checkedBoxes = document.querySelectorAll('.tweet-checkbox:checked');
        const count = checkedBoxes.length;
        
        selectedCountElement.textContent = count;
        deleteButton.disabled = count === 0;
        
        // Update select all checkbox state
        if (count === 0) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = false;
        } else if (count === tweetCheckboxes.length) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = true;
        } else {
            selectAllCheckbox.indeterminate = true;
        }
    }

    // Select all functionality
    selectAllCheckbox.addEventListener('change', function() {
        const isChecked = this.checked;
        tweetCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        updateUI();
    });

    // Individual checkbox change
    tweetCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateUI);
    });

    // Delete form submission
    deleteForm.addEventListener('submit', function(e) {
        const checkedBoxes = document.querySelectorAll('.tweet-checkbox:checked');
        if (checkedBoxes.length === 0) {
            e.preventDefault();
            return;
        }

        const count = checkedBoxes.length;
        const confirmMessage = `選択した${count}件のつぶやきを削除しますか？\n\nこの操作は取り消せません。`;
        
        if (!confirm(confirmMessage)) {
            e.preventDefault();
        }
    });

    // Initial UI update
    updateUI();
});
</script>
@endsection