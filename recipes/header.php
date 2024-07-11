<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    // Generate a cache buster using the current timestamp
    $cacheBuster = time();
    ?>
    <link rel="stylesheet" href="header.css?v=<?php echo $cacheBuster; ?>">
    <title>Your Website Title</title>
</head>
<body>
    <div class="navbar">
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="recipes.php">Recipes</a></li>
                <li><a href="display_users.php">Users</a></li>
                <li><a href="Create.html">Create</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="login.html">Log In</a></li>
                <?php
                session_start();
                if(isset($_SESSION['firstname'])) {
                    echo '<li class="user-info"><span class="username">' . 'Welcome ' . htmlspecialchars($_SESSION['firstname']) . '</span></li>';
                } else {
                    echo '<li><a href="register.html">Register</a></li>';
                }
                ?>
            </ul>
            <h1 class="logo"><img id="logo-image" src="images/whisk-and-bowl.png" alt="logo-image">Whisk</h1>
        </nav>
    </div>
</body>
</html>
