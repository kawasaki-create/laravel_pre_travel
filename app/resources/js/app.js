import './bootstrap';

// textarea要素と文字数表示用の要素を取得します
var textarea = document.getElementById('myTextarea');
var charCount = document.getElementById('charCount');

// textareaの入力内容が変更されたときのイベントを設定します
textarea.addEventListener('input', function() {
  // 入力された文字数を取得します
  var currentLength = textarea.value.length;
  
  // 最大文字数を取得します
  var maxLength = parseInt(textarea.getAttribute('maxlength'));
  
  // 文字数表示用のテキストを更新します
  charCount.textContent = currentLength + '/' + maxLength;
});