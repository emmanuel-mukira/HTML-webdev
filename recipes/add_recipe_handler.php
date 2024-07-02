<?php
// Start the session to access user ID
session_start();

// Include database connection file
require 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You are not logged in. Please log in first.";
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $RecipeName = $_POST['RecipeName'];
    $Ingredients = $_POST['Ingredients'];
    $Instructions = $_POST['Instructions'];
    $CategoryID = $_POST['CategoryID'];
    $RecipeOwner = $_SESSION['user_id'];
    $RecipeImage = "uploads/" . basename($_FILES['RecipeImage']['name']);
   
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    mysqli_set_charset($conn, "utf8mb4");

    
    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES['RecipeImage']['tmp_name'], $RecipeImage)) {

        // Insert recipe data into the database
        $sql = "INSERT INTO Recipes (RecipeName, Ingredients, Instructions, RecipeOwner, RecipeImage, CategoryID) 
                VALUES ('$RecipeName', '$Ingredients', '$Instructions', '$RecipeOwner', '$RecipeImage', '$CategoryID')";
        
        if ($conn->query($sql) === TRUE) {
            $RecipeID = $conn->insert_id;
            echo "New recipe added successfully";
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $conn->close();
} else {
    // If the form is not submitted, handle as needed (optional)
    echo "Please submit the form.";
}
?>
