<?php
// Start the session to manage user login state
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: login.html");
    exit();
}

// Include database connection file
require 'db_connect.php';

// Fetch user's first name from the database
$userID = $_SESSION['user_id'];
$userSql = "SELECT Fname FROM Users WHERE UserID = ?";
$userStmt = $conn->prepare($userSql);
$userStmt->bind_param("i", $userID);
$userStmt->execute();
$userResult = $userStmt->get_result();

if ($userResult->num_rows > 0) {
    $userRow = $userResult->fetch_assoc();
    $userName = htmlspecialchars($userRow['Fname']);
} else {
    $userName = 'User';
}

// Fetch user's recipes from the database
$sql = "SELECT RecipeID, RecipeName, RecipeImage 
        FROM Recipes
        WHERE RecipeOwner = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

// Start outputting HTML
echo '<!DOCTYPE html>
      <html lang="en">
      <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Dashboard</title>
          <link rel="stylesheet" href="dashboard.css?v=' . time() . '">
      </head>
      <body>
      <h1>Welcome to Your Dashboard, ' . $userName . '</h1>
      <div class="recipes-container">';
    if ($result->num_rows > 0) {
        // Display recipes in card format
        while ($row = $result->fetch_assoc()) {
            echo '<div class="recipe-card">';
            echo '<div class="recipe-image">';
            echo '<img src="' . htmlspecialchars($row['RecipeImage']) . '" alt="' . htmlspecialchars($row['RecipeName']) . '">';
            echo '</div>';
            echo '<h2 class="recipe-name">' . htmlspecialchars($row['RecipeName']) . '</h2>';
            echo '</div>';
        }
    } else {
        echo '<p>No recipes found.</p>';
    }

// End of HTML
echo '</div>
      </body>
      </html>';

// Close statement and database connection
$stmt->close();
$conn->close();
?>
