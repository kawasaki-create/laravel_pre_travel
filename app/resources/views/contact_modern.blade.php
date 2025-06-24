@extends('layouts.app')

@section('content')
@vite(['resources/css/app-modern.css'])

<div class="py-4" style="min-height: 100vh; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #e3f2fd 100%);">
    <div class="container">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
                <svg width="40" height="40" fill="white" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="h3 fw-bold mb-2" style="color: #212529;">お問い合わせ</h1>
            <p class="text-muted">ご質問・ご要望をお聞かせください</p>
        </div>

        <!-- Navigation -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <a href="/home" class="btn btn-outline-secondary d-flex align-items-center" style="transition: all 0.2s;">
                <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                ホームに戻る
            </a>
            <a href="/home/address/change" class="btn btn-outline-info d-flex align-items-center" style="transition: all 0.2s;">
                <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                アカウント設定
            </a>
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

                <!-- Main Form Card -->
                <div class="card shadow-lg border-0" style="border-radius: 16px;">
                    <div class="card-header text-white border-0" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); border-radius: 16px 16px 0 0;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <h3 class="h5 mb-0 fw-bold">お問い合わせフォーム</h3>
                            </div>
                            <span class="badge bg-warning text-dark">
                                <svg width="14" height="14" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                                全て入力必須
                            </span>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('contact.comfirm') }}" method="POST" id="contactForm">
                            @csrf
                            
                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="sender-name" class="form-label d-flex align-items-center fw-semibold">
                                    <svg width="18" height="18" class="me-2" style="color: #007bff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    お名前
                                    <span class="text-danger ms-1">*</span>
                                </label>
                                <input type="text" name="sender-name" id="sender-name" class="form-control form-control-lg" placeholder="お名前を入力してください" required maxlength="50" style="border-radius: 12px; border: 2px solid #e9ecef; transition: all 0.2s;" onfocus="this.style.borderColor='#007bff'; this.style.boxShadow='0 0 0 0.2rem rgba(0,123,255,0.25)'" onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'">
                                <small class="text-muted">実名またはニックネームをご入力ください</small>
                            </div>

                            <!-- Email Field -->
                            <div class="mb-4">
                                <label for="sender-emailaddress" class="form-label d-flex align-items-center fw-semibold">
                                    <svg width="18" height="18" class="me-2" style="color: #17a2b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                    メールアドレス
                                    <span class="text-danger ms-1">*</span>
                                </label>
                                <input type="email" name="sender-emailaddress" id="sender-emailaddress" class="form-control form-control-lg" value="{{ Auth::user()->email }}" placeholder="your.email@example.com" required style="border-radius: 12px; border: 2px solid #e9ecef; transition: all 0.2s;" onfocus="this.style.borderColor='#17a2b8'; this.style.boxShadow='0 0 0 0.2rem rgba(23,162,184,0.25)'" onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'">
                                <small class="text-muted">返信用のメールアドレスです</small>
                            </div>

                            <!-- Message Field -->
                            <div class="mb-5">
                                <label for="sender-message" class="form-label d-flex align-items-center fw-semibold">
                                    <svg width="18" height="18" class="me-2" style="color: #28a745;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1l-4 4z" />
                                    </svg>
                                    お問い合わせ内容
                                    <span class="text-danger ms-1">*</span>
                                </label>
                                <textarea name="sender-message" id="sender-message" class="form-control" rows="6" maxlength="500" placeholder="ご質問・ご要望・不具合報告など、お気軽にお聞かせください（最大500文字）" required style="border-radius: 12px; border: 2px solid #e9ecef; transition: all 0.2s; resize: vertical;" onfocus="this.style.borderColor='#28a745'; this.style.boxShadow='0 0 0 0.2rem rgba(40,167,69,0.25)'" onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'"></textarea>
                                <div class="d-flex justify-content-between mt-1">
                                    <small class="text-muted">具体的にご記入いただくと、より適切な回答ができます</small>
                                    <small class="text-muted"><span id="charCount">0</span>/500文字</small>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <a href="/home" class="btn btn-outline-secondary w-100" style="border-radius: 12px; padding: 12px;">
                                        <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        キャンセル
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="contact-submit" class="btn btn-lg text-white fw-bold w-100" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); border-radius: 12px; padding: 12px; transition: all 0.3s; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,123,255,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                        <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        内容を確認
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div class="card mt-4 border-info" style="border-radius: 12px;">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <svg width="24" height="24" style="color: #17a2b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-2">よくあるご質問</h6>
                                <ul class="mb-0 small text-muted">
                                    <li>パスワードを忘れた場合は、ログイン画面から「パスワードを忘れた方」をクリックしてください</li>
                                    <li>アプリの不具合については、発生した状況を詳しくお教えください</li>
                                    <li>新機能のご要望は大歓迎です。どのような機能があると便利かお聞かせください</li>
                                    <li>通常、1-2営業日以内に返信いたします</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Help Text -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        <svg width="16" height="16" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        お客様の個人情報は適切に保護され、お問い合わせ対応以外の目的では使用されません
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

/* Validation styling */
.form-control:valid {
    border-color: #28a745;
}

.form-control:invalid:not(:focus) {
    border-color: #dc3545;
}

/* Character counter */
#charCount.text-warning {
    color: #ffc107 !important;
}

#charCount.text-danger {
    color: #dc3545 !important;
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
    const form = document.getElementById('contactForm');
    const nameInput = document.getElementById('sender-name');
    const emailInput = document.getElementById('sender-emailaddress');
    const messageInput = document.getElementById('sender-message');
    const charCountElement = document.getElementById('charCount');
    
    // Character counter
    function updateCharCount() {
        const length = messageInput.value.length;
        charCountElement.textContent = length;
        
        if (length > 450) {
            charCountElement.className = 'text-danger';
        } else if (length > 350) {
            charCountElement.className = 'text-warning';
        } else {
            charCountElement.className = 'text-muted';
        }
    }
    
    // Form validation
    function validateForm() {
        const name = nameInput.value.trim();
        const email = emailInput.value.trim();
        const message = messageInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        let isValid = true;
        
        // Name validation
        if (name.length < 1 || name.length > 50) {
            nameInput.setCustomValidity('お名前は1文字以上50文字以下で入力してください');
            isValid = false;
        } else {
            nameInput.setCustomValidity('');
        }
        
        // Email validation
        if (!emailRegex.test(email)) {
            emailInput.setCustomValidity('有効なメールアドレスを入力してください');
            isValid = false;
        } else {
            emailInput.setCustomValidity('');
        }
        
        // Message validation
        if (message.length < 10) {
            messageInput.setCustomValidity('お問い合わせ内容は10文字以上入力してください');
            isValid = false;
        } else if (message.length > 500) {
            messageInput.setCustomValidity('お問い合わせ内容は500文字以下で入力してください');
            isValid = false;
        } else {
            messageInput.setCustomValidity('');
        }
        
        return isValid;
    }
    
    // Real-time validation and character counting
    messageInput.addEventListener('input', function() {
        updateCharCount();
        validateForm();
    });
    
    nameInput.addEventListener('input', validateForm);
    emailInput.addEventListener('input', validateForm);
    
    // Form submission
    form.addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
            return;
        }
        
        // Show loading state
        const submitButton = form.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>確認中...';
        
        // Reset button state if form validation fails on server side
        setTimeout(() => {
            if (submitButton.disabled) {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            }
        }, 5000);
    });
    
    // Initial character count update
    updateCharCount();
});
</script>
@endsection