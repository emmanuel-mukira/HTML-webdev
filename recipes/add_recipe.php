<!DOCTYPE html>
<html>
<head>
    <title>Add Recipe</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php
    // Generate a cache buster using the current timestamp
    $cacheBuster = time();
    ?>
    <link rel="stylesheet" href="add_recipe.css?v=<?php echo $cacheBuster; ?>">
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'get_categories.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var categoryDropdown = $('#CategoryID');
                    categoryDropdown.empty(); // Clear the existing options
                    categoryDropdown.append('<option value="">Select a category</option>');
                    $.each(data, function(key, value) {
                        categoryDropdown.append($('<option></option>').attr('value', value.CategoryID).text(value.CategoryName));
                    });
                },
                error: function() {
                    alert('Failed to load categories');
                }
            });
        });
    </script>
</head>
<body>
    <?php include 'check_login.php'; ?>

    <a id="back-to" href="home.php">Back to Home page</a>
    <form action="add_recipe_handler.php" method="post" enctype="multipart/form-data">
        <legend id="main-legend"><img id="logo-image" src="images/whisk-and-bowl.png" alt="logo-image">Whisk</legend>
        <legend id="sub-legend">Add your Recipe Below</legend>
        <label for="RecipeName">Recipe Name:</label><br>
        <input type="text" id="RecipeName" name="RecipeName" required><br>

        <label for="Ingredients">Ingredients:</label><br>
        <textarea id="Ingredients" name="Ingredients" required></textarea><br>

        <label for="Instructions">Instructions:</label><br>
        <textarea id="Instructions" name="Instructions" required></textarea><br>

        <label for="RecipeImage">Recipe Image:</label><br>
        <input type="file" id="RecipeImage" name="RecipeImage" required><br>

        <label for="CategoryID">Category:</label><br>
        <select id="CategoryID" name="CategoryID" required>
            <option value="">Loading categories...</option>
        </select><br><br>
        <input id="submit" type="submit" value="Submit">
    </form>

</body>
</html>
