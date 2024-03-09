<?php include 'partials/header.php'; ?>

<div class="resetPassword">
    <div class="MyResetPasswordForm">

        <div class="ImgBox">
            <img src="img/emma.jpg" alt="">
        </div>

        <h1 class="ERROR">ERROR</h1>

        <div>
            <?php
            if (isset($_SESSION['messageB'])) {
                echo $_SESSION['messageB'];
                unset($_SESSION['messageB']);
            }
            if (isset($_SESSION['messageC'])) {
                echo $_SESSION['messageC'];
                unset($_SESSION['messageC']);
            }
            if (isset($_SESSION['message2B'])) {
                echo $_SESSION['message2B'];
                unset($_SESSION['message2B']);
            }
            if (isset($_SESSION['message2C'])) {
                echo $_SESSION['message2C'];
                unset($_SESSION['message2C']);
            }
            if (isset($_SESSION['message2D'])) {
                echo $_SESSION['message2D'];
                unset($_SESSION['message2D']);
            }
            ?>
        </div>

        <div>
            <p>
                Go back to Login page?
                <a class="LOGIN_LINK_ITEM" href="<?php echo SITEURL_USER; ?>login.php">
                    Login
                </a>
            </p>
        </div>

    </div>
</div>

<?php include 'partials/footer.php'; ?>