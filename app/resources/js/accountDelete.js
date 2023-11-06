import './bootstrap';

var accountDeleteButton = document.getElementById('accountDelete');
accountDeleteButton.addEventListener('click', function() {
    if(!confirm("アカウントを削除しますか？(これまでのつぶやき、旅行プランなどが全て削除されます。)")){
        event.preventDefault(); // フォームの送信をキャンセル
    }
});