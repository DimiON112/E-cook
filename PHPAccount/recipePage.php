<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>E-cook - Cooking made easy.</title>
  <meta name="title" content="E-cook - Cooking made easy.">
  <meta name="description" content="This is a recipe application made by codewithsadee">

  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
  <script src="./assets/js/theme.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&family=DM+Serif+Display&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0..1,0" />
  <link rel="stylesheet" href="./assets/css/style.css">
  <script src="./assets/js/global.js" type="module"></script>
  <script src="./assets/js/home.js" type="module"></script>
</head>

<body>
<?php
function isActive($page) {
    return basename($_SERVER['PHP_SELF']) == $page ? 'active' : '';
}
?>

<header class="header" data-header>
    <a href="/" class="logo">
      <img src="./assets/images/logo-light.svg" width="156" height="32" alt="E-cook" class="logo-light">
      <img src="./assets/images/logo-dark.svg" width="156" height="32" alt="E-cook" class="logo-dark">
    </a>
    <nav class="navbar">
      <ul class="navbar-list">
        <li><a href="./index.html" class="navbar-link title-small has-state <?php echo isActive('index.php'); ?>">Home</a></li>
        <li><a href="./recipes.html" class="navbar-link title-small has-state <?php echo isActive('recipes.html'); ?>">Recipes</a></li>
        <li><a href="./customPrzepisy.html" class="navbar-link title-small has-state <?php echo isActive('customPrzepisy.html'); ?>">Custom</a></li>
        <li><a href="./addNew.html" class="navbar-link title-small has-state <?php echo isActive('addNew.html'); ?>">Add new</a></li>
        <li><a href="./recipePage.php" class="navbar-link title-small has-state <?php echo isActive('recipePage.php'); ?>">My Recipes</a></li>
      </ul>
    </nav>
    <button class="icon-btn theme-switch has-state" aria-pressed="false" aria-label="Toggle light and dark theme" data-theme-btn>
      <span class="material-symbols-outlined light-icon" aria-hidden="true">light_mode</span>
      <span class="material-symbols-outlined dark-icon" aria-hidden="true">dark_mode</span>
    </button>
    <a href="./saved-recipes.html" class="btn btn-primary has-icon">
      <span class="material-symbols-outlined" aria-hidden="true">book</span>
      <span class="span">Saved Recipes</span>
    </a>
</header>

<div class="container">
  <h1 class="recipe-title"></h1>
  <div class="recipes">
    <?php
    // Подключение к базе данных
    $servername = "localhost";
    $username = "root";
    $password = ""; // Пароль по умолчанию пустой
    $dbname = "login_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Получение ID рецепта из параметров запроса
    $recipeId = $_GET['id'];

    // Запрос данных о рецепте из базы данных
    $sql = "SELECT * FROM recepe WHERE id = $recipeId"; // Предположим, что таблица с рецептами называется "recepe"
    $result = $conn->query($sql);

    // Если данные найдены, отобразите их
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $recipeTitle = $row["title"];
        $recipeDescription = $row["description"];
        $imageUrl = $row["image_url"]; // Получение URL изображения
        
        // Вывод информации о рецепте на страницу
        echo "<h1>$recipeTitle</h1>";
        echo "<p>$recipeDescription</p>";
        echo "<img src='$imageUrl' alt='$recipeTitle' class='recipe-image'>"; // Вывод изображения
    } else {
        echo "Рецепт не найден";
    }
    

    // Запрос данных о деталях рецепта из таблицы item по recipe_id
    $sql = "SELECT * FROM item WHERE recepe_id = $recipeId"; // Предположим, что таблица с деталями рецептов называется "item"
    $result = $conn->query($sql);

    // Если данные найдены, отобразите их
    if ($result->num_rows > 0) {
        // Вывод информации о рецепте на страницу
        while($row = $result->fetch_assoc()) {
            // Вывод данных о деталях рецепта
            echo "<p>" . $row["name"] . "</p>"; // Замените "name" на фактическое название столбца в вашей таблице
        }
    } else {
        echo "Данные о деталях рецепта не найдены";
    }

    $conn->close();
    ?>
  </div>
</div>
<style>
    .recipe-image {
      width: 600px; /* Установите нужные значения ширины */
      height: 350px; /* Установите нужные значения высоты */
      object-fit: cover; /* Сохранение пропорций и обрезка по необходимости */
    }
  </style>
    <button onclick="window.location.href='./addNew.html';">edit</button>

</body>
</html>
