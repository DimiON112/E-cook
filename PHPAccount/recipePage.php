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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&family=DM+Serif+Display&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0..1,0" />
  <link rel="stylesheet" href="./assets/css/style.css">
  <style>
    :root {
      --background-color: #1c1c1c;
      --text-color: #ffffff;
      --card-background-color: #333;
      --card-text-color: #fff;
    }

    [data-theme="light"] {
      --background-color: #ffffff;
      --text-color: #000000;
      --card-background-color: #f0f0f0;
      --card-text-color: #000;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background-color: var(--background-color);
      color: var(--text-color);
      margin: 0;
      padding: 0;
      line-height: 1.6; /* Increase line spacing */
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
    }

    .recipe-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;
      border-bottom: 2px solid #333;
      padding-bottom: 10px;
    }

    .recipe-header h1 {
      font-size: 2.5em;
      margin: 0;
      font-family: 'DM Serif Display', serif;
    }

    .detail-page {
      display: flex;
      flex-direction: row;
      gap: 20px;
      margin-top: 20px;
    }

    .detail-banner {
      flex: 1;
      display: flex;
      justify-content: center;
    }

    .detail-banner img {
      width: 550px; /* Dopasuj szerokość do kontenera */
      height: 550px; /* Stała wysokość dla wszystkich obrazów */
      object-fit: cover; /* Zachowaj proporcje, przycinając nadmiar */
      border-radius: 10px; /* Zaokrąglone rogi */
    }

    .detail-content {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 20px;
      align-items: flex-start;
      margin-left: 20px;
    }

    .title-large {
      font-size: 2.5em;
      margin: 0;
    }

    .detail-stats {
      display: flex;
      gap: 40px; /* Increase the gap between stats items */
      font-size: 1.5em;
      margin-left: 20px; /* Dodaj margines do przesunięcia całego bloku w prawo */
    }

    .stats-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .stats-item:nth-child(2),
    .stats-item:nth-child(3) {
      margin-left: 20px; /* Dodaj margines tylko dla drugiego i trzeciego elementu */
    }

    .stats-item span.label-medium {
      margin-left: 10px; /* Dodaj margines tylko dla etykiet */
    }

    .stats-item span:first-child {
      font-size: 1.5em;
      color: var(--text-color);
    }

    .stats-item span:last-child {
      font-size: 0.8em;
      color: #bbb;
    }

    .tag-list {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .tag-list span {
      background-color: #333;
      padding: 5px 10px;
      border-radius: 5px;
      font-size: 1em;
    }

    .ingr-title {
      font-size: 2em; /* Zwiększ rozmiar czcionki */
      font-weight: bold; /* Zwiększ grubość czcionki */
      color: var(--text-color); /* Użyj zmiennej koloru tekstu */
    }

    .ingr-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .ingr-list li {
      margin-bottom: 10px;
      font-size: 1.2em;
    }

    .recipe-description p {
      overflow: visible; /* Upewnij się, że cały tekst jest widoczny */
      white-space: normal; /* Usuń ograniczenia co do białych znaków */
      height: auto; /* Upewnij się, że wysokość elementu dostosowuje się do treści */
    }

    .btn-edit {
      background-color: hsl(11, 87%, 59%);
      color: #fff;
      padding: 15px 30px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      text-decoration: none;
      font-size: 18px;
      align-self: flex-end;
      margin-left: 10px;
      margin-top: 20px;
    }

    .btn-edit:hover {
      background-color: hsl(11, 60%, 50%);
    }

    .theme-switch {
      margin-left: auto;
    }
  </style>
</head>

<body>
  <?php
  function isActive($page)
  {
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
        <li><a href="./index.html" class="navbar-link title-small has-state <?php echo isActive('index.html'); ?>">Home</a></li>
        <li><a href="./recipes.html" class="navbar-link title-small has-state <?php echo isActive('recipes.html'); ?>">Recipes</a></li>
        <li><a href="./customPrzepisy.html" class="navbar-link title-small has-state <?php echo isActive('customPrzepisy.html'); ?>">My recipes</a></li>
        <li><a href="./addNew.html" class="navbar-link title-small has-state <?php echo isActive('addNew.html'); ?>">Add new</a></li>
        <li><a href="./recipePage.php" class="navbar-link title-small has-state <?php echo isActive('recipePage.php'); ?>">Added recipe</a></li>
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
    <h1 class="recipe-title">Recipe Details</h1>
    <div class="recipes">
      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "login_db";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $recipeId = $_GET['id'];
      $recipe_query = "SELECT * FROM recepe WHERE id = $recipeId";
      $recipe_result = $conn->query($recipe_query);

      if ($recipe_result->num_rows > 0) {
        $recipe = $recipe_result->fetch_assoc();
        $ingredient_query = "SELECT COUNT(*) as ingredient_count FROM item WHERE recepe_id = $recipeId";
        $ingredient_result = $conn->query($ingredient_query);
        $ingredient_count = $ingredient_result->fetch_assoc()['ingredient_count'];

        echo '<article class="article container detail-page">';
        echo '<div class="detail-banner">';
        echo '<img src="' . $recipe['image_url'] . '" alt="Recipe Image" class="recipe-image">';
        echo '</div>';
        echo '<div class="detail-content">';
        echo '<div class="title-wrapper">';
        echo '<h2 class="title-large">' . $recipe['title'] . '</h2>';
        echo '</div>';
        echo '<div class="detail-stats">';
        echo '<div class="stats-item"><span>' . $ingredient_count . '</span><span class="label-medium">Ingredients</span></div>';
        echo '<div class="stats-item"><span>' . $recipe['time'] . '</span><span class="label-medium">Minutes</span></div>';
        echo '<div class="stats-item"><span>274</span><span class="label-medium">Calories</span></div>';
        echo '</div>';
        echo '<div class="tag-list">';
        echo '</div>';
        echo '<div class="ingr-title"><span style="font-size: 22px; font-weight: bold; color: var(--text-color);">Ingredients</span></div>';
        echo '<ul class="ingr-list">';

        $ingredient_query = "SELECT name FROM item WHERE recepe_id = $recipeId";
        $ingredient_result = $conn->query($ingredient_query);
        if ($ingredient_result->num_rows > 0) {
          while ($ingredient = $ingredient_result->fetch_assoc()) {
            echo '<li class="ingr-item">' . $ingredient['name'] . '</li>';
          }
        }
        echo '</ul>';
        echo '<div class="recipe-description">';
        echo '<h2>Description</h2>';
        echo '</div>';
        echo '<p>' . $recipe['description'] . '</p>';
        echo '<a href="./edit_recipe.php" class="btn-edit">Edit</a>';  // Adding the Edit button here
        echo '</div>';
        echo '</div>';
        echo '</article>';
      } else {
        echo "<p>No recipes found.</p>";
      }

      $conn->close();
      ?>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const themeBtn = document.querySelector('[data-theme-btn]');
      const currentTheme = localStorage.getItem('theme') || 'dark';
      document.body.setAttribute('data-theme', currentTheme);
      themeBtn.setAttribute('aria-pressed', currentTheme === 'dark' ? 'true' : 'false');

      themeBtn.addEventListener('click', function () {
        const newTheme = document.body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        document.body.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        themeBtn.setAttribute('aria-pressed', newTheme === 'dark' ? 'true' : 'false');
      });
    });
  </script>
  
</body>

</html>
