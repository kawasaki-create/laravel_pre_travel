<!-- 広告ブロッカー検出モーダル -->
<div class="modal fade" id="adblockModal" tabindex="-1" aria-labelledby="adblockModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.2);">
            <div class="modal-header text-white border-0" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%); border-radius: 16px 16px 0 0;">
                <div class="d-flex align-items-center">
                    <svg width="32" height="32" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.314 18.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    <h4 class="modal-title fw-bold mb-0" id="adblockModalLabel">🛡️ 広告ブロッカーが検出されました</h4>
                </div>
                <!-- 閉じるボタンを削除（消せないモーダル） -->
            </div>
            
            <div class="modal-body p-5">
                <!-- お知らせメッセージ -->
                <div class="text-center mb-4">
                    <div class="mb-4">
                        <svg width="80" height="80" style="color: #ff6b6b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-3" style="color: #2c3e50;">広告ブロッカーを無効にしてください</h5>
                    <p class="text-muted mb-4">このWebサイトをご利用いただくには、広告ブロッカーを無効にする必要があります。</p>
                </div>

                <!-- 説明内容 -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="card h-100 border-0" style="background: linear-gradient(135deg, #f8f9fa 0%, #e3f2fd 100%);">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <svg width="48" height="48" style="color: #3498db;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                <h6 class="fw-bold mb-2">無料でご提供</h6>
                                <p class="small text-muted mb-0">
                                    このサイトは広告収入により、<br>
                                    <strong>完全無料</strong>で旅行計画サービスを<br>
                                    提供しています。
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card h-100 border-0" style="background: linear-gradient(135deg, #fff3e0 0%, #f8f9fa 100%);">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <svg width="48" height="48" style="color: #f39c12;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <h6 class="fw-bold mb-2">サービス継続のため</h6>
                                <p class="small text-muted mb-0">
                                    広告収入がサーバー運営費や<br>
                                    <strong>新機能開発</strong>の資金となり、<br>
                                    サービス継続を支えています。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 手順説明 -->
                <div class="card border-0 mb-4" style="background: linear-gradient(135deg, #e8f5e8 0%, #f8f9fa 100%);">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3 d-flex align-items-center">
                            <svg width="20" height="20" class="me-2" style="color: #27ae60;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            広告ブロッカーを無効にする方法
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="badge bg-primary rounded-circle mb-2" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">1</div>
                                    <p class="small mb-0">ブラウザの拡張機能アイコンをクリック</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="badge bg-primary rounded-circle mb-2" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">2</div>
                                    <p class="small mb-0">このサイトでの広告ブロックを無効化</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="badge bg-primary rounded-circle mb-2" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">3</div>
                                    <p class="small mb-0">ページをリロード</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 理解のお願い -->
                <div class="text-center">
                    <p class="text-muted small mb-3">
                        ご理解とご協力をお願いいたします。<br>
                        広告ブロッカーを無効にしていただくことで、引き続き無料でサービスをご利用いただけます。
                    </p>
                    
                    <!-- 再確認ボタン -->
                    <button type="button" class="btn btn-primary btn-lg px-4" onclick="checkAdBlockerStatus()" style="border-radius: 8px;">
                        <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        広告ブロッカーの設定を確認
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 検出用の見えない要素（bait） -->
<div class="adsbygoogle ads advertisement banner-ads google-ads" style="position: absolute; left: -999px; width: 1px; height: 1px; visibility: hidden;" id="adblock-bait"></div>

<style>
/* モーダルを最前面に表示 */
#adblockModal {
    z-index: 9999 !important;
}

/* モーダルのオーバーレイを完全に覆う */
#adblockModal .modal-backdrop {
    z-index: 9998 !important;
}

