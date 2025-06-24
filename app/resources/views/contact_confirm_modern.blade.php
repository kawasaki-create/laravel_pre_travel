@extends('layouts.app')

@section('content')
@vite(['resources/css/app-modern.css'])

<div class="py-4" style="min-height: 100vh; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #e3f2fd 100%);">
    <div class="container">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                <svg width="40" height="40" fill="white" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="h3 fw-bold mb-2" style="color: #212529;">お問い合わせ内容確認</h1>
            <p class="text-muted">入力内容をご確認ください</p>
        </div>

        <!-- Progress Steps -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #28a745; color: white;">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="mx-2 small fw-semibold text-success">入力完了</span>
                    </div>
                    <div class="flex-grow-1 mx-3" style="height: 2px; background-color: #28a745;"></div>
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background-color: #007bff; color: white;">
                            2
                        </div>
                        <span class="mx-2 small fw-semibold text-primary">内容確認</span>
                    </div>
                    <div class="flex-grow-1 mx-3" style="height: 2px; background-color: #e9ecef;"></div>
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background-color: #e9ecef; color: #6c757d;">
                            3
                        </div>
                        <span class="mx-2 small text-muted">送信完了</span>
                    </div>
                </div>
            </div>
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

                <!-- Confirmation Card -->
                <div class="card shadow-lg border-0" style="border-radius: 16px;">
                    <div class="card-header text-white border-0" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border-radius: 16px 16px 0 0;">
                        <div class="d-flex align-items-center">
                            <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <h3 class="h5 mb-0 fw-bold">確認事項</h3>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Name Section -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <svg width="18" height="18" class="me-2" style="color: #007bff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <label class="form-label fw-semibold mb-0">お名前</label>
                            </div>
                            <div class="ps-4">
                                <p class="mb-0 p-3 rounded" style="background-color: #f8f9fa; border-left: 4px solid #007bff;">{{ $name }}</p>
                            </div>
                        </div>

                        <!-- Email Section -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <svg width="18" height="18" class="me-2" style="color: #17a2b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                                <label class="form-label fw-semibold mb-0">メールアドレス</label>
                            </div>
                            <div class="ps-4">
                                <p class="mb-0 p-3 rounded" style="background-color: #f8f9fa; border-left: 4px solid #17a2b8;">{{ $email }}</p>
                                <small class="text-muted">このアドレスに返信いたします</small>
                            </div>
                        </div>

                        <!-- Message Section -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-2">
                                <svg width="18" height="18" class="me-2" style="color: #28a745;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1l-4 4z" />
                                </svg>
                                <label class="form-label fw-semibold mb-0">お問い合わせ内容</label>
                            </div>
                            <div class="ps-4">
                                <div class="p-3 rounded" style="background-color: #f8f9fa; border-left: 4px solid #28a745; line-height: 1.6; min-height: 120px;">
                                    {!! nl2br(e($message)) !!}
                                </div>
                                <small class="text-muted">文字数: {{ mb_strlen($message) }}文字</small>
                            </div>
                        </div>

                        <!-- Action Form -->
                        <form action="{{ route('contact.send', ['name' => $name, 'email' => $email, 'message'=> $message]) }}" method="POST" id="confirmForm">
                            @csrf
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <a href="javascript:history.back()" class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center" style="border-radius: 12px; padding: 12px;">
                                        <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        </svg>
                                        戻って修正
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="contact-submit" class="btn btn-lg text-white fw-bold w-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border-radius: 12px; padding: 12px; transition: all 0.3s; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(40,167,69,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                        <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                        お問い合わせ送信
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Important Notice -->
                <div class="card mt-4 border-warning" style="border-radius: 12px;">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <svg width="24" height="24" style="color: #ffc107;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-2">送信前の確認事項</h6>
                                <ul class="mb-0 small text-muted">
                                    <li>メールアドレスが正しく入力されているかご確認ください</li>
                                    <li>お問い合わせ内容に不足がないかご確認ください</li>
                                    <li>通常1-2営業日以内に返信いたします</li>
                                    <li>迷惑メールフォルダもご確認ください</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Help Text -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        <svg width="16" height="16" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        内容に間違いがなければ「お問い合わせ送信」ボタンをクリックしてください
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Progress steps responsive */
@media (max-width: 768px) {
    .d-flex.align-items-center.justify-content-center > div {
        flex-direction: column;
        text-align: center;
    }
    
    .flex-grow-1 {
        display: none !important;
    }
    
    .mx-2 {
        margin: 0.25rem 0 !important;
    }
}

/* Button enhancements */
.btn:hover {
    transform: translateY(-2px);
    transition: all 0.2s;
}

/* Card animations */
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('confirmForm');
    
    // Form submission with loading state
    form.addEventListener('submit', function(e) {
        const submitButton = form.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        
        // Show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>送信中...';
        
        // Disable back button during submission
        const backButton = document.querySelector('a[href="javascript:history.back()"]');
        if (backButton) {
            backButton.style.pointerEvents = 'none';
            backButton.style.opacity = '0.6';
        }
        
        // Reset state if something goes wrong (timeout)
        setTimeout(() => {
            if (submitButton.disabled) {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
                if (backButton) {
                    backButton.style.pointerEvents = '';
                    backButton.style.opacity = '';
                }
            }
        }, 10000);
    });
    
    // Prevent accidental navigation
    window.addEventListener('beforeunload', function(e) {
        if (form.querySelector('button[type="submit"]').disabled) {
            const confirmationMessage = 'お問い合わせを送信中です。このページを離れますか？';
            e.returnValue = confirmationMessage;
            return confirmationMessage;
        }
    });
});
</script>
@endsection