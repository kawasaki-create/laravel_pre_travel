<!-- Premium Modal -->
<div class="modal fade" id="premiumModal" tabindex="-1" aria-labelledby="premiumModalLabel" aria-hidden="true">
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
                        <h6 class="mb-1 fw-bold">旅行プランの上限に達しました</h6>
                        <p class="mb-0 small">無料会員は3つまでの旅行プランを作成できます。</p>
                    </div>
                </div>

                <!-- プレミアム機能の説明 -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="card h-100 border-0" style="background: linear-gradient(135deg, #f8f9fa 0%, #e3f2fd 100%);">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <svg width="48" height="48" style="color: #667eea;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h6 class="fw-bold mb-2">Web版プレミアム</h6>
                                <p class="small text-muted mb-3">広告を見て24時間無制限</p>
                                <button class="btn btn-outline-primary btn-sm" id="watchAdBtn">
                                    <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h8m-3-9v5l-2-2m2 2l2-2" />
                                    </svg>
                                    広告を見る
                                </button>
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
                                <p class="small text-muted mb-3">月額課金で永続的に無制限</p>
                                <a href="#" class="btn btn-outline-warning btn-sm">
                                    <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    アプリをダウンロード
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Web版プレミアムの詳細 -->
                <div class="card border-0 mb-4" style="background: linear-gradient(135deg, #e8f5e8 0%, #f8f9fa 100%);">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3 d-flex align-items-center">
                            <svg width="20" height="20" class="me-2" style="color: #28a745;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Web版プレミアムの特典
                        </h6>
                        <ul class="mb-0 small">
                            <li>✅ 旅行プランを無制限で作成</li>
                            <li>✅ 24時間有効（毎日更新可能）</li>
                            <li>✅ 完全無料（広告視聴のみ）</li>
                            <li>✅ すぐに利用開始</li>
                        </ul>
                    </div>
                </div>

                <!-- 広告表示エリア -->
                <div id="adContainer" class="text-center mb-4" style="display: none;">
                    <div class="card border-2 border-primary" style="border-radius: 12px;">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0 fw-bold">
                                <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                広告視聴中...
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <!-- Google AdSense 広告 -->
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1568606156833955"
                                 crossorigin="anonymous"></script>
                            <!-- PreTravel -->
                            <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-1568606156833955"
                                 data-ad-slot="6046649503"
                                 data-ad-format="auto"
                                 data-full-width-responsive="true"></ins>
                            <script>
                                 (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                            
                            <!-- 広告視聴完了ボタン -->
                            <div class="mt-3">
                                <p class="small text-muted mb-2">広告を確認後、下のボタンをクリックしてください</p>
                                <button class="btn btn-success" id="confirmAdBtn">
                                    <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    広告視聴完了
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- プレミアム状態表示 -->
                <div id="premiumStatus" style="display: none;">
                    <div class="alert alert-success d-flex align-items-center">
                        <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <div>
                            <h6 class="mb-1 fw-bold">プレミアム機能が有効になりました！</h6>
                            <p class="mb-0 small">24時間、旅行プランを無制限で作成できます。</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">後で</button>
                <button type="button" class="btn btn-primary" onclick="location.reload()">
                    ページを更新
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const watchAdBtn = document.getElementById('watchAdBtn');
    const adContainer = document.getElementById('adContainer');
    const confirmAdBtn = document.getElementById('confirmAdBtn');
    const premiumStatus = document.getElementById('premiumStatus');

    // 広告を見るボタンクリック
    watchAdBtn.addEventListener('click', function() {
        adContainer.style.display = 'block';
        watchAdBtn.disabled = true;
        watchAdBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>広告を読み込み中...';
        
        // 3秒後に広告視聴完了ボタンを有効化（実際は広告の読み込み完了を監視）
        setTimeout(() => {
            confirmAdBtn.disabled = false;
        }, 3000);
    });

    // 広告視聴完了ボタンクリック
    confirmAdBtn.addEventListener('click', function() {
        confirmAdBtn.disabled = true;
        confirmAdBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>処理中...';

        // APIに広告視聴を記録
        fetch('/api/ad/record', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                adContainer.style.display = 'none';
                premiumStatus.style.display = 'block';
                
                // 成功メッセージ表示
                setTimeout(() => {
                    location.reload(); // ページリロードで状態反映
                }, 2000);
            } else {
                alert('エラーが発生しました: ' + data.message);
                confirmAdBtn.disabled = false;
                confirmAdBtn.innerHTML = '広告視聴完了';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('通信エラーが発生しました');
            confirmAdBtn.disabled = false;
            confirmAdBtn.innerHTML = '広告視聴完了';
        });
    });
});
</script>