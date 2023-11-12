import './bootstrap';

    var dateElements = document.querySelectorAll('.date');

    dateElements.forEach(function(dateElement, index) {
        dateElement.addEventListener('click', function(event) {
            event.preventDefault(); // リンクのクリックイベントを無効化
            var expenseTable = document.querySelectorAll('[name="expense"]')[index];
            var todoTable = document.querySelectorAll('[name="todo"]')[index];
            var tweetTable = document.querySelectorAll('[name="tweet"]')[index];
            var newDetailButton = document.querySelectorAll('[name="newDetail"]')[index];
            var editDetailButton = document.querySelectorAll('[name="editDetail"]')[index];
            var belongingsDetailButton = document.querySelectorAll('[name="belongingsDetail"]')[index];
            var clickInline = document.querySelectorAll('[name="clickInline"]')[index];
            var dateText = document.getElementById('dateText' + [index]);

            // テーブルの表示状態を切り替える

            var clickedDate = dateElement.textContent;
            if (expenseTable.style.display === 'none' || expenseTable.style.display === '') {
                expenseTable.style.display = 'table';
                todoTable.style.display = 'table';
                tweetTable.style.display = 'table';
                newDetailButton.style.display = 'inline';
                editDetailButton.style.display = 'inline';
                belongingsDetailButton.style.display = 'inline';
                clickInline.style.display = '';
                dateText.innerText = "(クリックで閉じる)"
            } else {
                expenseTable.style.display = 'none';
                todoTable.style.display = 'none';
                tweetTable.style.display = 'none';
                newDetailButton.style.display = 'none';
                editDetailButton.style.display = 'none';
                belongingsDetailButton.style.display = 'none';
                clickInline.style.display = 'none';
                dateText.innerText = "(クリックで表示)"
            }
        });
    });