<?php include 'partials/main_header.php'; ?>

<div id="root">
    <?php
    // Get user ID from the login_check.php
    $user_id = $_SESSION['user_id'];

    // Query to get the user's profile from the user table
    $sql = "SELECT * FROM user WHERE id = $user_id ORDER BY id DESC";
    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether the query is executed or not
    if ($res == TRUE) {
        // Count rows to check whether we have data in the database or not
        $count = mysqli_num_rows($res); // Function to get all rows in the database
    
        // Check the number of rows
        if ($count > 0) {
            // We have data in the database
            while ($rows = mysqli_fetch_assoc($res)) {
                // Using while loop to get all the data from the database
                // The while loop will run as long as there's data in the database
    
                // Get individual data
                $id = $rows['id'];
                $username = $rows['username'];
                $userProfile = $rows['userProfile'];
                $email = $rows['email'];
                $phone = $rows['phone'];

                // create a javascript function to store value of userProfile for later use
                echo "<script>var userProfile = '$userProfile';</script>";

                // Display the values in our modal
                ?>

                <!-- Sidebar -->
                <section id="sidebar" class="sidebar ||| sidebarOpen">
                    <div class="header-container">
                        <div class="logo-section">
                            <div class="logo-image">
                                <img src="img/emma.jpg" alt="logo" />
                            </div>
                            <h1 class="logo-text">E.M<span>.M.A</span></h1>
                        </div>
                        <div class="menu-button" onclick="toggleSidebar()">
                            <i id="menu-icon" class="fa-solid fa-xmark menu-icon"></i>
                        </div>
                    </div>

                    <div class="chatBox">
                        <a class="chatButton">
                            <i class="fa-regular fa-circle-question sidebarIcon"></i>
                            <p class="sidebarText clearText">Who Is E.M.M.A ?</p>
                        </a>
                    </div>

                    <div id="aboutContainer" class="about">
                        <div class="about-card">
                            <h4 class="about-title">E.M.M.A</h4>
                            <p class="about-subtitle">(Emotional Mental Health Assistant)</p>
                            <p class="about-txt">
                                Your Trusted Emotional Support AI - A Companion for Your Mental Health Journey! Engage in personal and relatable conversations with our empathetic AI, designed to be your reliable confidant. Discover the power of our AI capabilities tailored to support your emotional well-being.
                            </p>
                        </div>
                        <div class="about-card">
                            <h4 class="about-title">Developers</h4>
                            <ul class="devs-list">
                                <li class="devs-card">
                                    <a href="https://my-portfolio-kiki-glows-projects.vercel.app" target="_blank"
                                        rel="noopener noreferrer">
                                        <div class="dev-img">
                                            <img src="img/glory.jpg" alt="" />
                                        </div>
                                        <p class="devs-txt">Glory</p>
                                    </a>
                                </li>
                                <li class="devs-card">
                                    <a href="https://opiyodon.vercel.app" target="_blank" rel="noopener noreferrer">
                                        <div class="dev-img">
                                            <img src="img/donartkins.jpg" alt="" />
                                        </div>
                                        <p class="devs-txt">Artkins</p>
                                    </a>
                                </li>
                                <li class="devs-card">
                                    <a href="https://oketchmanu.vercel.app" target="_blank" rel="noopener noreferrer">
                                        <div class="dev-img">
                                            <img src="img/manu.jpg" alt="" />
                                        </div>
                                        <p class="devs-txt">Oketch Emmanuel</p>
                                    </a>
                                </li>
                                <li class="devs-card">
                                    <a href="#" target="_blank" rel="noopener noreferrer">
                                        <div class="dev-img">
                                            <img src="img/tito.jpg" alt="" />
                                        </div>
                                        <p class="devs-txt">Tito K.</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <ul class="menuContainer">
                        <li>
                            <a id="theme-toggle-button" class="menuButton">
                                <i id="theme-icon" class="fa-solid fa-moon sidebarIcon"></i>
                                <p id="theme-text" class="sidebarText">Dark Mode</p>
                            </a>
                        </li>

                        <li>
                            <a id="modalToggle" class="menuButton">
                                <i class="fa-solid fa-user sidebarIcon"></i>
                                <p class="sidebarText">My Account</p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL_USER; ?>logout.php" class="menuButton red">
                                <i class="fa-solid fa-arrow-right-from-bracket sidebarIcon"></i>
                                <p class="sidebarText">Log Out</p>
                            </a>
                        </li>
                    </ul>

                    <div id="modalContainer">
                        <div id="modal" class="modal ||| modalClose">
                            <div class="modal-box">
                                <div id="modalClose" class="modal-button">
                                    <i class="fa-solid fa-xmark menu-icon"></i>
                                </div>
                                <h3 class="modal-title">My Account</h3>
                                <div id="modalContent" class="modal-content">
                                    <div class="modalContainer">

                                        <div style="width: 100%;">
                                            <form action="" method="post" id="changeProfileForm" class="profile"
                                                enctype="multipart/form-data">
                                                <div class="profileImgBox">
                                                    <?php
                                                    // Check whether the image is available or not
                                                    if ($userProfile != "") {
                                                        // Display image
                                                        ?>

                                                        <div class="ChangeProfileBox">
                                                            <img src="img/userProfile/<?php echo $userProfile ?>" alt="User Image"
                                                                class="profilePic" />
                                                            <div>
                                                                <input type="text" class="FILE-INPUT" placeholder="Choose Profile"
                                                                    readonly>
                                                                <label for="userProfile">
                                                                    <div class="profile-overlay">
                                                                        <i class="fa-solid fa-camera profileImageIcon"></i>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <input type="file" id="userProfile" name="userProfile" hidden
                                                                accept=".jpeg, .png, .jpg">
                                                        </div>

                                                        <?php
                                                    } else {
                                                        // Display message
                                                        echo "<div class='ERROR'>Image Not Added</div>";
                                                    }
                                                    ?>
                                                </div>
                                                <div class="profileTxtBox">
                                                    <p class="profileName">
                                                        <?php echo $username ?>
                                                    </p>
                                                    <p class="profileEmail">
                                                        <?php echo $email ?>
                                                    </p>
                                                    <p class="profileNumber">
                                                        <?php echo $phone ?>
                                                    </p>
                                                    <div class="btnBox">
                                                        <input id="updateProfile" type="submit" name="updateProfile"
                                                            value="Update Profile Picture" class="Btn" />
                                                    </div>
                                                </div>
                                            </form>
                                            <?php
                                            // Process the Value from Form and Save in Database
                                            // Check whether the updateProfile button is clicked or not
                                            if (isset($_POST['updateProfile'])) {
                                                // Button Clicked
                                
                                                // 1. Upload the image if selected
                                
                                                // Check whether upload button is clicked or not
                                                if (isset($_FILES['userProfile']['name']) && !empty($_FILES['userProfile']['name'])) {
                                                    // Get the details of the selected image
                                                    $image_name = $_FILES['userProfile']['name'];

                                                    // A. Rename the image
                                                    // Get the extension of selected image
                                                    $ext = end(explode('.', $image_name));

                                                    // Create new name for image
                                                    $image_name = "User-Profile-" . rand(0000, 9999) . "." . $ext; // New image name may be "User-Profile-8462.jpg"
                                
                                                    // B. Upload the image
                                                    $src = $_FILES['userProfile']['tmp_name'];
                                                    $dst = "img/userProfile/" . $image_name;
                                                    $upload = move_uploaded_file($src, $dst);

                                                    // Check whether image uploaded or not
                                                    if (!$upload) {
                                                        $_SESSION['uploadProfile'] = "<div class='errorContainer'>
                                <div class='ERRORBOX'>
                                    <div class='ERROR2'>Failed to Upload Image</div>
                                </div>
                            </div>";
                                                        //redirect to Home Page
                                                        header('location:' . SITEURL_USER . 'index.php');
                                                        ob_end_flush();
                                                    } else {
                                                        // Remove the previous image if it exists
                                                        if ($userProfile != "") {
                                                            $remove_path = "img/userProfile/" . $userProfile;
                                                            if (file_exists($remove_path)) {
                                                                unlink($remove_path);
                                                            }
                                                        }

                                                        // Update the user's profile image in the database
                                                        $sql = "UPDATE user SET userProfile = '$image_name' WHERE id = $user_id";
                                                        $res = mysqli_query($conn, $sql);

                                                        if ($res) {
                                                            $_SESSION['updateProfile'] = "<div class='successContainer'>
                                  <div class='SUCCESSBOX'>
                                      <div class='SUCCESS2'>Profile Picture Updated Successfully</div>
                                  </div>
                              </div>";
                                                            //redirect to Home Page
                                                            header('location:' . SITEURL_USER . 'index.php');
                                                            ob_end_flush();
                                                        } else {
                                                            $_SESSION['updateProfile'] = "<div class='errorContainer'>
                                  <div class='ERRORBOX'>
                                      <div class='ERROR2'>Failed to Update Profile Picture</div>
                                  </div>
                              </div>";
                                                            //redirect to Home Page
                                                            header('location:' . SITEURL_USER . 'index.php');
                                                            ob_end_flush();
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>


                                        <div style="width: 100%;">
                                            <form action="" method="post" id="changePasswordForm" class="changePasswordForm">
                                                <h4>Change Password</h4>
                                                <div class="inputBox">
                                                    <input class="INPUT" type="password" placeholder="Enter New Password"
                                                        name="newPassword" id="newPassword" />
                                                </div>
                                                <div class="inputBox">
                                                    <input class="INPUT" type="password" placeholder="Confirm New Password"
                                                        name="confirmPassword" id="confirmPassword" />
                                                </div>
                                                <div class="btnBox">
                                                    <input id="updatePassword" type="submit" name="updatePassword"
                                                        value="Update Password" class="Btn" />
                                                </div>
                                            </form>
                                            <!-- =========== UPDATE PASSWORD =========== -->
                                            <?php
                                            // Check whether the updatePassword button is clicked or not
                                            if (isset($_POST['updatePassword'])) {
                                                // Get new password and confirm password from the form
                                                $newPassword = $_POST['newPassword'];
                                                $confirmPassword = $_POST['confirmPassword'];

                                                // Validate if new password matches the confirm password
                                                if ($newPassword == $confirmPassword) {
                                                    // Encrypt the new password using MD5
                                                    $password = md5($newPassword);


                                                    // Update the password in the database
                                                    $sql = "UPDATE user SET password='$password' WHERE id = $user_id";
                                                    $res = mysqli_query($conn, $sql);

                                                    // Check if query executed successfully
                                                    if ($res) {
                                                        $_SESSION['updatePassword'] = "<div class='successContainer'>
                                <div class='SUCCESSBOX'>
                                    <div class='SUCCESS2'>Password Updated Successfully</div>
                                </div>
                            </div>";
                                                        //redirect to Home Page
                                                        header('location:' . SITEURL_USER . 'index.php');
                                                        ob_end_flush();
                                                    } else {
                                                        $_SESSION['updatePassword'] = "<div class='errorContainer'>
                                <div class='ERRORBOX'>
                                    <div class='ERROR2'>Failed to Update Password</div>
                                </div>
                            </div>";
                                                        //redirect to Home Page
                                                        header('location:' . SITEURL_USER . 'index.php');
                                                        ob_end_flush();
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>


                                        <div style="width: 100%;">
                                            <form action="" method="post" id="deleteAccountForm" class="deleteAccountForm">
                                                <h4>Delete Your Account</h4>
                                                <div class="delete-txt">
                                                    <p>Warning! This action is irreversible.</p>
                                                    <p>Enter password to delete your account.</p>
                                                </div>
                                                <div class="inputBox">
                                                    <input class="INPUT" type="password" placeholder="Enter Password"
                                                        name="password" />
                                                </div>
                                                <div class="btnBox">
                                                    <input id="deleteAccount" type="submit" name="deleteAccount"
                                                        value="Delete Account" class="Btn red" />
                                                </div>
                                            </form>

                                            <?php
                                            // Process the value from the form and delete the user from the database
                                            if (isset($_POST['deleteAccount'])) {
                                                // Sanitize the input to prevent SQL injection
                                                $password = mysqli_real_escape_string($conn, $_POST['password']);

                                                // Verify if the provided password matches the user's password
                                                $sql = "SELECT password FROM user WHERE id = $user_id";
                                                $res = mysqli_query($conn, $sql);

                                                // Check if the query executed successfully
                                                if ($res) {
                                                    // Fetch the hashed password from the result
                                                    $row = mysqli_fetch_assoc($res);
                                                    $databasePassword = $row['password'];

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
                                                            // Redirect to login page
                                                            header('location:' . SITEURL_USER . 'login.php');
                                                        } else {
                                                            // Failed to delete account
                                                            $_SESSION['deleteAccount2'] = "<div class='errorContainer'>
                                <div class='ERRORBOX'>
                                    <div class='ERROR2'>Failed to Delete Account</div>
                                </div>
                            </div>";
                                                            // Redirect to index page or wherever appropriate
                                                            header('location:' . SITEURL_USER . 'index.php');
                                                        }
                                                    }
                                                } else {
                                                    // Error in executing query
                                                    $_SESSION['deleteAccount2'] = "<div class='errorContainer'>
                            <div class='ERRORBOX'>
                                <div class='ERROR2'>Error fetching user data</div>
                            </div>
                        </div>";
                                                    // Redirect to index page or wherever appropriate
                                                    header('location:' . SITEURL_USER . 'index.php');
                                                }
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
                <!-- ChatView -->
                <main id="chatView" class="chatView">

                    <?php
                    // Query to get the user's profile from the user table
                    $sql = "SELECT * FROM chat_history";
                    // Execute the query
                    $res = mysqli_query($conn, $sql);

                    // Check whether the query is executed or not
                    if ($res == TRUE) {
                        // Count rows to check whether we have data in the database or not
                        $count = mysqli_num_rows($res); // Function to get all rows in the database
        
                        // Check the number of rows
                        if ($count > 0) {
                            // We have data in the database
                            while ($rows = mysqli_fetch_assoc($res)) {
                                ?>

                                <section id="chat-wrapper" class="chat-wrapper">
                                    <!-- PHP code to load chat history from database and generate message boxes -->
                                    <?php include_once 'loadChatHistory.php'; ?>

                                    <div class="scroll_top">
                                        <p class="to-top">
                                            <i class="fas fa-chevron-up send-icon"></i>
                                        </p>
                                    </div>
                                </section>

                                <?php
                            }
                        }
                    }
                    ?>

                    <form id="input-form" onsubmit="sendMessage(event)" class="input-form">
                        <div class="input-box">
                            <button class="emoji-button" id="emoji-button">
                                <i class="fa-regular fa-face-smile emoji-icon"></i>
                            </button>
                            <textarea id="message-input" class="message-input" placeholder="Start chat with Emma..."></textarea>
                            <button type="submit" class="send-button" id="submit-button">
                                <i class="fa-solid fa-paper-plane send-icon"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Emoji Modal -->
                    <div id="emoji-modal" class="emoji-modal">
                        <div class="emoji-modal-content">
                            <div class="emoji-header">
                                <div id="emoji-modalClose" class="emoji-modal-button">
                                    <i class="fa-solid fa-xmark emoji-menu-icon"></i>
                                </div>
                                <h3 class="emoji-modal-title">Emojis</h3>
                            </div>
                            <div id="emoji-categories">
                                <!-- Emojis will appear here -->
                            </div>
                        </div>
                    </div>
                </main>

                <?php
            }
        } else {
            ?>
            <div class='errorContainer'>
                <div class='ERRORBOX'>
                    <div class='ERROR2'>Account error</div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>

<?php include 'partials/footer.php'; ?>