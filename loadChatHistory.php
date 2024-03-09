<?php
include_once 'config/constants.php';

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch chat history from the database
$sql = "SELECT * FROM chat_history WHERE user_id = $user_id ORDER BY chat_date ASC, timestamp ASC";
$result = $conn->query($sql);

$currentDate = null;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $chatDate = date("Y-m-d", strtotime($row["chat_date"]));
        if ($chatDate !== $currentDate) {
            // Open a new message-box for the current date
            echo "<div id='message-box' class='message-box'>";

            // Display the chat history date
            echo "<div class='chat-history-date'>";
            echo "<p class='chat-history-title'>" . formatDateWithoutTime($chatDate) . "</p>";
            echo "</div>";

            // Set current date to the chat date
            $currentDate = $chatDate;
        }

        // Display the chat message
        if ($row["is_user"] == 1) {
            // User message
            echo generateUserMessageHTML($row["message"], formatTimeStamp($row["timestamp"]), $userProfile, $row["id"]);
        } else {
            // Chatbot message
            echo generateChatbotMessageHTML($row["message"], formatTimeStamp($row["timestamp"]), $row["id"]);
        }
    }
}

// Scroll to the bottom
echo "
<script>
    var chatWrapper = document.getElementById('chat-wrapper');
    chatWrapper.scrollTop = chatWrapper.scrollHeight;
</script>
";

// Function to format the date without time
function formatDateWithoutTime($date)
{
    $now = new DateTime();
    $messageDate = new DateTime($date);
    $diff = $now->diff($messageDate);
    $diffDays = $diff->days;

    if ($diffDays === 0) {
        return "Today";
    } else if ($diffDays === 1) {
        return "Yesterday";
    } else {
        return $messageDate->format("F j, Y");
    }
}

// Function to format the timestamp
function formatTimeStamp($timestamp)
{
    $messageDate = new DateTime($timestamp);

    // Get the time format for 12-hour clock system
    $formattedTime = $messageDate->format("g:i A");

    // Check if message date is today
    $today = new DateTime();
    if ($messageDate->format('Y-m-d') === $today->format('Y-m-d')) {
        return "Today at " . $formattedTime;
    }

    // Check if message date is yesterday
    $yesterday = new DateTime('yesterday');
    if ($messageDate->format('Y-m-d') === $yesterday->format('Y-m-d')) {
        return "Yesterday at " . $formattedTime;
    }

    // For other dates
    return $messageDate->format("F j, Y") . " at " . $formattedTime;
}

// Function to generate user message HTML
function generateUserMessageHTML($userMessage, $timeStamp, $userProfile, $messageId)
{
    return '
    <div class="message-user">
        <!-- more options -->
        <form action="delete_message.php" method="post" class="more-options-box">
            <input type="hidden" name="messageId" value="' . $messageId . '">
            <!-- more options modal -->
            <div class="more-options-modal-box-user">
            <div id="more-options-modal" class="more-options-modal">
                <button id="more-options-delete-btn" name="more-options-delete-btn" type="submit" class="more-options-btn red more-options-delete-btn">Delete</button>
                <button id="more-options-copy-btn" class="more-options-btn more-options-copy-btn">Copy</button>
            </div>
            </div>

            <div id="more-options" class="more-options">
                <i class="fas fa-chevron-down more-options-icon"></i>
                <i class="fa-regular fa-face-smile more-options-icon"></i>
            </div>
        </form>
        <div class="message-content-user">
            <div class="message-title-box">
                <p class="message-title">You</p>
            </div>
            <div class="message-row">
                <p>' . $userMessage . '</p>
                <div class="time-stamp-user">' . $timeStamp . '</div>
            </div>
        </div>
        <div class="avatar">
            <img src="img/userProfile/' . $userProfile . '" alt="User Image" class="avatar-img" />
        </div>
    </div>';

}

// Function to generate chatbot message HTML
function generateChatbotMessageHTML($chatbotMessage, $chatbotTimeStamp, $messageId)
{
    return '
    <div class="message-chatbot">
            <div class="avatar">
                <img class="avatar-img" src="img/emma.jpg" alt="Chatbot Avatar" />
            </div>
            <div class="message-content-chatbot">
                <div class="message-title-box">
                    <p class="message-title">E.m.m.a</p>
                </div>
                <div class="message-row">
                    <p>' . $chatbotMessage . '</p>
                    <div class="time-stamp-chatbot">' . $chatbotTimeStamp . '</div>
                </div>
            </div>
            <!-- more options -->
            <form action="delete_message.php" method="post" class="more-options-box">
                <input type="hidden" name="messageId" value="' . $messageId . '">
                <div id="more-options" class="more-options">
                    <i class="fas fa-chevron-down more-options-icon"></i>
                    <i class="fa-regular fa-face-smile more-options-icon"></i>
                </div>
                <!-- more options modal -->
                <div class="more-options-modal-box">
                <div id="more-options-modal" class="more-options-modal">
                    <button id="more-options-delete-btn" name="more-options-delete-btn" type="submit" class="more-options-btn red more-options-delete-btn">Delete</button>
                    <button id="more-options-copy-btn" class="more-options-btn more-options-copy-btn">Copy</button>
                </div>
                </div>
            </form>
    </div>';
}
