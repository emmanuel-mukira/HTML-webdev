<?php
// Start the session to access user ID
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You are not logged in. Please log in first.";
    exit();
}
?>
