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

require 'db_connect.php';

// Get user ID from the URL
$userID = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update user information
    $email = $_POST['email'];
    $userGroup = $_POST['user_group'];
    $userImage = '';

    // Handle file upload
    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["user_image"]["name"]);
        move_uploaded_file($_FILES["user_image"]["tmp_name"], $targetFile);
        $userImage = $targetFile;
    } else {
        // If no new image is uploaded, retain the existing image
        $userImage = $_POST['existing_image'];
    }

    $stmt = $conn->prepare("UPDATE Users SET Email = ?, UserImage = ?, UserTypeID = ? WHERE UserID = ?");
    $stmt->bind_param("ssii", $email, $userImage, $userGroup, $userID);

    if ($stmt->execute()) {
        echo "User updated successfully.";
    } else {
        echo "Error updating user: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch user information to display in the form
$stmt = $conn->prepare("SELECT u.Email, u.UserTypeID, u.UserImage FROM Users u WHERE u.UserID = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($email, $userTypeID, $userImage);
$stmt->fetch();
$stmt->close();

// Fetch user groups for the dropdown
$userGroups = [];
$result = $conn->query("SELECT UserTypeID, UserGroup FROM UserType");
while ($row = $result->fetch_assoc()) {
    $userGroups[] = $row;
}
$result->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    // Generate a cache buster using the current timestamp
    $cacheBuster = time();
    ?>
    <link rel="stylesheet" href="edit_user.css" <?php echo 'v='. $cacheBuster?>>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="post" action="edit_user.php?id=<?php echo $userID; ?>" enctype="multipart/form-data">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>

        <label for="user_group">User Group:</label>
        <select id="user_group" name="user_group" required>
            <?php foreach ($userGroups as $group) : ?>
                <option value="<?php echo $group['UserTypeID']; ?>" <?php if ($group['UserTypeID'] == $userTypeID) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($group['UserGroup']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="user_image">User Image:</label>
        <input type="file" id="user_image" name="user_image"><br>
        <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($userImage); ?>">
        <img src="<?php echo htmlspecialchars($userImage); ?>" alt="User Image" width="100"><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
