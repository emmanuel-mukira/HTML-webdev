<?php
// Include database connection file
require 'db_connect.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to delete a recipe.");
}

// Check if recipe ID is provided
if (!isset($_GET['id'])) {
    die("Recipe ID is required.");
}

$recipeID = intval($_GET['id']);

// Fetch recipe details
$stmt = $conn->prepare("SELECT RecipeOwner FROM Recipes WHERE RecipeID = ?");
$stmt->bind_param("i", $recipeID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Recipe not found.");
}

$recipe = $result->fetch_assoc();
$stmt->close();

// Check if the logged-in user is the recipe owner or an admin
$isRecipeOwner = $_SESSION['user_id'] == $recipe['RecipeOwner'];
$isAdmin = $_SESSION['user_type_id'] == 2; // admin UserTypeID

if (!$isRecipeOwner && !$isAdmin) {
    die("You do not have permission to delete this recipe.");
}

// Delete recipe from the database
$stmt = $conn->prepare("DELETE FROM Recipes WHERE RecipeID = ?");
$stmt->bind_param("i", $recipeID);

if ($stmt->execute()) {
    echo "Recipe deleted successfully!";
} else {
    echo "Error deleting recipe: " . $conn->error;
}

$stmt->close();
$conn->close();

// Redirect to a page after deletion
header("Location: dashboard.php"); // Change to the appropriate page
exit;
?>
