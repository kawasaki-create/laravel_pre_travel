import './bootstrap';

var registerButton = document.querySelector('[name="plan-register"]');
var tripTitle = document.querySelector('[name="trip-title"]');
var tripStart = document.querySelector('[name="trip-start"]');
var tripEnd = document.querySelector('[name="trip-end"]');
registerButton.addEventListener('click', function(event) {
    if (tripTitle.value.trim() === '') {
        event.preventDefault();
        alert('旅行名は必須入力です🥲');
        return;
    }
    if (tripStart.value === '' || tripEnd.value === '') {
        event.preventDefault();
        alert('旅行の日程は必須入力です🥲');
        return;
    }
    if (new Date(tripStart.value) > new Date(tripEnd.value)) {
        event.preventDefault();
        alert('日程が不正です🥲');
        return;
    }
});