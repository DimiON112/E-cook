<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = ""; // Пароль по умолчанию пустой
$dbname = "login_db";

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Запрос к базе данных
$result = $conn->query("SELECT * FROM recepe");

// Сохранение данных в массив
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row["title"];
}

// Закрытие соединения
$conn->close();

// Возвращаем данные в формате JSON
echo json_encode($data);
?>
