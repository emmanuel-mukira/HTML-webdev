<?php
// Include database connection file
require 'db_connect.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to edit a recipe.");
}

// Check if recipe ID is provided
if (!isset($_GET['id'])) {
    die("Recipe ID is required.");
}

$recipeID = intval($_GET['id']);

// Fetch recipe details
$stmt = $conn->prepare("SELECT r.RecipeName, r.Ingredients, r.RecipeImage, r.Instructions, r.RecipeOwner AS RecipeOwnerID
                        FROM Recipes r
                        WHERE r.RecipeID = ?");
$stmt->bind_param("i", $recipeID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Recipe not found.");
}

$recipe = $result->fetch_assoc();
$stmt->close();

// Check if the logged-in user is the recipe owner or an admin
$isRecipeOwner = $_SESSION['user_id'] == $recipe['RecipeOwnerID'];
$isAdmin = $_SESSION['user_type_id'] == 2; // admin UserTypeID

if (!$isRecipeOwner && !$isAdmin) {
    die("You do not have permission to edit this recipe.");
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipeName = $_POST['RecipeName'];
    $ingredients = $_POST['Ingredients'];
    $instructions = $_POST['Instructions'];

    // Handle file upload
    if (isset($_FILES['RecipeImage']) && $_FILES['RecipeImage']['error'] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES['RecipeImage']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['RecipeImage']['tmp_name']);
        if ($check === false) {
            die("File is not an image.");
        }

        // Check file size (limit to 5MB)
        if ($_FILES['RecipeImage']['size'] > 5000000) {
            die("Sorry, your file is too large.");
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        // Check if file already exists
        if (file_exists($targetFile)) {
            die("Sorry, file already exists.");
        }

        // Try to upload file
        if (!move_uploaded_file($_FILES['RecipeImage']['tmp_name'], $targetFile)) {
            die("Sorry, there was an error uploading your file.");
        }

        $recipeImage = $targetFile;
    } else {
        $recipeImage = $recipe['RecipeImage']; // keep the old image if no new image is uploaded
    }

    // Update recipe details in the database
    $stmt = $conn->prepare("UPDATE Recipes SET RecipeName = ?, Ingredients = ?, Instructions = ?, RecipeImage = ? WHERE RecipeID = ?");
    $stmt->bind_param("ssssi", $recipeName, $ingredients, $instructions, $recipeImage, $recipeID);

    if ($stmt->execute()) {
        echo "Recipe updated successfully!";
    } else {
        echo "Error updating recipe: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect to the recipe details page
    header("Location: recipe_details.php?id=$recipeID");
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
     $cacheBuster = time();
    ?>
    <link rel="stylesheet" href="edit_recipe.css?v=<?php echo $cacheBuster; ?>">
    <title>Edit Recipe</title>
</head>
<?php include "header.php"?>
<body>
    <h1>Edit Recipe</h1>
    <form action="edit_recipe.php?id=<?php echo $recipeID; ?>" method="post" enctype="multipart/form-data">
        <label for="RecipeName">Recipe Name:</label><br>
        <input type="text" id="RecipeName" name="RecipeName" value="<?php echo htmlspecialchars($recipe['RecipeName']); ?>"><br><br>
        
        <label for="Ingredients">Ingredients:</label><br>
        <textarea id="Ingredients" name="Ingredients" rows="4" cols="50"><?php echo htmlspecialchars($recipe['Ingredients']); ?></textarea><br><br>
        
        <label for="Instructions">Instructions:</label><br>
        <textarea id="Instructions" name="Instructions" rows="4" cols="50"><?php echo htmlspecialchars($recipe['Instructions']); ?></textarea><br><br>
        
        <label for="RecipeImage">Recipe Image:</label><br>
        <input type="file" id="RecipeImage" name="RecipeImage"><br><br>
        <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($recipe['RecipeImage']); ?>">
        <img src="<?php echo htmlspecialchars($recipe['RecipeImage']); ?>" alt="Recipe Image" width="100"><br>

        <input type="submit" value="Update Recipe">
    </form>
</body>
</html>
