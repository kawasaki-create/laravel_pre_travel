import './bootstrap';

var registerButton = document.getElementById('plan-register');
console.log('miomimi');
registerButton.addEventListener('click', function() {
    var contents1  = document.querySelector('[name="contents1"]');
    var contents2  = document.querySelector('[name="contents2"]');
    var contents3  = document.querySelector('[name="contents3"]');
    var contents4  = document.querySelector('[name="contents4"]');
    var contents5  = document.querySelector('[name="contents5"]');
    var contents6  = document.querySelector('[name="contents6"]');
    var contents7  = document.querySelector('[name="contents7"]');
    var contents8  = document.querySelector('[name="contents8"]');
    var contents10 = document.querySelector('[name="contents10"]');
    if(contents1.value === '' && contents2.value === '' && contents3.value === '' && contents4.value === '' && contents5.value === '' && contents6.value === '' && contents7.value === '' && contents8.value === '' && contents10.value === ''){
        // デフォルトのクリック動作をキャンセル
        event.preventDefault();
        alert("何も入力されていません🙃");
        return;
    }
});