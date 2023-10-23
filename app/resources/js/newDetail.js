import './bootstrap';

    // リンク要素を取得
    var expenseLink = document.querySelector('.expense');
    // expensesのdiv要素を取得
    var expensesDiv = document.querySelector('[name="expenses"]');

    // addボタンの取得
    var addBtn = document.querySelector('[name="add"]');

    var btnCnt = 0;
    // リンクがクリックされたときの処理
    expenseLink.addEventListener('click', function(event) {
        // デフォルトのクリック動作をキャンセル
        event.preventDefault();
        // expensesのdiv要素の表示/非表示を切り替え
        if (expensesDiv.style.display === 'none' || expensesDiv.style.display === '') {
            expensesDiv.style.display = 'block';
        } else {
            expensesDiv.style.display = 'none';
        }
    });

    // addボタンを押した時の操作
    addBtn.addEventListener('click', function(event) {
        // デフォルトのクリック動作をキャンセル
        event.preventDefault();
        btnCnt ++;
    });
