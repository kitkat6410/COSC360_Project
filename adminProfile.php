<?php
// if (session_status() === PHP_SESSION_NONE) {
require 'SessionValidation.php';
if(!isset($_SESSION['last_activity'])){
    $_SESSION['last_activity'] = time();

}

// }
include ('../connectiondb.php');
if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] != 1 || !isset($_SESSION['isLoggedAdmin'])) {

    try {

       // sanitzation of user input
        $user_input = htmlspecialchars($_POST['username']);
        // password will be hashed
        $pass_input = $_POST['password'];
        $ref_input = htmlspecialchars($_POST['refnumber']);
        $ref_input = intval($ref_input);

        // use prepared statement to retrieve hashed password from database
        $stmt2 = $pdo->prepare("SELECT * FROM admininfo WHERE Username = :username && Refnum = :refnum");
        $stmt2->bindParam(':username', $user_input);
        $stmt2->bindParam(':refnum', $ref_input);
        $stmt2->execute();
        $row2 = $stmt2->fetch();
        if ($row2) {
            $hashed_password = $row2['Password'];
        }
        if (!password_verify($pass_input, $hashed_password)) {
            header('Location: adminLogin.php?error=InvalidLogin');
            exit();
        } else {
            // Valid credentials, set session variable and redirect to home page
            $_SESSION["LoggedIn"] = true;
            $_SESSION["isLoggedAdmin"] = true;
            $_SESSION['user_id'] = $row2['Username'];
            $_SESSION['pass_id'] = $row2['Password'];
            $_SESSION['ref_id'] = $row2['Refnum'];

        }

        $stmt = $pdo->prepare("SELECT * FROM userinfo WHERE Username = :username && Password = :password");
        $stmt->bindParam(':username', $user_input);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();
        $row = $stmt->fetch();

    } catch (Exception $e) {
        error_log($e->getMessage());
        header('Location: adminLogin.php?error=1');
        exit();
    }
} else {

    $user_input = $_SESSION['user_id'];
    $pass_input = $_SESSION['pass_id'];
    $ref_input = $_SESSION['ref_id'];
    $stmt = $pdo->prepare("SELECT * FROM userinfo JOIN admininfo ON userinfo.Username = admininfo.Username WHERE admininfo.Username = :username && admininfo.Password = :password");
    $stmt->bindParam('username', $user_input);
    $stmt->bindParam('password', $pass_input);
    $stmt->execute();
    $row = $stmt->fetch();
}

?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <title>Admin Profile Page</title>
    <link rel="stylesheet" href="css/reset.css">
    </link>
    <link rel="stylesheet" href="css/styles.css">
    </link>
    <link rel="stylesheet" href="css/profile.css">
    </link>

</head>

<body>
<nav>
        <div class="site-title">
            <a href="home.php">
                <h1>Culinary Cloud</h1>
            </a>

            <p>Admin Profile Page</p>
        </div>
        <ul>
            <li><a href="blogs.php">Browse Blogs</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="create.php">Create a blog</a></li>
            <li><a href="index.php">Logout</a></li>
            <?php
            if (!isset($_SESSION['isLoggedAdmin'])) {
            header('Location: adminLogin.php');
            } ?>
        </ul>
    </nav>
    <h1 class="third-color">Welcome <strong><?php echo $row['Name'] ?></strong></h1>
    <div class="profile fourth-color">
        <img src="<?php echo $row['ProfileImage']; ?>" alt="Profile Image">
        <div class="details-container">
            <h2>Account Details</h2>
            <p> <strong>Username: </strong> <?php echo $row['Username'] ?></p>
            <p><strong>Email: </strong> <?php echo $row['Email'] ?></p>
            <p><strong>Birth Date: </strong><?php echo $row['BirthDate'] ?></p>
            <p><strong>Account Created: </strong><?php echo $row['AccountCreated'] ?></p>
        </div>
    </div>
    <div>
    <a href="admin.php"><h1 class="third-color">Admin Info</h1></a>
        </div>

</div>




</body>

</html>