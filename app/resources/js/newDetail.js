import './bootstrap';

    // リンク要素を取得
    var expenseLink = document.querySelector('.expense');
    // expensesのdiv要素を取得
    var expensesDiv = document.querySelector('[name="expenses"]');
    // リンク要素を取得
    var todoLink = document.querySelector('.todo');
    // timesのdiv要素を取得
    var timesDiv = document.querySelector('[name="times"]');

    // addボタンの取得
    var addButton  = document.querySelector('[name="add"]');
    var deleteButton  = document.querySelector('[name="delete"]');
    var timeContainer = document.getElementById('timeContainer');

    var num = 1; // 初期のnum値
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

    // リンクがクリックされたときの処理
    todoLink.addEventListener('click', function(event) {
        // デフォルトのクリック動作をキャンセル
        event.preventDefault();
        // expensesのdiv要素の表示/非表示を切り替え
        if (timesDiv.style.display === 'none' || timesDiv.style.display === '') {
            timesDiv.style.display = 'block';
        } else {
            timesDiv.style.display = 'none';
        }
    });

    // addボタンを押した時の操作
    addButton.addEventListener('click', function() {
        // 新しい時間入力フィールドを作成
        var newTimeDiv = createTimeField(num + 1);
        timeContainer.appendChild(newTimeDiv);

        // numをインクリメント
        num++;
    });

    deleteButton.addEventListener('click', function() {
        if (num > 1) {
            // 最低1つの時間入力フィールドが必要なので1未満には減らさない
            num--;

            // 最後に追加した時間入力フィールドを削除
            var lastTimeDiv = timeContainer.lastElementChild;
            timeContainer.removeChild(lastTimeDiv);
        }
    });

    function createTimeField(num) {
        // 新しい時間入力フィールドを作成
        var newTimeDiv = document.createElement('div');
        newTimeDiv.className = 'time';

        // num属性を設定
        var numSpan = document.createElement('span');
        numSpan.setAttribute('name', 'num');
        numSpan.textContent = num + '： ';
        newTimeDiv.appendChild(numSpan);

        var input1 = document.createElement('input');
        input1.type = 'time';
        input1.name = 'time-from' + '-' + num;
        input1.style.width = '62px';

        var input2 = document.createElement('input');
        input2.type = 'time';
        input2.name = 'time-to' + '-' + num;
        input2.style.width = '62px';

        var input3 = document.createElement('input');
        input3.type = 'text';
        input3.name = 'going' + '-' + num;
        input3.size = 15;

        // 新しい要素を追加
        newTimeDiv.appendChild(input1);
        newTimeDiv.appendChild(document.createTextNode('～ '));
        newTimeDiv.appendChild(input2);
        newTimeDiv.appendChild(document.createTextNode('　　'));
        newTimeDiv.appendChild(input3);

        return newTimeDiv;
    }