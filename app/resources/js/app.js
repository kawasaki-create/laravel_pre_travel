import './bootstrap';

// textarea要素と文字数表示用の要素を取得します
var textarea = document.getElementById('myTextarea');
var myTweetEdit = document.getElementById('myTweetEdit');
var charCount = document.getElementById('charCount');
var deleteButton = document.getElementById('tweetDeleteButton');
var tweetButton = document.getElementById('tweetButton');
var planDeleteButton = document.getElementById('planDeleteButton');
var editButtons = document.getElementsByClassName('editButton');

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

myTweetEdit.addEventListener('input', function() {
    // 入力された文字数を取得します
    var currentLength = myTweetEdit.value.length;
    txtLength = currentLength;

  // 最大文字数を取得します
  var maxLength = parseInt(myTweetEdit.getAttribute('maxlength'));

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

// NodeList の各要素に対してイベントリスナーを設定
Array.from(editButtons).forEach(function(button) {
    button.addEventListener('click', function(e) {
        e.preventDefault(); // ページのリロードを防ぐ
        var clickedButton = e.target;
        showPopup(clickedButton); // ボタンがクリックされたときに showPopup 関数を呼び出す
    });
});

const modal = document.getElementById('easyModal');
const buttonClose = document.getElementsByClassName('modalClose')[0];

// ポップアップを表示する関数を定義します
function showPopup(button) {
    // ポップアップの内容やスタイルを設定します
    modal.style.display = 'block';
    var tweetId = button.getAttribute('data-tweet-id');
    var tweetIdSpan = modal.querySelector('.tweet-id'); // モーダル内の適切な場所を指定
    // モーダル内の特定の場所にtweetIdを表示する
    tweetIdSpan.textContent = tweetId;

     // 保存ボタンのリンクに tweetId を追加する
    var saveButton = modal.querySelector('.editSaveBtn');
    // 保存ボタンをクリックしたときの処理
    console.log("到達している");
    console.log(saveButton);

    saveButton.addEventListener('mouseover', function() {
        console.log("クリックした");
        var tweetContent = document.getElementById('myTweetEdit').value;
        var tweetId = button.getAttribute('data-tweet-id');
        window.location.href = "/home/editedtweet/register/" + tweetId + "?tweetContent=" + decodeURIComponent(tweetContent);
    });
}

// バツ印がクリックされた時
buttonClose.addEventListener('click', modalClose);
function modalClose() {
    modal.style.display = 'none';
}

// モーダルコンテンツ以外がクリックされた時
addEventListener('click', outsideClose);
function outsideClose(e) {
    if (e.target == modal) {
        modal.style.display = 'none';
    }
}