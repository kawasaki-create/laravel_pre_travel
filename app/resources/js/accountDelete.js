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

document.addEventListener("DOMContentLoaded", function() {
    // チェックボックスの変更を監視
    var checkboxes = document.querySelectorAll('.checkbox');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // 関連する要素の背景色を変更
            var id = this.getAttribute('data-id');
            var belongingItem = document.querySelector('.belonging-item[data-id="' + id + '"]');
            if (this.checked) {
                belongingItem.style.backgroundColor = 'silver';
            } else {
                belongingItem.style.backgroundColor = '';
            }

            // チェックの状態をローカルストレージに保存
            localStorage.setItem('checkbox_' + id, this.checked);
        });
    });

    // テキストをクリックしてもチェックボックスの状態を切り替え
    var belongingItems = document.querySelectorAll('.belonging-item');
    belongingItems.forEach(function(item) {
        item.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var checkbox = document.querySelector('.checkbox[data-id="' + id + '"]');

            // チェックボックスの状態を切り替え
            checkbox.checked = !checkbox.checked;

            // 関連する要素の背景色を変更
            if (checkbox.checked) {
                this.style.backgroundColor = 'silver';
            } else {
                this.style.backgroundColor = '';
            }

            // チェックの状態をローカルストレージに保存
            localStorage.setItem('checkbox_' + id, checkbox.checked);
        });
    });

    // ページ読み込み時に保存された状態を復元
    checkboxes.forEach(function(checkbox) {
        var id = checkbox.getAttribute('data-id');
        var belongingItem = document.querySelector('.belonging-item[data-id="' + id + '"]');
        var checked = localStorage.getItem('checkbox_' + id) === 'true';

        checkbox.checked = checked;
        if (checked) {
            belongingItem.style.backgroundColor = 'silver';
        } else {
            belongingItem.style.backgroundColor = '';
        }
    });
});
