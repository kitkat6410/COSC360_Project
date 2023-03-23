<?php
// if (session_status() === PHP_SESSION_NONE) {
    // $lifetime=3600;
    // session_set_cookie_params($lifetime);
    // session_start();
// }
require 'SessionValidation.php';
if(!isset($_SESSION['last_activity'])){
    $_SESSION['last_activity'] = time();

}
if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] != 1) {
    try {
        require 'connectiondb.php';

        $user_input = $_POST['username'];
        $pass_input = $_POST['password'];
        $stmt = $pdo->prepare("SELECT * FROM userinfo WHERE Username = :username && Password = :password");
        $stmt->execute(array(':username' => $user_input, ':password' => $pass_input));
        $row = $stmt->fetch();
        if (!$row) {
            // Invalid credentials, redirect back to login page with error message
            header('Location: login.php?error=1');
            exit;
        } else {
            // Valid credentials, set session variable and redirect to home page
            $_SESSION["LoggedIn"] = true;
            $_SESSION['user_id'] = $row['Username'];
            $_SESSION['pass_id'] = $row['Password'];
            $_SESSION['isAdmin'] = $row['isAdmin'];
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo $e;
        header('Location: login.php?error=1');
        exit();
    }
}
else{
    require 'connectiondb.php';
    $user_input = $_SESSION['user_id'];
    $pass_input = $_SESSION['pass_id'];
    $stmt = $pdo->prepare("SELECT * FROM userinfo WHERE Username = :username && Password = :password");
    $stmt->execute(array(':username' => $user_input, ':password'=> $pass_input));
    $row = $stmt->fetch();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile Page</title>
    <link rel="stylesheet" href="css/reset.css">
    </link>
    <link rel="stylesheet" href="css/styles.css"></link>
    <link rel="stylesheet" href="css/profile.css">
    </link>
   
    <nav>
        <div class="site-title">
            <a href="home.php">
                <h1>Culinary Cloud</h1>
                </a>
           
            <p>Social Media Links</p>
        </div>
        <ul>
            <li><a href="blogs.php">Browse Blogs</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="create.html">Create a blog</a></li>
         <li><a href="index.php">Logout</a></li>
         <?php
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1 && !isset($_SESSION['isLoggedAdmin'])) { ?>
            <li><a href="adminLogin.php">Admin Login</a></li>
            <?php } ?>
        </ul>
    </nav>
</head>

<body>
    <h1 class="third-color">Welcome <strong><?php echo $row['Name'] ?></strong></h1>
    <div class = "profile fourth-color">
    <img src=<?php echo $row['ProfileImage'] ?> alt="Profile Image">

    <div class="details-container">
    <h2>Account Details</h2>
    <p> <strong>Username: </strong> <?php echo $row['Username'] ?></p>
    <p><strong>Email: </strong> <?php echo $row['Email'] ?></p>
    <p><strong>Birth Date: </strong><?php echo $row['BirthDate'] ?></p>
    <p><strong>Account Created: </strong><?php echo $row['AccountCreated'] ?></p>

    </div>
    </div>
    <div style="margin-top: 20px;">
    <a href="edit.php"><h1 class="third-color">Edit Profile</h1></a>
</div>

</body>

</html>