/* 検出用のbait要素を広告ブロッカーが確実に検出するようにする */
.ads, .advertisement, .banner-ads, .google-ads {
    position: absolute !important;
    left: -999px !important;
    width: 1px !important;
    height: 1px !important;
    visibility: hidden !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('広告ブロッカー検出システムを初期化しました');
    
    // デバッグ用関数
    function debugInfo() {
        console.log('デバッグ情報:', {
            '広告JSファイル読み込み': typeof window.adsLoaded !== 'undefined',
            'Bootstrap存在': typeof bootstrap !== 'undefined',
            'おとり要素存在': !!document.getElementById('adblock-bait'),
            'モーダル要素存在': !!document.getElementById('adblockModal'),
            'ユーザーエージェント': navigator.userAgent
        });
    }
    
    // より強力な広告ブロッカー検出
    function detectAdBlocker() {
        return new Promise((resolve) => {
            let detectionCount = 0;
            let totalTests = 0;
            
            // テスト1: bait要素の詳細検証
            const baitElement = document.getElementById('adblock-bait');
            totalTests++;
            if (baitElement) {
                const computedStyle = window.getComputedStyle(baitElement);
                const rect = baitElement.getBoundingClientRect();
                
                if (baitElement.offsetHeight === 0 || 
                    baitElement.offsetWidth === 0 ||
                    computedStyle.display === 'none' ||
                    computedStyle.visibility === 'hidden' ||
                    rect.height === 0 || 
                    rect.width === 0) {
                    detectionCount++;
                    console.log('広告ブロッカーを検出: おとり要素がブロックされています');
                }
            } else {
                detectionCount++; // 要素が削除された場合
                console.log('広告ブロッカーを検出: おとり要素が削除されています');
            }
            
            // テスト2: ads.jsファイルの読み込み確認（より確実）
            totalTests++;
            if (typeof window.adsLoaded === 'undefined') {
                detectionCount++;
                console.log('広告ブロッカーを検出: 広告JSファイルが読み込まれていません');
            }
            
            // テスト3: 複数の動的要素での検出
            totalTests++;
            const testElements = [
                { className: 'adsbox', id: 'ads-test-1' },
                { className: 'advertisement', id: 'ads-test-2' },
                { className: 'banner-ad', id: 'ads-test-3' },
                { className: 'google-ads', id: 'ads-test-4' }
            ];
            
            let dynamicTestsBlocked = 0;
            testElements.forEach(testConfig => {
                const testAd = document.createElement('div');
                testAd.innerHTML = '&nbsp;';
                testAd.className = testConfig.className;
                testAd.id = testConfig.id;
                testAd.style.cssText = 'position: absolute !important; left: -999px !important; width: 1px !important; height: 1px !important; display: block !important;';
                document.body.appendChild(testAd);
                
                setTimeout(() => {
                    const rect = testAd.getBoundingClientRect();
                    const computedStyle = window.getComputedStyle(testAd);
                    
                    if (testAd.offsetHeight === 0 || 
                        testAd.offsetWidth === 0 ||
                        computedStyle.display === 'none' ||
                        rect.height === 0 ||
                        rect.width === 0) {
                        dynamicTestsBlocked++;
                    }
                    
                    document.body.removeChild(testAd);
                }, 50);
            });
            
            // 最終判定を遅延実行
            setTimeout(() => {
                if (dynamicTestsBlocked >= 2) { // 半分以上ブロックされた場合
                    detectionCount++;
                    console.log('広告ブロッカーを検出: 動的要素がブロックされています');
                }
                
                // より厳密な判定: 3つのうち2つ以上で検出された場合
                const isBlocked = detectionCount >= 2;
                console.log(`広告ブロッカー検出結果: ${isBlocked ? '検出されました' : '検出されませんでした'} (${detectionCount}/${totalTests} 個のテストで検出)`);
                resolve(isBlocked);
            }, 200);
        });
    }
    
    // モーダル表示関数（エラーハンドリング強化）
    function showAdBlockModal() {
        console.log('広告ブロッカーモーダルを表示しようとしています');
        const modalElement = document.getElementById('adblockModal');
        
        if (!modalElement) {
            console.error('モーダル要素が見つかりません');
            return;
        }
        
        if (typeof bootstrap === 'undefined') {
            console.error('Bootstrapが読み込まれていません、代替方法を使用します');
            // CSS fallback
            modalElement.style.display = 'block';
            modalElement.classList.add('show');
            document.body.classList.add('modal-open');
            
            // 背景オーバーレイを作成
            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop fade show';
            backdrop.style.zIndex = '9998';
            document.body.appendChild(backdrop);
            return;
        }
        
        try {
            const modal = new bootstrap.Modal(modalElement, {
                backdrop: 'static',
                keyboard: false
            });
            modal.show();
            console.log('モーダルを正常に表示しました');
        } catch (error) {
            console.error('モーダル表示でエラーが発生しました:', error);
            // Fallback
            modalElement.style.display = 'block';
            modalElement.classList.add('show');
        }
    }
    
    // モーダル非表示関数
    function hideAdBlockModal() {
        const modalElement = document.getElementById('adblockModal');
        const modal = bootstrap.Modal.getInstance(modalElement);
        
        if (modal) {
            modal.hide();
        } else {
            // CSS fallback
            modalElement.style.display = 'none';
            modalElement.classList.remove('show');
            document.body.classList.remove('modal-open');
            
            // 背景オーバーレイを削除
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
        }
        console.log('モーダルを非表示にしました');
    }
    
    // 広告ブロッカー状態確認とモーダル制御
    function checkAdBlockerStatus() {
        console.log('広告ブロッカーの状態をチェック中...');
        debugInfo();
        
        detectAdBlocker().then(isBlocked => {
            console.log('広告ブロッカー検出が完了しました:', isBlocked ? '有効' : '無効');
            
            if (isBlocked) {
                showAdBlockModal();
            } else {
                hideAdBlockModal();
            }
        }).catch(error => {
            console.error('広告ブロッカー検出でエラーが発生しました:', error);
        });
    }
    
    // グローバル関数として定義
    window.checkAdBlockerStatus = checkAdBlockerStatus;
    window.debugAdBlock = debugInfo;
    
    // 初期検出（Bootstrap読み込み後に実行）
    function initializeDetection() {
        if (typeof bootstrap !== 'undefined') {
            console.log('Bootstrapが読み込まれました、検出を開始します');
            setTimeout(checkAdBlockerStatus, 1000);
            
            // 定期的に検出（10秒間隔）
            setInterval(checkAdBlockerStatus, 10000);
        } else {
            console.log('Bootstrapの準備ができていません、再試行します...');
            setTimeout(initializeDetection, 500);
        }
    }
    
    // 検出開始
    setTimeout(initializeDetection, 1000);
    
    // 強制テスト用（開発時）
    window.forceShowAdBlockModal = showAdBlockModal;
});
</script>