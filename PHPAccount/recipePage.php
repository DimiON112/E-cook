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
  <h1 class="recipe-title">All Recipes</h1>
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

    $recipe_query = "SELECT * FROM recepe";
    $recipe_result = $conn->query($recipe_query);
    if ($recipe_result->num_rows > 0) {
        while ($recipe = $recipe_result->fetch_assoc()) {
            $recipe_id = $recipe['id'];
            $ingredient_query = "SELECT COUNT(*) as ingredient_count FROM item WHERE recepe_id = $recipe_id";
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
            echo '<p class="detail-author">by me :)</p>';
            echo '<div class="detail-stats">';
            echo '<div class="stats-item"><span class="label-medium">Ingredients</span><span>' . $ingredient_count . '</span></div>';
            echo '<div class="stats-item"><span class="label-medium">Minutes</span><span>' . $recipe['time'] . '</span></div>';
            echo '<div class="stats-item"><span class="label-medium">Calories</span><span>274</span></div>';
            echo '</div>';
            echo '<div class="tag-list">';
            echo '</div>';
            echo '<div class="ingr-title"><span class="label-large">Ingredients</span></div>';
            echo '<ul class="ingr-list">';
            
            $ingredient_query = "SELECT name FROM item WHERE recepe_id = $recipe_id";
            $ingredient_result = $conn->query($ingredient_query);
            if ($ingredient_result->num_rows > 0) {
                while ($ingredient = $ingredient_result->fetch_assoc()) {
                    echo '<li class="ingr-item">' . $ingredient['name'] . '</li>';
                }
            }
            echo '</ul>';
            echo '</div>';
            echo '</article>';
        }
    } else {
        echo "<p>No recipes found.</p>";
    }

    $conn->close();
    ?>
  </div>
</div>
</body>

</html>
