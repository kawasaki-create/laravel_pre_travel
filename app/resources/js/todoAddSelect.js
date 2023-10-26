import './bootstrap';

    var selectBox = document.getElementById('selectBox');
    var inputContainer = document.getElementById('inputContainer');
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
            var timeFrom = document.createElement('input');
            var timeTo = document.createElement('input');
            var timeContent = document.createElement('input');
            var lineBreak = document.createElement('br');

            timeFrom.type = 'time';
            timeTo.type = 'time';
            timeContent.type = 'text';

            timeFrom.name = 'dynamicTimeFrom';
            timeTo.name = 'dynamicTimeTo';
            timeContent.name = 'dynamicTimeContent';

            inputContainer.appendChild(lineBreak);
            inputContainer.appendChild(timeFrom);
            inputContainer.appendChild(document.createTextNode(' 〜 '));
            inputContainer.appendChild(timeTo);
            inputContainer.appendChild(document.createTextNode('　'));
            inputContainer.appendChild(timeContent);
        }
    });