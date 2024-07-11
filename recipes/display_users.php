<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    // Generate a cache buster using the current timestamp
    $cacheBuster = time();
    ?>
    <link rel="stylesheet" href="show_users.css?v=<?php echo $cacheBuster; ?>">
    <title>Display Users</title>
</head>
 <?php include 'header.php'?>
<body>
    <h1>Users</h1>
    
    <?php
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        // User is not logged in, redirect to login page
        header("Location: login.php");
        exit();
    }

    // Check if user is an admin
    if ($_SESSION['user_type_id'] != 2) { 
        // User is not an admin, redirect to home page
        header("Location: home.php");
        exit();
    }

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require 'db_connect.php';

    // Pagination setup
    $limit = 10; // Number of entries per page
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $offset = ($page - 1) * $limit;

    // Count total users
    $resultTotal = $conn->query("SELECT COUNT(*) as count FROM Users");
    $totalUsers = $resultTotal->fetch_assoc()['count'];
    $totalPages = ceil($totalUsers / $limit);

    // Modify the SQL query to join with the UserType table with pagination
    $sql = "
        SELECT u.UserID, u.Email, ut.UserGroup AS UserGroup, u.UserImage 
        FROM Users u
        JOIN UserType ut ON u.UserTypeID = ut.UserTypeID
        LIMIT $limit OFFSET $offset
    ";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo '<table>';
        echo '
            <tr>
                <th>Email</th> 
                <th>User Group</th> 
                <th>User Image</th>
                <th>Actions</th>
            </tr>
        ';
        
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['Email'] . '</td>';
            echo '<td>' . $row['UserGroup'] . '</td>';
            echo '<td><img src="' . $row['UserImage'] . '" alt="User Image" width="50" height="50"></td>';
            echo '<td><a href="edit_user.php?id=' . $row['UserID'] . '">Edit</a></td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo "No users found.";
    }

    // Pagination links
    if ($totalPages > 1) {
        echo '<div class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="?page=' . $i . '">' . $i . '</a> ';
        }
        echo '</div>';
    }

    $conn->close();
    ?>
</body>
</html>
