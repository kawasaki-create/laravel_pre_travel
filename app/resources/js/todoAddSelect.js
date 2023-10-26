import './bootstrap';

var selectBox = document.getElementById('selectBox');
var inputContainer = document.getElementById('inputContainer');
var lineBreak = document.createElement('br');
var timeCnt = document.getElementById('timeCnt').value; // timeCntの値を取得

// セレクトボックスの変更時に呼ばれる関数
function updateInputNames() {
    // 現在の選択値を取得
    var selectedValue = selectBox.value;

    // inputContainer内の要素を一旦クリア
    inputContainer.innerHTML = '';

    // 選択値が1から8, 10の場合はinput要素を追加
    if (selectedValue >= 1 && selectedValue <= 8 || selectedValue == 10) {
        var inputElement = document.createElement('input');
        var inputPrice = document.createElement('input');
        inputElement.type = 'text';
        inputPrice.type = 'number';

        // クラスを追加する
        inputElement.classList.add('expense-text2');
        inputPrice.classList.add('expense-number');

        // 名前属性に選択値を含めて設定
        inputElement.name = 'contents' + selectedValue;
        inputPrice.name = 'price' + selectedValue;

        inputElement.placeholder = '内容を入力';
        inputPrice.placeholder = '740';
        inputContainer.appendChild(lineBreak);
        inputContainer.appendChild(inputElement);
        inputContainer.appendChild(document.createTextNode('　¥'));
        inputContainer.appendChild(inputPrice);
    }
    // 選択値が9の場合はtextarea要素を追加
    else if (selectedValue == 9) {
        for (var i = 1; i <= timeCnt; i++) {
            var timeFrom = document.createElement('input');
            var timeTo = document.createElement('input');
            var timeContent = document.createElement('input');
    
            timeFrom.type = 'time';
            timeTo.type = 'time';
            timeContent.type = 'text';
    
            // クラスを追加する
            timeFrom.classList.add('time-c');
            timeTo.classList.add('time-c');
            timeContent.classList.add('content-c');
    
            timeFrom.name = 'time-from-' + i; // ダイナミックな名前を設定
            timeTo.name = 'time-to-' + i; // ダイナミックな名前を設定
            timeContent.name = 'going-' + i; // ダイナミックな名前を設定
    
            timeContent.placeholder = 'どこに行く？🤔';
    
            inputContainer.appendChild(lineBreak);
            inputContainer.appendChild(timeFrom);
            inputContainer.appendChild(document.createTextNode(' 〜 '));
            inputContainer.appendChild(timeTo);
            inputContainer.appendChild(document.createTextNode('　'));
            inputContainer.appendChild(timeContent);
        }
    }
}

// セレクトボックスの変更時にupdateInputNames関数を呼ぶ
selectBox.addEventListener('change', updateInputNames);

// 初期化時にも呼び出すことで、ページ読み込み時にも選択値に応じたinput要素を表示できます
updateInputNames();

// textarea要素と文字数表示用の要素を取得します
var deleteButton = document.getElementById('detail-delete');

document.addEventListener('DOMContentLoaded', function() {
    deleteButton.addEventListener('click', deleteSelected);
    function deleteSelected() {
        // 選択されたチェックボックスの数を取得
        var selectedCount = document.querySelectorAll('input[type="checkbox"]:checked').length;
        // チェックボックスが選択されていない場合はポップアップを表示
        if (selectedCount === 0) {
            event.preventDefault(); // フォームの送信をキャンセル
            alert("削除対象が選択されていません🙃");
        } else {
            // 削除処理を実行する場合の処理を記述
            if(!confirm("選択した予定を削除しますがよろしいですか？(この動作はもどせません)")){
                event.preventDefault(); // フォームの送信をキャンセル
            }
        }
    }
});