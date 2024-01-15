<?php
// Получение данных из AJAX-запроса
$data = json_decode(file_get_contents('php://input'), true);

// Проверка и сохранение данных в базу данных
if (!empty($data)) {
  $propertyTitle = $data['property_title'];
  $propertyDescription = $data['property_description'];
  $propertyArea = $data['property_area'];
  $propertyPrice = $data['property_price'];
  $selectedCity = $data['selected_city'];

  // Ваш код для сохранения объекта недвижимости в базу данных

  // Отправка ответа об успешном добавлении объекта недвижимости
  $response = array('success' => true);
  echo json_encode($response);
} else {
  // Отправка ответа об ошибке
  $response = array('success' => false);
  echo json_encode($response);
}
?>