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