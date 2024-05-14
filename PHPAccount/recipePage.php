

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>custom</title>
  <meta name="title" content="E-cook - Cooking made easy.">
  <meta name="description" content="This is a recipe application made by codewithsadee">


  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <script src="./assets/js/theme.js"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&family=DM+Serif+Display&display=swap"
    rel="stylesheet">

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0..1,0" />

  <link rel="stylesheet" href="./assets/css/style.css">

  <script src="./assets/js/global.js" type="module"></script>
  <script src="./assets/js/home.js" type="module"></script>
</head>
<body>
    <header class="header" data-header>

        <a href="/" class="logo">
          <img src="./assets/images/logo-light.svg" width="156" height="32" alt="E-cook" class="logo-light">
          <img src="./assets/images/logo-dark.svg" width="156" height="32" alt="E-cook" class="logo-dark">
        </a>
    
        <nav class="navbar">
          <ul class="navbar-list">
    
            <li>
              <a href="/" class="navbar-link title-small has-state active">Home</a>
            </li>
    
            <li>
              <a href="./recipes.html" class="navbar-link title-small has-state">Recipes</a>
            </li>
            <li>
                <a href="customPrzepisy.html" class="navbar-link title-small has-state">Custom</a>
              </li>
              <li>
                <a href="addNew.html" class="navbar-link title-small has-state">Add new</a>
              </li>
    
          </ul>
        </nav>
    
        <button class="icon-btn theme-switch has-state" aria-pressed="false" aria-label="Toggle light and dark theme"
          data-theme-btn>
          <span class="material-symbols-outlined light-icon" aria-hidden="true">light_mode</span>
    
          <span class="material-symbols-outlined dark-icon" aria-hidden="true">dark_mode</span>
        </button>
    
        <a href="./saved-recipes.html" class="btn btn-primary has-icon">
          <span class="material-symbols-outlined" aria-hidden="true">book</span>
    
          <span class="span">Saved Recipes</span>
        </a>
    
    </header>

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

// Запрос данных о рецепте из таблицы recepe
$sql = "SELECT * FROM recepe WHERE id = $recipeId"; // Предположим, что таблица с рецептами называется "recepe"
$result = $conn->query($sql);

// Если данные найдены, отобразите их
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $recipeTitle = $row["title"];
    $recipeDescription = $row["description"];
    $recipeTime = $row["time"];
    $recipeImageUrl = $row["image_url"];

    // Вывод информации о рецепте на страницу
    echo "<h1>$recipeTitle</h1>";
    echo "<h1>$recipeImageUrl</h1>";
    echo "<p>$recipeDescription</p>";
    echo "<p>$recipeTime</p>";

    // Запрос данных об ингредиентах из таблицы item по recipe_id
    $ingredientSql = "SELECT * FROM item WHERE recepe_id = $recipeId"; // Предположим, что таблица с ингредиентами называется "item"
    $ingredientResult = $conn->query($ingredientSql);

    // Если данные об ингредиентах найдены, отобразите их
    if ($ingredientResult->num_rows > 0) {
        echo "<h2>Ингредиенты:</h2>";
        echo "<ul>";
        while($ingredientRow = $ingredientResult->fetch_assoc()) {
            $ingredientName = $ingredientRow["name"];
            $ingredientCount = $ingredientRow["count"];
            echo "<li>$ingredientName - $ingredientCount</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Ингредиенты не найдены</p>";
    }
} else {
    echo "Рецепт не найден";
}

$conn->close();
?>


</body>
</html>