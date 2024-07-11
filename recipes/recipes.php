<?php
// Include database connection file
require 'db_connect.php';

// Start the session
session_start();

// Fetch categories and their recipes
$sql = "SELECT c.CategoryName, r.RecipeID, r.RecipeName, r.RecipeImage 
        FROM Categories c 
        JOIN Recipes r ON c.CategoryID = r.CategoryID
        ORDER BY c.CategoryName, r.RecipeName";

$result = $conn->query($sql);

$recipes_by_category = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $recipes_by_category[$row['CategoryName']][] = $row;
    }
}

$conn->close();
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
    <title>All Recipes</title>
</head>

<body>
    <?php
     include 'header.php';
    ?>
    <div class="container">
        <?php foreach ($recipes_by_category as $category => $recipes): ?>
            <h2><?php echo htmlspecialchars($category); ?></h2>
            <div class="recipe-cards">
                <?php foreach ($recipes as $recipe): ?>
                    <div class="recipe-card">
                        <a href="recipe_details.php?id=<?php echo $recipe['RecipeID']; ?>">
                            <img src="<?php echo htmlspecialchars($recipe['RecipeImage']); ?>" alt="<?php echo htmlspecialchars($recipe['RecipeName']); ?>">
                            <h3><?php echo htmlspecialchars($recipe['RecipeName']); ?></h3>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
