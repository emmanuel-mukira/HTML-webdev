<?php
// Include database connection file
require 'db_connect.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $CategoryName = $_POST['CategoryName'];

    // Insert the new category into the database
    $sql = "INSERT INTO Categories (CategoryName) VALUES ('$CategoryName')";

    if ($conn->query($sql) === TRUE) {
        echo "New category added successfully";

        //Redirect to home.php
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Display the form
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="add_category.css">
</head>
<body>
    <a id="back-to" href="home.php">Back to Home page</a>
    <form action="add_category.php" method="post">
        <legend id="main-legend"><img id="logo-image" src="images/whisk-and-bowl.png" alt="logo-image">Whisk</legend>
        <legend id="sub-legend">Add a Category Below</legend>
        <label for="CategoryName">Category Name:</label><br>
        <input type="text" id="CategoryName" name="CategoryName" required><br><br>
        <input id="submit" type="submit" value="Add Category">
    </form>
</body>
</html>
<?php
}
?>
