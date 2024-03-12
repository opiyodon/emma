<?php
include 'config/constants.php';

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

