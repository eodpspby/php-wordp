// Получение формы и элементов формы
var form = document.getElementById('add-property-form');
var propertyTitleInput = document.getElementById('property-title');
var citySelect = document.getElementById('selected_city');

// Обработчик отправки формы
form.addEventListener('submit', function(e) {
    e.preventDefault();

    // Получение значений полей формы
    var propertyTitle = propertyTitleInput.value;
    var cityId = citySelect.value;

    // Создание объекта данных для отправки на сервер
    var data = {
        property_title: propertyTitle,
        city_id: cityId
    };

    // Отправка AJAX-запроса на сервер
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'url_для_обработчика_сервера');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Обработка успешного добавления элемента
            } else {
                // Обработка ошибки при добавлении элемента
            }
        } else {
            // Обработка ошибки AJAX-запроса
        }
    };
    xhr.send(JSON.stringify(data));
});