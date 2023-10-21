import './bootstrap';

    var dateElements = document.querySelectorAll('.date');

    dateElements.forEach(function(dateElement, index) {
        dateElement.addEventListener('click', function(event) {
            event.preventDefault(); // リンクのクリックイベントを無効化
            var expenseTable = document.querySelectorAll('[name="expense"]')[index];
            var todoTable = document.querySelectorAll('[name="todo"]')[index];
            var newEditButton = document.querySelectorAll('[name="newEdit"]')[index];
            var clickInline = document.querySelectorAll('[name="clickInline"]')[index];
            var dateText = document.getElementById('dateText' + [index]);

            // テーブルの表示状態を切り替える
            
            var clickedDate = dateElement.textContent;
            if (expenseTable.style.display === 'none' || expenseTable.style.display === '') {
                expenseTable.style.display = 'table';
                todoTable.style.display = 'table';
                newEditButton.style.display = '';
                clickInline.style.display = '';
                dateText.innerText = "(クリックで閉じる)"
            } else {
                expenseTable.style.display = 'none';
                todoTable.style.display = 'none';
                newEditButton.style.display = 'none';
                clickInline.style.display = 'none';
                dateText.innerText = "(クリックで表示)"
            }
        });
    });