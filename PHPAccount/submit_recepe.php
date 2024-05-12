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
<<<<<<< HEAD
=======

    echo '<li><a href="/PHPAccount/" class="navbar-link title-small has-state active">Home</a></li>';

>>>>>>> be886ef96f758097380350ca20567d27717a430b
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

//добавление ингридиета 
$ingredients = $_POST['ingredient'];

// Подготовка и выполнение SQL-запроса для вставки каждого ингредиента в базу данных
foreach ($ingredients as $ingredient) {
    $ingredient = $conn->real_escape_string($ingredient); // Защита от SQL-инъекций
    $sql = "INSERT INTO item (name, recepe_id) VALUES ('$ingredient', (select max(id) from recepe))";
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Закрытие подключения к базе данных
$conn->close();
?>
