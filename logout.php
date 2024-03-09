<?php
// Include constants.php file here
include 'config/constants.php';

// Destroy the Session
session_unset(); // Unsets all session variables

// Redirect to Login Page
header('location:'.SITEURL_USER.'login.php');
ob_end_flush();
