<?php
require 'SessionValidation.php';
require 'connectiondb.php';
if (!isset($_SESSION['last_activity'])) {
    $_SESSION['last_activity'] = time();

}
if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] != 1) {
    try {


        $user_input = $_POST['username'];
        $pass_input = $_POST['password'];
        $stmt = $pdo->prepare("SELECT * FROM userinfo WHERE Username = :username");
        $stmt->bindParam(':username', $user_input);
        $stmt->execute();
        $row = $stmt->fetch();
        $hashed_password = $row['Password'];
        if (!$row || !password_verify($pass_input, $hashed_password)) {
            header('Location: login.php?error=InvalidLogin');
            exit();
        } else {
            // Valid credentials, set session variable and redirect to home page
            $_SESSION["LoggedIn"] = true;
            $_SESSION['user_id'] = $row['Username'];
            $_SESSION['pass_id'] = $row['Password'];
            $_SESSION['isAdmin'] = $row['isAdmin'];
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        ;
        header('Location: login.php?error=1');
        exit();
    }
} else {

    $user_input = $_SESSION['user_id'];
    $pass_input = $_SESSION['pass_id'];
    $stmt = $pdo->prepare("SELECT * FROM userinfo WHERE Username = :username && Password = :password");
    $stmt->execute(array(':username' => $user_input, ':password' => $pass_input));
    $row = $stmt->fetch();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile Page</title>
    <link rel="stylesheet" href="css/reset.css">
    </link>
    <link rel="stylesheet" href="css/styles.css">
    </link>
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
            <li><a href="create.php">Create a blog</a></li>
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
    <div class="profile fourth-color">
        <img src=<?php echo $row['ProfileImage'] ?> alt="Profile Image">

        <div class="details-container">
            <h2>Account Details</h2>
            <p> <strong>Username: </strong> <?php echo $row['Username'] ?></p>
            <p><strong>Email: </strong> <?php echo $row['Email'] ?></p>
            <p><strong>Birth Date: </strong><?php echo $row['BirthDate'] ?></p>
            <p><strong>Account Created: </strong><?php echo $row['AccountCreated'] ?></p>


        </div>

    </div>
    <div class="fourth-color">
        <h2>Blog List:</h2>
                <?php
                $input = "SELECT * FROM bloginfo WHERE Username = :username";
                $stmt2 = $pdo->prepare($input);
                $stmt2->bindParam(':username', $_SESSION['user_id']);
                $stmt2->execute();
                // $row2 = $stmt2->fetch();
                // print_r($row2);
                $check = false;

                while ($row2 = $stmt2->fetch()) {

                   ?> <a class="blog-link" href="blogTemplate.php" onclick="blogClicked('<?php echo $row2['BID']; ?>', event); return false;"><?php echo $row2['BlogName']; ?></a>
                    <br>
                        <?php
                        $check = true;
                }
                if (!$check) {
                    echo "<p>You have no blogs! <a href='create.php'>Create one</a></p>";
                }
                // foreach ($stmt2 as $row2) {
                //     echo $row2['BlogName'];
                // }
                
                //echo "<p>You have no blogs! <a href='create.php'>Create one</a></p>";
                
                ?>
    </div>
    <div style="margin-top: 15px;">
        <a href="edit.php">
            <h1 class="third-color">Edit Profile</h1>
        </a>
    </div>


</body>
<script>
function blogClicked(bid, event) {
  event.preventDefault();
  console.log(bid);
  window.location.href = "blogTemplate.php?bid=" + bid;
}
</script>

</html>