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

// Получение данных из формы
$recipeName = $_POST['recipeName'];
$description = $_POST['description'];
$time = $_POST['time'];
$image_url = $_POST['image_url'];

$sql = "INSERT INTO recepe (title, description, admin_id, time, image_url) 
        VALUES ('$recipeName', '$description', 1, '$time', '$image_url')";

if ($conn->query($sql) === TRUE) {
    echo "Recipe saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Закрытие подключения к базе данных
$conn->close();
?>
