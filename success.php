<?php include 'partials/header.php'; ?>

<div class="resetPassword">
    <div class="MyResetPasswordForm">

        <div class="ImgBox">
            <img src="img/emma.jpg" alt="">
        </div>

        <h1 class="SUCCESS">SUCCESS</h1>

        <div>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
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