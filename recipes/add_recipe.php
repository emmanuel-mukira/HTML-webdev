<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $RecipeName = $_POST['RecipeName'];
    $Ingredients = $_POST['Ingredients'];
    $Instructions = $_POST['Instructions'];
    $RecipeOwner = $_POST['RecipeOwner'];
    $CategoryID = $_POST['CategoryID'];
    $RecipeImage = $_FILES['RecipeImage']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($RecipeImage);

    if (move_uploaded_file($_FILES['RecipeImage']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO Recipes (RecipeName, Ingredients, Instructions, RecipeOwner, RecipeImage, CategoryID) 
        VALUES ('$RecipeName', '$Ingredients', '$Instructions', '$RecipeOwner', '$target_file', '$CategoryID')";

        if ($conn->query($sql) === TRUE) {
            $RecipeID = $conn->insert_id;
            echo "New recipe added successfully";
        } else {
                echo "Error: " . $sql. "<br>" . $conn->error;
        }
      
        $conn->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

