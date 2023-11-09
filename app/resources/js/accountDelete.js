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


//　ここから持ち物関係
// todoのボタンを取得
var belongingsBtn = document.querySelector('[name="belongings-register"]');

// addボタンの取得
var addButton  = document.querySelector('[name="add"]');
var deleteButton  = document.querySelector('[name="delete"]');
var belongingsContainer = document.getElementById('belongingsContainer');
var belonginsCnt = document.getElementById('belonginsCnt');

var num = 1; // 初期のnum値

// addボタンを押した時の操作
addButton.addEventListener('click', function() {
    console.log("addButton");
    // 新しい持ち物フィールドを作成
    var newBelongingsDiv = createTimeField(num + 1);
    belongingsContainer.appendChild(newBelongingsDiv);

    // numをインクリメント
    num++;

    belonginsCnt.innerText = num;
});

deleteButton.addEventListener('click', function() {
    console.log("deleteButton");
    if (num > 1) {
        // 最低1つの持ち物フィールドが必要なので1未満には減らさない
        num--;

        // 最後に追加した持ち物フィールドを削除
        var lastTimeDiv = belongingsContainer.lastElementChild;
        belongingsContainer.removeChild(lastTimeDiv);

        belonginsCnt.innerText = num;
    }
});

function createTimeField(num) {
    // 新しい持ち物フィールドを作成
    var newBelongingsDiv = document.createElement('div');
    newBelongingsDiv.className = 'baggage';

    // num属性を設定
    var numSpan = document.createElement('span');
    numSpan.setAttribute('name', 'num');
    numSpan.textContent = num + '： ';
    newBelongingsDiv.appendChild(numSpan);

    var input1 = document.createElement('input');
    input1.type = 'checkbox';
    input1.name = 'belongingsCheck' + '-' + num;
    // input1.style.width = '72px';

    var input2 = document.createElement('input');
    input2.type = 'text';
    input2.name = 'belongings' + '-' + num;
    input2.style.width = '70%';

    // 新しい要素を追加
    newBelongingsDiv.appendChild(input1);
    newBelongingsDiv.appendChild(document.createTextNode(' '));
    newBelongingsDiv.appendChild(input2);

    return newBelongingsDiv;
}

belongingsBtn.addEventListener('click', function() {
    // timesのgoing1要素を取得
    var belongings1 = document.querySelector('[name="belongings-1"]');
    if(belongings1.value === ''){
        // デフォルトのクリック動作をキャンセル
        event.preventDefault();
        alert("持っていくものを入力してください🙃");
        return;
    }
});