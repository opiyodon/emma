<?php
// Process the value from the form and delete the user from the database
if (isset ($_POST['deleteAccount'])) {
    // Sanitize the input to prevent SQL injection
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Verify if the provided password matches the user's password
    $sql = "SELECT password, profile_picture FROM user WHERE id = $user_id";
    $res = mysqli_query($conn, $sql);

    // Check if the query executed successfully
    if ($res) {
        // Fetch the hashed password and profile picture path from the result
        $row = mysqli_fetch_assoc($res);
        $databasePassword = $row['password'];
        $profilePicturePath = $row['profile_picture'];

        // Encrypt the provided password using MD5
        $password = md5($password);

        // Verify if the provided password matches the hashed password
        if ($password == $databasePassword) {
            // Password matched, proceed to delete account
            $sql_delete = "DELETE FROM user WHERE id = $user_id";

            // Execute the delete query
            if (mysqli_query($conn, $sql_delete)) {
                // Account deleted successfully
                $_SESSION['deleteAccount'] = "<div class='SUCCESS'>Account Deleted Successfully</div>";

                // Delete the profile picture file if it's not the default picture
                if (file_exists($profilePicturePath) && $profilePicturePath != 'img/userProfile/No-Profile.png') {
                    unlink($profilePicturePath);
                }

                // Redirect to login page
                header('location:' . SITEURL_USER . 'login.php');
            } else {
                // Redirect to index page or wherever appropriate
                header('location:' . SITEURL_USER . 'index.php');
            }
        }
    } else {
        // Redirect to index page or wherever appropriate
        header('location:' . SITEURL_USER . 'index.php');
    }
}
?>
