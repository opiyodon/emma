<?php
include 'config/constants.php';

// Store the user_id from the session for easy access throughout the website
$user_id = $_SESSION['user_id'];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Query to delete all chats for the current user
    $sql = "DELETE FROM chat_history WHERE user_id = $user_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Send a success response
        echo json_encode(array("success" => true));
    } else {
        // Send an error response
        echo json_encode(array("success" => false, "error" => "Error deleting chats"));
    }

    // Close the connection
    $conn->close();
}
