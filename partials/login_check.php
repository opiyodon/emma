<?php
// Authorization - Access Control
// Check whether the user is logged in or not
if (!isset($_SESSION['user'])) {
    // User is not logged in
    // Redirect to the Login Page
    header('location:' . SITEURL_USER . 'login.php');
    ob_end_flush();
}

// Store the user_id from the session for easy access throughout the website
$user_id = $_SESSION['user_id'];
