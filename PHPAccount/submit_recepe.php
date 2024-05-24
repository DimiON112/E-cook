<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Submit Recipe</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>

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
$recipeName = $conn->real_escape_string($_POST['recipeName']);
$description = $conn->real_escape_string($_POST['description']);
$time = $conn->real_escape_string($_POST['time']);
$image_url = $conn->real_escape_string($_POST['image_url']);
$admin_id = 27; // Используйте действительный admin_id из вашей таблицы

// Проверьте, существует ли admin_id
$admin_check_query = "SELECT id FROM admin WHERE id = '$admin_id'";
$admin_check_result = $conn->query($admin_check_query);

if ($admin_check_result->num_rows > 0) {
    // Вставка рецепта
    $sql = "INSERT INTO recepe (title, description, admin_id, time, image_url) 
            VALUES ('$recipeName', '$description', '$admin_id', '$time', '$image_url')";

    if ($conn->query($sql) === TRUE) {
        // Получить последний вставленный ID рецепта
        $recepe_id = $conn->insert_id;

        // Вставка ингредиентов
        $ingredients = $_POST['ingredient'];
        foreach ($ingredients as $ingredient) {
            $ingredient = $conn->real_escape_string($ingredient); // Защита от SQL-инъекций
            $sql = "INSERT INTO item (name, recepe_id) VALUES ('$ingredient', '$recepe_id')";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Перенаправление на страницу рецепта
        header("Location: recipePage.php?id=$recepe_id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: Invalid admin_id";
}

// Закрытие подключения к базе данных
$conn->close();
?>

</body>
</html>
