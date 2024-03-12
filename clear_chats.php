<?php
include 'config/constants.php';

// Check whether the user is logged in or not
if (!isset($_SESSION['user'])) {
    // User is not logged in
    // Redirect to the Login Page
    header('location:' . SITEURL_USER . 'login.php');
    ob_end_flush();
}

// Store the user_id from the session for easy access throughout the website
$user_id = $_SESSION['user_id'];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your database connection code here

    // Query to delete all chats for the current user
    $sql = "DELETE FROM chat_history WHERE user_id = $user_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to index page or wherever appropriate
        header('location:' . SITEURL_USER . 'index.php');
    } else {
        // Send an error response
        echo json_encode(array("success" => false, "error" => "Error deleting chats"));
    }

    // Close the connection
    $conn->close();
}
