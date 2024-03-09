<?php
include 'config/constants.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the messageId from POST data
    $messageId = $_POST["messageId"];

    // Create SQL DELETE statement
    $sql = "DELETE FROM chat_history WHERE id = $messageId";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to index page or wherever appropriate
        header('location:' . SITEURL_USER . 'index.php');
    } else {
        echo "Error deleting message: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
