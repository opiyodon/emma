<?php
include_once 'config/constants.php';

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch chat history from the database
$sql = "SELECT * FROM chat_history WHERE user_id = $user_id ORDER BY chat_date ASC, timestamp ASC";
$result = $conn->query($sql);

$chatHistory = array(); // Array to hold chat history

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $chatDate = date("Y-m-d", strtotime($row["chat_date"]));
        $message = array(
            "date" => $chatDate,
            "isUser" => $row["is_user"] == 1,
            "message" => $row["message"],
            "timestamp" => $row["timestamp"],
            "id" => $row["id"]
        );
        array_push($chatHistory, $message);
    }
}

header('Content-Type: application/json');
echo json_encode($chatHistory);
