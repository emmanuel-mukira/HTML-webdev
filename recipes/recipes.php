<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="show_recipes.css">
    <title>Display Recipes</title>
</head>
<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db_connect.php';

// SQL query to fetch recipes with owner's email and category name
$sql = "
    SELECT 
        r.RecipeID, 
        r.RecipeName, 
        r.Ingredients, 
        r.RecipeImage, 
        u.Email AS RecipeOwner, 
        c.CategoryName AS CategoryName, 
        r.Instructions 
    FROM 
        recipes.Recipes r
    JOIN 
        Users u ON r.RecipeOwner = u.UserID
    JOIN 
        Categories c ON r.CategoryID = c.CategoryID
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display data in an HTML table
    echo '<table>';
    echo '<tr>
              <th>RecipeID</th> 
              <th>RecipeName</th> 
              <th>Ingredients</th> 
              <th>RecipeImage</th> 
              <th>RecipeOwner</th> 
              <th>CategoryName</th> 
              <th>Instructions</th> 
          </tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['RecipeID'] . '</td>';
        echo '<td>' . $row['RecipeName'] . '</td>';
        echo '<td>' . $row['Ingredients'] . '</td>';
        echo '<td><img src="' . $row['RecipeImage'] . '" alt="Recipe Image"></td>';
        echo '<td>' . $row['RecipeOwner'] . '</td>';
        echo '<td>' . $row['CategoryName'] . '</td>';
        echo '<td>' . $row['Instructions'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "No recipes found";
}

$conn->close();
?>
</body>
</html>
