import './bootstrap';

// textarea要素と文字数表示用の要素を取得します
var deleteButton = document.getElementById('tweetDeleteButton');

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
            if(!confirm("選択したつぶやきを削除しますがよろしいですか？(この動作はもどせません)")){
                event.preventDefault(); // フォームの送信をキャンセル
            }
        }
    }
});