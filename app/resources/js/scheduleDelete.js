import './bootstrap';

// プラン削除ボタンの設定
var planDeleteButton = document.getElementById('planDeleteButton');

document.addEventListener('DOMContentLoaded', function() {
    planDeleteButton.addEventListener('click', planDeleteValid);

    function planDeleteValid(){
        if(!confirm("旅行を削除しますか？(この動作はもどせません)")){
            event.preventDefault(); // フォームの送信をキャンセル
        }
    }
});


