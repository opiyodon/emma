<?php
include 'config/constants.php';

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Handle incoming user query and chatbot response
$userQuery = $_POST['userMessage'];
$chatbotResponse = $_POST['chatbotMessage'];

// Get the current date in the desired format
$chat_date = date('Y-m-d'); // Change the format as needed

// Store chat history in the database
$sqlUser = "INSERT INTO chat_history (user_id, message, timestamp, is_user, chat_date) VALUES ('$user_id', '$userQuery', NOW(), 1, '$chat_date')";
if ($conn->query($sqlUser) === TRUE) {
    // Redirect to index page or wherever appropriate
    header('location:' . SITEURL_USER . 'index.php');
} else {
    echo "Error: " . $sqlUser . "<br>" . $conn->error;
}

// Prepare chatbot response for insertion
$chatbotResponse = $conn->real_escape_string($chatbotResponse);

$sqlChatbot = "INSERT INTO chat_history (user_id, message, timestamp, is_user, chat_date) VALUES ('$user_id', '$chatbotResponse', NOW(), 0, '$chat_date')";
if ($conn->query($sqlChatbot) === TRUE) {
    // Redirect to index page or wherever appropriate
    header('location:' . SITEURL_USER . 'index.php');
} else {
    echo "Error: " . $sqlChatbot . "<br>" . $conn->error;
}

