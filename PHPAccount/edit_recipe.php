<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Edit Recipe</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$recipeId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $recipeId = intval($_POST['recipeId']);
    $title = $conn->real_escape_string($_POST['recipeName']);
    $description = $conn->real_escape_string($_POST['description']);
    $time = $conn->real_escape_string($_POST['time']);
    $imageUrl = $conn->real_escape_string($_POST['image_url']);
    $ingredients = $_POST['ingredient'];

    // Update the recipe
    $sql = "UPDATE recepe SET title='$title', description='$description', time='$time', image_url='$imageUrl' WHERE id=$recipeId";
    if ($conn->query($sql) === TRUE) {
        // Update ingredients
        $existingIngredientsQuery = "SELECT id, name FROM item WHERE recepe_id = $recipeId";
        $existingIngredientsResult = $conn->query($existingIngredientsQuery);
        $existingIngredients = [];
        while ($row = $existingIngredientsResult->fetch_assoc()) {
            $existingIngredients[$row['id']] = $row['name'];
        }

        foreach ($ingredients as $index => $ingredient) {
            if (isset($existingIngredients[$index])) {
                // Update existing ingredient
                $ingredientId = intval($index);
                $ingredientName = $conn->real_escape_string($ingredient);
                $updateSql = "UPDATE item SET name='$ingredientName' WHERE id=$ingredientId";
                $conn->query($updateSql);
            } else {
                // Insert new ingredient
                $ingredientName = $conn->real_escape_string($ingredient);
                $insertSql = "INSERT INTO item (recepe_id, name) VALUES ($recipeId, '$ingredientName')";
                $conn->query($insertSql);
            }
        }

        // Remove deleted ingredients
        foreach ($existingIngredients as $id => $name) {
            if (!in_array($id, array_keys($ingredients))) {
                $deleteSql = "DELETE FROM item WHERE id=$id";
                $conn->query($deleteSql);
            }
        }

        echo "Recipe updated successfully";
    } else {
        echo "Error updating recipe: " . $conn->error;
    }

    $conn->close();
    exit();
}

if ($recipeId > 0) {
    $sql = "SELECT title, description, time, image_url FROM recepe WHERE id = $recipeId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $recipe = $result->fetch_assoc();

        $ingredientsSql = "SELECT id, name FROM item WHERE recepe_id = $recipeId";
        $ingredientsResult = $conn->query($ingredientsSql);
        $ingredients = [];
        while ($row = $ingredientsResult->fetch_assoc()) {
            $ingredients[$row['id']] = $row['name'];
        }
    } else {
        echo "Recipe not found";
        exit();
    }
} else {
    echo "Invalid request";
    exit();
}

$conn->close();
?>

<section class="recipe-form-section">
  <form action="edit_recipe.php?id=<?php echo $recipeId; ?>" method="post" class="recipe-form">
    <input type="hidden" id="recipeId" name="recipeId" value="<?php echo $recipeId; ?>">
    <div class="form-group">
      <label for="recipeName">Recipe Name:</label>
      <input type="text" id="recipeName" name="recipeName" value="<?php echo htmlspecialchars($recipe['title']); ?>" required>
    </div>
    <div class="form-group">
      <label for="description">Description:</label>
      <textarea id="description" name="description" required><?php echo htmlspecialchars($recipe['description']); ?></textarea>
    </div>
    <div class="form-group">
      <label for="time">Preparation Time:</label>
      <input type="text" id="time" name="time" value="<?php echo htmlspecialchars($recipe['time']); ?>" required>
    </div>
    <div class="form-group">
      <label for="image_url">Image URL:</label>
      <input type="text" id="image_url" name="image_url" value="<?php echo htmlspecialchars($recipe['image_url']); ?>" required>
    </div>
    <div class="ingredients-container" id="ingredientsContainer">
      <?php
      $index = 0;
      foreach ($ingredients as $id => $ingredient) {
          echo '<div class="ingredient-row">';
          echo '<label for="ingredient' . $index . '">Ingredient ' . ($index + 1) . ':</label>';
          echo '<input type="text" id="ingredient' . $index . '" name="ingredient[' . $id . ']" value="' . htmlspecialchars($ingredient) . '" required>';
          echo '</div>';
          $index++;
      }
      ?>
    </div>
    <button type="button" id="addIngredientButton" class="btn">Add Ingredient</button>
    <br>
    <br>
    <input type="submit" value="Save Recipe" class="btn"
      style="display: block; margin: 0 auto; padding: 30px 50px; font-size: 20px; line-height: 5px;">
  </form>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const addIngredientButton = document.getElementById('addIngredientButton');
    const ingredientsContainer = document.getElementById('ingredientsContainer');
    let ingredientIndex = <?php echo count($ingredients); ?>;

    addIngredientButton.addEventListener('click', function () {
      const newIngredientRow = document.createElement('div');
      newIngredientRow.classList.add('ingredient-row');
      newIngredientRow.innerHTML = `
          <label for="ingredient${ingredientIndex}">Ingredient ${ingredientIndex + 1}:</label>
          <input type="text" id="ingredient${ingredientIndex}" name="ingredient[new_${ingredientIndex}]" required>
      `;
      ingredientsContainer.appendChild(newIngredientRow);
      ingredientIndex++;
    });
  });
</script>
</body>
</html>
