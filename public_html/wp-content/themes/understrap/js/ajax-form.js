    document.addEventListener('DOMContentLoaded', function() {
  var form = document.getElementById('add-property-form');
  var citySelect = document.getElementById('property-city');

  // Загрузка данных о городах при загрузке страницы
  loadCities();

  // Обработчик отправки формы
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    var propertyTitle = document.getElementById('property-title').value;
    var propertyDescription = document.getElementById('property-description').value;
    var propertyArea = document.getElementById('property-area').value;
    var propertyPrice = document.getElementById('property-price').value;
    var selectedCity = citySelect.value;

    // Создание объекта данных для отправки на сервер
    var data = {
      property_title: propertyTitle,
      property_description: propertyDescription,
      property_area: propertyArea,
      property_price: propertyPrice,
      selected_city: selectedCity
    };

    // Отправка AJAX-запроса на сервер
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'обработчик.php');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          // Обработка успешного добавления объекта недвижимости
          alert('Объект недвижимости успешно добавлен!');
          form.reset();
        } else {
          // Обработка ошибки при добавлении объекта недвижимости
          alert('Ошибка при добавлении объекта недвижимости.');
        }
      } else {
        // Обработка ошибки AJAX-запроса
        alert('Ошибка при выполнении AJAX-запроса.');
      }
    };
    xhr.send(JSON.stringify(data));
  });

  // Функция для загрузки данных о городах с сервера
  function loadCities() {
	  // Функция для загрузки данных о городах с сервера
function loadCities() {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'города.php');
  xhr.onload = function() {
    if (xhr.status === 200) {
      var cities = JSON.parse(xhr.responseText);
      cities.forEach(function(city) {
        var option = document.createElement('option');
        option.value = city.id;
        option.textContent = city.name;
        citySelect.appendChild(option);
      });
    } else {
      alert('Ошибка при загрузке данных о городах.');
    }
  };
  xhr.send();
}

// Вызов функции загрузки данных о городах при загрузке страницы
loadCities();
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'города.php');
    xhr.onload = function() {
      if (xhr.status === 200) {
        var cities = JSON.parse(xhr.responseText);
        cities.forEach(function(city) {
          var option = document.createElement('option');
          option.value = city.id;
          option.textContent = city.name;
          citySelect.appendChild(option);
        });
      } else {
        alert('Ошибка при загрузке данных о городах.');
      }
    };
    xhr.send();
  }
});