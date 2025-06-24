@extends('layouts.app')

@section('content')
@vite(['resources/css/app-modern.css'])

<div class="py-4" style="min-height: 100vh; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #e3f2fd 100%);">
    <div class="container">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);">
                <svg width="40" height="40" fill="white" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                </svg>
            </div>
            <h1 class="h3 fw-bold mb-2" style="color: #212529;">アカウント設定</h1>
            <p class="text-muted">名前とメールアドレスを変更できます</p>
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
                    <a href="/home" class="btn btn-outline-secondary d-flex align-items-center" style="transition: all 0.2s;">
                        <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        ホームに戻る
                    </a>
                    <a href="/home/contact" class="btn btn-outline-primary d-flex align-items-center" style="transition: all 0.2s;">
                        <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        お問い合わせ
                    </a>
                </div>

                <!-- Current Account Info -->
                <div class="card shadow-sm mb-4" style="border-radius: 12px;">
                    <div class="card-header bg-light border-0 d-flex align-items-center" style="border-radius: 12px 12px 0 0;">
                        <svg width="20" height="20" class="me-2" style="color: #6c757d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h5 class="mb-0 fw-semibold">現在の設定</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <small class="text-muted d-block">現在の名前</small>
                                <p class="mb-0 fw-semibold">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">現在のメールアドレス</small>
                                <p class="mb-0 fw-semibold">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Form Card -->
                <div class="card shadow-lg border-0" style="border-radius: 16px;">
                    <div class="card-header text-white border-0" style="background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%); border-radius: 16px 16px 0 0;">
                        <div class="d-flex align-items-center">
                            <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <h3 class="h5 mb-0 fw-bold">アカウント情報を変更</h3>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('mail.change') }}" method="POST" id="accountForm">
                            @php
                                $url = $_SERVER['REQUEST_URI'];
                                $editUrl = ltrim(strrchr("$url", "/"), '/');
                            @endphp
                            @csrf
                            
                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="name" class="form-label d-flex align-items-center fw-semibold">
                                    <svg width="18" height="18" class="me-2" style="color: #007bff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    名前（ニックネーム）
                                </label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ Auth::user()->name }}" placeholder="あなたの名前を入力" required maxlength="50" style="border-radius: 12px; border: 2px solid #e9ecef; transition: all 0.2s;" onfocus="this.style.borderColor='#007bff'; this.style.boxShadow='0 0 0 0.2rem rgba(0,123,255,0.25)'" onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'">
                                <small class="text-muted">この名前は他のユーザーには表示されません</small>
                            </div>

                            <!-- Email Field -->
                            <div class="mb-5">
                                <label for="email" class="form-label d-flex align-items-center fw-semibold">
                                    <svg width="18" height="18" class="me-2" style="color: #17a2b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                    メールアドレス
                                </label>
                                <input type="email" name="email" id="email" class="form-control form-control-lg" value="{{ Auth::user()->email }}" placeholder="your.email@example.com" required style="border-radius: 12px; border: 2px solid #e9ecef; transition: all 0.2s;" onfocus="this.style.borderColor='#17a2b8'; this.style.boxShadow='0 0 0 0.2rem rgba(23,162,184,0.25)'" onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none'">
                                <small class="text-muted">ログインやパスワードリセットに使用されます</small>
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
                                    <button type="submit" name="mail-register" class="btn btn-lg text-white fw-bold w-100" style="background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%); border-radius: 12px; padding: 12px; transition: all 0.3s; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(23,162,184,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
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

                <!-- Security Notice -->
                <div class="card mt-4 border-info" style="border-radius: 12px;">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <svg width="24" height="24" style="color: #17a2b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-2">セキュリティについて</h6>
                                <ul class="mb-0 small text-muted">
                                    <li>メールアドレスを変更した場合、確認メールが送信されます</li>
                                    <li>パスワードの変更が必要な場合は、ログアウト後にパスワードリセットをご利用ください</li>
                                    <li>アカウントに関する問題がある場合は、お問い合わせからご連絡ください</li>
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
                        変更内容は即座に反映されます
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
    const form = document.getElementById('accountForm');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    
    // Form validation
    function validateForm() {
        const name = nameInput.value.trim();
        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        let isValid = true;
        
        // Name validation
        if (name.length < 1 || name.length > 50) {
            nameInput.setCustomValidity('名前は1文字以上50文字以下で入力してください');
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
        
        return isValid;
    }
    
    // Real-time validation
    nameInput.addEventListener('input', validateForm);
    emailInput.addEventListener('input', validateForm);
    
    // Form submission
    form.addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
            return;
        }
        
        // Check if any changes were made
        const currentName = '{{ Auth::user()->name }}';
        const currentEmail = '{{ Auth::user()->email }}';
        
        if (nameInput.value.trim() === currentName && emailInput.value.trim() === currentEmail) {
            e.preventDefault();
            alert('変更がありません。新しい名前またはメールアドレスを入力してください。');
            return;
        }
        
        // Confirm changes
        const confirmMessage = '以下の内容で変更しますか？\n\n' +
                              `名前: ${nameInput.value.trim()}\n` +
                              `メールアドレス: ${emailInput.value.trim()}`;
        
        if (!confirm(confirmMessage)) {
            e.preventDefault();
        }
    });
});
</script>
@endsection