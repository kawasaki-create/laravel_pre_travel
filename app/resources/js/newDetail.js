import './bootstrap';

    // リンク要素を取得
    var expenseLink = document.querySelector('.expense');
    // expensesのdiv要素を取得
    var expensesDiv = document.querySelector('[name="expenses"]');
    // リンク要素を取得
    var todoLink = document.querySelector('.todo');
    // timesのdiv要素を取得
    var timesDiv = document.querySelector('[name="times"]');

    // todoのボタンを取得
    var todoBtn = document.querySelector('[name="todo-register"]');



    // addボタンの取得
    var addButton  = document.querySelector('[name="add"]');
    var deleteButton  = document.querySelector('[name="delete"]');
    var timeContainer = document.getElementById('timeContainer');

    var timeCnt = document.getElementById('timeCnt');

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
        timesDiv.style.display = 'none';
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
        expensesDiv.style.display = 'none';
    });

    // addボタンを押した時の操作
    addButton.addEventListener('click', function() {
        // 新しい時間入力フィールドを作成
        var newTimeDiv = createTimeField(num + 1);
        timeContainer.appendChild(newTimeDiv);

        // numをインクリメント
        num++;

        timeCnt.innerText = num;
    });

    deleteButton.addEventListener('click', function() {
        if (num > 1) {
            // 最低1つの時間入力フィールドが必要なので1未満には減らさない
            num--;

            // 最後に追加した時間入力フィールドを削除
            var lastTimeDiv = timeContainer.lastElementChild;
            timeContainer.removeChild(lastTimeDiv);

            timeCnt.innerText = num;
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
        input1.style.width = '72px';

        var input2 = document.createElement('input');
        input2.type = 'time';
        input2.name = 'time-to' + '-' + num;
        input2.style.width = '72px';

        var input3 = document.createElement('input');
        input3.type = 'text';
        input3.name = 'going' + '-' + num;
        input3.style.width = '35%';

        // 新しい要素を追加
        newTimeDiv.appendChild(input1);
        newTimeDiv.appendChild(document.createTextNode('～ '));
        newTimeDiv.appendChild(input2);
        newTimeDiv.appendChild(document.createTextNode('　'));
        newTimeDiv.appendChild(input3);


        return newTimeDiv;
    }

    todoBtn.addEventListener('click', function() {
        // timesのfrom1要素を取得
        var timeFrom1 = document.querySelector('[name="time-from-1"]');
        // timesのto1要素を取得
        var timeTo1 = document.querySelector('[name="time-to-1"]');
        // timesのgoing1要素を取得
        var going1 = document.querySelector('[name="going-1"]');
        var fromVal = timeFrom1.value;
        var toVal = timeTo1.value;
        if(fromVal === '' || toVal === ''){
            // デフォルトのクリック動作をキャンセル
            event.preventDefault();
            alert("時間を入力してください🙃");
            return;
        }
        if(fromVal > toVal){
            // デフォルトのクリック動作をキャンセル
            event.preventDefault();
            alert("時間が不正です🙃");
            return;
        }
        if(going1.value === ''){
            // デフォルトのクリック動作をキャンセル
            event.preventDefault();
            alert("予定を入力してください🙃");
            return;
        }
    });

    var selectBox = document.getElementById('selectBox');
    var inputContainer = document.getElementById('inputContainer');
    document.addEventListener('DOMContentLoaded', function() {
        console.log('読み込んでる');
    });
    console.log('読み込んでmas');
    selectBox.addEventListener('change', function() {
        // 現在の選択値を取得
        var selectedValue = selectBox.value;

        // inputContainer内の要素を一旦クリア
        inputContainer.innerHTML = '';

        // 選択値が1から8, 10の場合はinput要素を追加
        if (selectedValue >= 1 && selectedValue <= 8 || selectedValue == 10) {
            var inputElement = document.createElement('input');
            inputElement.type = 'text';
            inputElement.name = 'dynamicInput';
            inputElement.placeholder = 'Enter text...';
            inputContainer.appendChild(inputElement);
        }
        // 選択値が9の場合はtextarea要素を追加
        else if (selectedValue == 9) {
            var textareaElement = document.createElement('textarea');
            textareaElement.name = 'dynamicTextarea';
            textareaElement.placeholder = 'Enter text...';
            inputContainer.appendChild(textareaElement);
        }
    });
