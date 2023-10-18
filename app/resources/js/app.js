import './bootstrap';

// textarea要素と文字数表示用の要素を取得します
var textarea = document.getElementById('myTextarea');
var charCount = document.getElementById('charCount');
var deleteButton = document.getElementById('tweetDeleteButton');
var tweetButton = document.getElementById('tweetButton');
var planDeleteButton = document.getElementById('planDeleteButton');

var txtLength = 0;

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

document.addEventListener('DOMContentLoaded', function() {
    deleteButton.addEventListener('click', deleteSelected);
    tweetButton.addEventListener('click', tweetValid);
    planDeleteButton.addEventListener('click', planDeleteValid);

    function deleteSelected() {
        // 選択されたチェックボックスの数を取得
        var selectedCount = document.querySelectorAll('input[type="checkbox"]:checked').length;
        // チェックボックスが選択されていない場合はポップアップを表示
        if (selectedCount === 0) {
            event.preventDefault(); // フォームの送信をキャンセル
            alert("削除対象が選択されていません🙃");
        } else {
            // 削除処理を実行する場合の処理を記述
            if(!confirm("選択したつぶやきを削除しますがよろしいですか？(この動作はもどせません)")){
                event.preventDefault(); // フォームの送信をキャンセル
            }
        }
    }

    function tweetValid(){
        if(txtLength === 0){
            event.preventDefault(); // フォームの送信をキャンセル
            alert("何も入力されていません🙃");
        }
    }

    function planDeleteValid(){
        if(!confirm("旅行を削除しますか？(この動作はもどせません)")){
            event.preventDefault(); // フォームの送信をキャンセル
        }
    }
});
