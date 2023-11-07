import './bootstrap';

var accountDeleteButton = document.getElementById('accountDelete');
accountDeleteButton.addEventListener('click', function() {
    if(!confirm("アカウントを削除しますか？(これまでのつぶやき、旅行プランなどが全て削除されます。)")){
        event.preventDefault(); // フォームの送信をキャンセル
    }
});


var txtLength = 0;
var charCount = document.getElementById('charCount');
var textarea = document.getElementById('myTextarea');
// textareaの入力内容が変更されたときのイベントを設定します
textarea.addEventListener('input', function() {
    // 入力された文字数を取得します
    var currentLength = textarea.value.length;
    txtLength = currentLength;

    // 最大文字数を取得します
    var maxLength = parseInt(textarea.getAttribute('maxlength'));

  // 文字数表示用のテキストを更新します
    charCount.textContent = currentLength + '/' + maxLength;
});

var tweetButton = document.getElementById('tweetButton');
tweetButton.addEventListener('click', function() {
    if(txtLength === 0){
        event.preventDefault(); // フォームの送信をキャンセル
        alert("何も入力されていません🙃");
    }
});