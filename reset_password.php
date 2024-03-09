<?php include 'partials/header.php'; ?>

<div class="resetPassword">
    <form action="" method="POST" class="MyResetPasswordForm">

        <div class="ImgBox">
            <img src="img/emma.jpg" alt="">
        </div>

        <h1>Reset Password</h1>

        <div>
            <input required class="INPUT" type="password" name="password" placeholder="Enter New Password...">
        </div>

        <div class="btnBox">
            <input type="submit" name="submit" value="Reset Password" class="Btn">
        </div>

    </form>
</div>

<?php include 'partials/footer.php'; ?>

<?php
//Check whether the submit button is clicked or not
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Validate the reset token
    $sql = "SELECT * FROM user WHERE reset_token='$token'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) == 1) {
        if (isset($_POST['submit'])) {
            $password = md5($_POST['password']);
            $row = mysqli_fetch_assoc($res);
            $email = $row['email'];

            // Update the user's password
            $sql = "UPDATE user SET password='$password', reset_token=NULL WHERE email='$email'";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                $_SESSION['message2'] = "<div class='SUCCESS'>Password reset successfully</div>";
                header('location:' . SITEURL_USER . 'login.php');
                exit();
            } else {
                $_SESSION['message2B'] = "<div>Failed to reset password</div>";
                header('location:' . SITEURL_USER . 'error.php');
                exit();
            }
        }
    } else {
        $_SESSION['message2C'] = "<div>Invalid reset token</div>";
        header('location:' . SITEURL_USER . 'error.php');
        exit();
    }
} else {
    $_SESSION['message2D'] = "<div>Token not provided</div>";
    header('location:' . SITEURL_USER . 'error.php');
    exit();
}
?>