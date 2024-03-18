<?php include 'partials/header.php'; ?>

<div class="login">
    <!-- Login Form Starts Here -->
    <form action="" method="POST" class="MyLoginForm">

        <div class="ImgBox">
            <img src="img/emma.jpg" alt="">
        </div>

        <h1>Login</h1>

        <?php
            if (isset($_SESSION['login2'])) {
                echo $_SESSION['login2'];
                unset($_SESSION['login2']);
            }

            if (isset($_SESSION['message2'])) {
                echo $_SESSION['message2'];
                unset($_SESSION['message2']);
            }

            if (isset($_SESSION['register'])) {
                echo $_SESSION['register'];
                unset($_SESSION['register']);
            }

            if (isset($_SESSION['deleteAccount'])) {
                echo $_SESSION['deleteAccount'];
                unset($_SESSION['deleteAccount']);
            }
        ?>

        <div>
            <input required class="INPUT" type="text" name="username" placeholder="Enter Username">
        </div>

        <div>
            <input required class="INPUT" type="password" name="password" placeholder="Enter Password">
        </div>

        <div class="btnBox">
            <input type="submit" name="submit" value="Login" class="Btn">
        </div>

        <div>
            <a class="LOGIN_LINK_ITEM" href="<?php echo SITEURL_USER; ?>forgot_password.php">
                Forgot password?
            </a>
        </div>

        <div>
            <p>
                Don't have an account?
                <a class="LOGIN_LINK_ITEM" href="<?php echo SITEURL_USER; ?>register.php">
                    Register
                </a>
            </p>
        </div>

    </form>
    <!-- Login Form Ends Here -->
</div>

<?php include 'partials/footer.php'; ?>

<?php
// Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // Process data from the login form
    // 1. Get the data from the login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // 2. SQL to check whether the user with that username and password exists
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

    // 3. Execute the query
    $res = mysqli_query($conn, $sql);

    // 4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // User available and login successful
        $row = mysqli_fetch_assoc($res);
        $user_id = $row['id'];
        $_SESSION['login'] = "<div class='successContainer'>
        <div class='SUCCESSBOX'>
        <div class='SUCCESS2'>Welcome back $username 👋🏽</div>
      </div>
      </div>";
        $_SESSION['user'] = $username; // To check whether the user is logged in or not and logout unsets it
        $_SESSION['user_id'] = $user_id; // Store the user_id in the session

        // Redirect to Manage Admin Page
        header('location:' . SITEURL_USER . 'index.php');
        ob_end_flush();
    } else {
        // Failed to login
        $_SESSION['login2'] = "<div class='ERROR'>Username and Password did not match</div>";
        // Redirect back to login page
        header('location:' . SITEURL_USER . 'login.php');
        ob_end_flush();
    }
}
?>