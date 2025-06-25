{{-- Premium Modal - 完全無効化（コメントアウト）
<div class="modal fade" id="premiumModal" tabindex="-1" aria-labelledby="premiumModalLabel" aria-hidden="true" style="display: none !important;"> --}}
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <div class="modal-header text-white border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 16px 16px 0 0;">
                <div class="d-flex align-items-center">
                    <svg width="28" height="28" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    <h4 class="modal-title fw-bold mb-0" id="premiumModalLabel">プレミアム機能のご案内</h4>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4">
                <!-- 現在の状況 -->
                <div class="alert alert-info d-flex align-items-center mb-4" style="background: linear-gradient(135deg, #e3f2fd 0%, #f8f9fa 100%); border: 1px solid #b3e5fc;">
                    <svg width="24" height="24" class="me-3" style="color: #0288d1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h6 class="mb-1 fw-bold">機能制限に達しました</h6>
                        <p class="mb-0 small">モバイル無料版では制限があります。</p>
                    </div>
                </div>

                <!-- プレミアム機能の説明 -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="card h-100 border-0" style="background: linear-gradient(135deg, #f8f9fa 0%, #e3f2fd 100%);">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <svg width="48" height="48" style="color: #6c757d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h6 class="fw-bold mb-2">Web版について</h6>
                                <div class="text-muted small text-start">
                                    <p class="mb-1">✅ 旅行プラン: 無制限</p>
                                    <p class="mb-1">✅ つぶやき: 無制限</p>
                                    <p class="mb-2">✅ 旅行詳細: 無制限</p>
                                    <p class="mb-0 text-success small">Web版は広告表示により無制限利用可能</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card h-100 border-0" style="background: linear-gradient(135deg, #fff3e0 0%, #f8f9fa 100%);">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <svg width="48" height="48" style="color: #ff9800;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h6 class="fw-bold mb-2">モバイル版プレミアム</h6>
                                <p class="small text-muted mb-3">買い切りで永続的に無制限</p>
                                <a href="#" class="btn btn-outline-warning btn-sm" id="mobileAppBtn">
                                    <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <span id="mobileAppText">アプリをダウンロード</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- アプリ版の特典 -->
                <div class="card border-0 mb-4" style="background: linear-gradient(135deg, #e8f5e8 0%, #f8f9fa 100%);">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3 d-flex align-items-center">
                            <svg width="20" height="20" class="me-2" style="color: #28a745;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            アプリ版プレミアムの特典
                        </h6>
                        <ul class="mb-0 small">
                            <li>✅ 旅行プランを無制限で作成</li>
                            <li>✅ つぶやきを無制限で投稿</li>
                            <li>✅ 旅行詳細を無制限で追加</li>
                            <li>✅ 買い切りで永続利用</li>
                            <li>✅ オフライン機能</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                <a href="#" class="btn btn-primary" id="mainMobileAppBtn">アプリをダウンロード</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileAppBtn = document.getElementById('mobileAppBtn');
    const mobileAppText = document.getElementById('mobileAppText');
    const mainMobileAppBtn = document.getElementById('mainMobileAppBtn');
    
    // iOS/Android判別とストアリンク設定
    const userAgent = navigator.userAgent || navigator.vendor || window.opera;
    const iosStoreUrl = 'https://apps.apple.com/jp/app/pretravel-%E6%97%85%E8%A1%8C%E8%A8%88%E7%94%BB%E4%BD%9C%E6%88%90%E3%82%A2%E3%83%97%E3%83%AA/id6478861524';
    const androidStoreUrl = 'https://play.google.com/store/apps/details?id=com.pretravel.kawasaki_create.pre_travel_mobile';
    
    function setupAppButton(button, textElement) {
        if (!button) return;
        
        if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
            // iOS
            button.href = iosStoreUrl;
            if (textElement) textElement.textContent = 'App Storeでダウンロード';
            else button.textContent = 'App Storeでダウンロード';
        } else if (/android/i.test(userAgent)) {
            // Android
            button.href = androidStoreUrl;
            if (textElement) textElement.textContent = 'Google Playでダウンロード';
            else button.textContent = 'Google Playでダウンロード';
        } else {
            // その他（PC等）
            button.href = '#';
            if (textElement) textElement.textContent = 'モバイル端末でアクセス';
            else button.textContent = 'モバイル端末でアクセス';
            button.addEventListener('click', function(e) {
                e.preventDefault();
                alert('モバイル端末でアクセスしてアプリをダウンロードしてください。\\n\\niOS: App Store\\nAndroid: Google Play');
            });
        }
    }
    
    // ボタンの設定
    setupAppButton(mobileAppBtn, mobileAppText);
    setupAppButton(mainMobileAppBtn, null);
});
</script> --}}