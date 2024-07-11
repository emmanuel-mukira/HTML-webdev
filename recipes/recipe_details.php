<?php
// Include database connection file
require 'db_connect.php';

// Start the session
session_start();

// Check if recipe ID is provided
if (!isset($_GET['id'])) {
    die("Recipe ID is required.");
}

$recipeID = intval($_GET['id']);

// Fetch recipe details
$stmt = $conn->prepare("SELECT r.RecipeName, r.Ingredients, r.RecipeImage, r.Instructions, u.Fname AS RecipeOwner 
                        FROM Recipes r
                        LEFT JOIN Users u ON r.RecipeOwner = u.UserID
                        WHERE r.RecipeID = ?");
$stmt->bind_param("i", $recipeID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Recipe not found.");
}

$recipe = $result->fetch_assoc();
$stmt->close();
$conn->close();

// Check if the logged-in user is the recipe owner or an admin
$isRecipeOwner = $_SESSION['userID'] == $recipe['RecipeOwnerID'];
$isAdmin = $_SESSION['user_type_id'] == 2; 
// assuming you have a session variable for user role
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
     $cacheBuster=time();
    ?>
    <link rel="stylesheet" href="recipe_details.css?v=<?php echo $cacheBuster; ?>">
    <title><?php echo htmlspecialchars($recipe['RecipeName']); ?></title>
</head>
<?php include "header.php"?>
<body>
    <div class="recipe-details">
        <h1><?php echo htmlspecialchars($recipe['RecipeName']); ?></h1>
        <img src="<?php echo htmlspecialchars($recipe['RecipeImage']); ?>" alt="<?php echo htmlspecialchars($recipe['RecipeName']); ?>">
        <h2>Ingredients</h2>
        <p><?php echo nl2br(htmlspecialchars($recipe['Ingredients'])); ?></p>
        <h2>Instructions</h2>
        <p><?php echo nl2br(htmlspecialchars($recipe['Instructions'])); ?></p>
        <p><strong>Recipe Owner:</strong> <?php echo htmlspecialchars($recipe['RecipeOwner']); ?></p>

        <?php if ($isRecipeOwner || $isAdmin): ?>
            <div class="recipe-actions">
            <a href="edit_recipe.php?id=<?php echo $recipeID; ?>"class="edit-recipe">Edit Recipe</a>
            <a href="delete_recipe.php?id=<?php echo $recipeID; ?>" class="delete-recipe" onclick="return confirm('Are you sure you want to delete this recipe?');">Delete Recipe</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
