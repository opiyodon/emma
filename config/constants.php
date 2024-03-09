<?php
ob_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
//start Session
session_start();


//create constants to store non repeating values
define('SITEURL_USER', 'http://localhost/emma/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'ARTKINSGROUPPROJECT');
define('DB_PASSWORD', 'Grouproject3.2');
define('DB_NAME', 'emma');
define('EMAIL_USERNAME', 'emmaaimhc@gmail.com');
define('EMAIL_PASSWORD', 'bwje prkm culj aeuo');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
?>