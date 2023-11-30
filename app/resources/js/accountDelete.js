import './bootstrap';


// 動的に画面サイズ変更した際にサイドバーを非表示にする
function checkWidth() {
    var windowWidth = window.innerWidth;
    var sidebar = document.querySelector('.col-md-4');
    var hamburger = document.querySelector('.hamnav');

    if (windowWidth <= 800) {
        sidebar.classList.add('hide-on-small-screen');
        hamburger.classList.remove('hide-on-small-screen');
    } else {
        sidebar.classList.remove('hide-on-small-screen');
        hamburger.classList.add('hide-on-small-screen');
    }
}

window.addEventListener('resize', function() {
    checkWidth();
});

// ページ読み込み時にもチェック
window.addEventListener('load', function() {
    checkWidth();
});

var accountDeleteButton = document.getElementById('accountDelete');
var accountDeleteSideBarButton = document.getElementById('accountDeleteSideBar');
accountDeleteButton.addEventListener('click', function() {
    if(!confirm("アカウントを削除しますか？(これまでのつぶやき、旅行プランなどが全て削除されます。)")){
        event.preventDefault(); // フォームの送信をキャンセル
    }
});
accountDeleteSideBarButton.addEventListener('click', function() {
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
